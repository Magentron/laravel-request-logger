<?php

namespace Prettus\RequestLogger\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Prettus\RequestLogger\ResponseLogger;

/**
 * Class LogTask.
 *
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class LogTask implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Response
     */
    protected $response;

    /**
     * LogTask constructor.
     *
     * @param Request  $request
     * @param Response $response
     */
    public function __construct($request, $response)
    {
        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var ResponseLogger $requestLogger */
        $requestLogger = app(ResponseLogger::class);
        $requestLogger->log($this->request, $this->response);
    }
}
