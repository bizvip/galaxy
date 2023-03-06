<?php

/******************************************************************************
 * Copyright (c) 2022.  Archer                                                *
 ******************************************************************************/

declare(strict_types=1);

namespace App\Exception\Handler;

use App\Constants\ErrCode;
use App\Utils\JSON;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Qbhy\HyperfAuth\Exception\UnauthorizedException;

final class AuthExceptionHandler extends ExceptionHandler
{
    protected StdoutLoggerInterface $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(\Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $this->stopPropagation();

        $code = ErrCode::HTTP_AUTH_FAILED;
        $msg  = $throwable->getMessage();

        if ($throwable instanceof UnauthorizedException) {
            $msg = empty($msg) ? ErrCode::getMessage(code: ErrCode::HTTP_AUTH_REQUIRED) : $msg;
        }

        $r = JSON::encode(
            ['code' => $code, 'msg' => $msg, 'data' => null,],
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR,
        );

        return $response
            ->withStatus($code)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(new SwooleStream($r));
    }

    public function isValid(\Throwable $throwable): bool
    {
        return $throwable instanceof UnauthorizedException;
        // || $throwable instanceof TokenValidException
        // || $throwable instanceof JWTException;
    }
}
