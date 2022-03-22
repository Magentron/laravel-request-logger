<?php

namespace Prettus\RequestLogger;

use Illuminate\Log\LogManager;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;

/**
 * Class Logger.
 *
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class Logger implements LoggerInterface
{
    /**
     * @var LoggerInterface;
     */
    protected $logger;

    public function __construct()
    {
        /** @var LogManager $logManager */
        $logManager = app('log');

        $this->logger = clone $logManager->getLogger();

        if (config('request-logger.logger.enabled') && $handlers = config('request-logger.logger.handlers')) {
            if (count($handlers)) {
                //Remove default laravel handler
                $this->logger->popHandler();

                foreach ($handlers as $handler) {
                    if (class_exists($handler)) {
                        $this->logger->pushHandler(app($handler));
                    } else {
                        throw new \Exception("Handler class [{$handler}] does not exist");
                    }
                }
            }
        }
    }

    /**
     * Log an error message to the logs.
     *
     * @param string $message
     * @param array  $context
     */
    public function emergency($message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }

    /**
     * Log an alert message to the logs.
     *
     * @param string $message
     * @param array  $context
     */
    public function alert($message, array $context = [])
    {
        $this->logger->alert($message, $context);
    }

    /**
     * Log a critical message to the logs.
     *
     * @param string $message
     * @param array  $context
     */
    public function critical($message, array $context = [])
    {
        $this->logger->critical($message, $context);
    }

    /**
     * Log an error message to the logs.
     *
     * @param string $message
     * @param array  $context
     */
    public function error($message, array $context = [])
    {
        $this->logger->error($message, $context);
    }

    /**
     * Log a warning message to the logs.
     *
     * @param string $message
     * @param array  $context
     */
    public function warning($message, array $context = [])
    {
        $this->logger->warning($message, $context);
    }

    /**
     * Log a notice to the logs.
     *
     * @param string $message
     * @param array  $context
     */
    public function notice($message, array $context = [])
    {
        $this->logger->notice($message, $context);
    }

    /**
     * Log an informational message to the logs.
     *
     * @param string $message
     * @param array  $context
     */
    public function info($message, array $context = [])
    {
        $this->logger->info($message, $context);
    }

    /**
     * Log a debug message to the logs.
     *
     * @param string $message
     * @param array  $context
     */
    public function debug($message, array $context = [])
    {
        $this->logger->debug($message, $context);
    }

    /**
     * Log a message to the logs.
     *
     * @param string|int $level
     * @param string     $message
     * @param array      $context
     */
    public function log($level, $message, array $context = [])
    {
        $this->logger->log($level, $message, $context);
    }
}
