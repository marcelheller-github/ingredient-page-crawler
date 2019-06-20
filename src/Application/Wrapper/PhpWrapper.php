<?php

declare(strict_types=1);

namespace SocialFood\Application\Wrapper;

class PhpWrapper
{
    /**
     * @param string $filename
     * @param string $data
     * @param int $flags
     * @param null $context
     */
    public function filePutContents(string $filename, string $data, int $flags = 0, $context = null): void
    {
        file_put_contents($filename, $data, $flags, $context);
    }

    public function fileGetContents(
        $filename,
        $useIncludePath = false,
        $context = null,
        $offset = 0
    ) {
        return file_get_contents($filename, $useIncludePath, $context, $offset);
    }

    public function fileExists($filename): bool
    {
        return file_exists($filename);
    }
}
