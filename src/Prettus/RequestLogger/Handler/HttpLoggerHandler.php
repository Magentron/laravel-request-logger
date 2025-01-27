<?php

namespace Prettus\RequestLogger\Handler;

use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * Class HttpLoggerHandler.
 *
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class HttpLoggerHandler extends RotatingFileHandler implements HandlerInterface
{
    /**
     * @param string|null $filename
     * @param int         $maxFiles
     * @param int         $level
     * @param bool        $bubble
     * @param int|null    $filePermission
     * @param bool        $useLocking
     */
    public function __construct($filename = null, $maxFiles = 0, $level = Logger::DEBUG, $bubble = true, $filePermission = null, $useLocking = false)
    {
        $filename = !is_null($filename) ? $filename : config('request-logger.logger.file', storage_path('logs/http.log'));
        parent::__construct($filename, $maxFiles, $level, $bubble, $filePermission, $useLocking);
    }
}
