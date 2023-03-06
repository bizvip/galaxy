<?php

/******************************************************************************
 * Copyright (c) 2022.  Archer                                                *
 ******************************************************************************/

declare(strict_types=1);

namespace App\Exception\Handler;

use App\Constants\ErrCode;
use App\Exception\BusinessException;
use App\Utils\Log;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;

final class OthersExceptionHandler extends ExceptionHandler
{
    protected StdoutLoggerInterface $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(\Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $this->stopPropagation();

        if ($throwable instanceof BusinessException) {
            $msg  = $throwable->getMessage();
            $code = $throwable->getCode();
            goto resp;
        }

        if ($throwable instanceof ValidationException) {
            $msg  = ErrCode::getMessage(ErrCode::VALIDATED_FAILED, [
                'reason' => $throwable->validator->errors()->first(),
            ]);
            $code = ErrCode::VALIDATED_FAILED;
            goto resp;
        }

        if ($throwable instanceof NotFoundHttpException) {
            $msg  = ErrCode::getMessage(ErrCode::HTTP_NOT_FOUND);
            $code = ErrCode::HTTP_NOT_FOUND;
            goto resp;
        }

        resp:
        if (isset($msg, $code)) {
            $r = \App\Utils\JSON::encode(['code' => $code, 'msg' => $msg, 'data' => null,], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            return $response->withStatus(ErrCode::HTTP_BAD_REQUEST)->withHeader('Content-Type', 'application/json')
                ->withBody(new SwooleStream($r));
        }

        // undefined exceptions
        $errInfo = sprintf('%s [%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile(),);
        $this->logger->error($errInfo);
        Log::error([$errInfo]);

        return $response->withStatus(ErrCode::HTTP_SERVER_ERROR)
            ->withBody(new SwooleStream(ErrCode::getMessage(ErrCode::HTTP_SERVER_ERROR)));
    }

    public function isValid(\Throwable $throwable): bool
    {
        return true;
    }
}
