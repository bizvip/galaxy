<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Psr\Container\ContainerInterface;

#[Command]
final class SwaggerCmd extends HyperfCommand
{
    public function __construct(protected ContainerInterface $container)
    {
        parent::__construct('gen:swagger');
    }

    public function configure(): void
    {
        parent::configure();
        $this->setDescription('基于swagger重新包装的命令，非官方版本');
    }

    public function handle(): void
    {
        $this->line('开始扫描...', 'info');
        $openapi  = \OpenApi\Generator::scan([BASE_PATH.'/app/Controller']);
        $contents = $openapi?->toYaml();

        if (empty($contents)) {
            $this->error('未扫描到任何信息');
            return;
        }

        $dir = BASE_PATH.'/public/swagger';
        if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }

        $file = $dir.DIRECTORY_SEPARATOR.'data.yaml';
        if (!is_file($file)) {
            $handle = fopen($file, 'wb');
            fclose($handle);
        }

        false !== file_put_contents($file, $contents) ? $this->line('生成成功') : $this->warn('生成写入失败');
    }
}
