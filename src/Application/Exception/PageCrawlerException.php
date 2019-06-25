<?php

declare(strict_types=1);

namespace SocialFood\Application\Exception;

use Exception;

class PageCrawlerException extends Exception
{
    /** @var bool */
    private $isCritical;

    public function __construct(int $errorCode, bool $isCritical = true)
    {
        $this->isCritical = $isCritical;

        $errorMessages = require __DIR__ . '/../../../config/exceptions.conf.php';

        if (!isset($errorMessages[$errorCode])) {
            throw new Exception('The ErrorCode "' . $errorCode . '" does not exist in the exception config.');
        }

        parent::__construct($errorMessages[$errorCode], $errorCode);
    }

    public function isCritical(): bool
    {
        return $this->isCritical;
    }
}
