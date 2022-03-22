<?php

namespace Prettus\RequestLogger\Providers;

use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Prettus\RequestLogger\Helpers\Benchmarking;
use Prettus\RequestLogger\Jobs\LogTask;

/**
 * Class LoggerServiceProvider.
 *
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class LoggerServiceProvider extends ServiceProvider
{
    use DispatchesJobs;

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../../resources/config/request-logger.php' => config_path('request-logger.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../../../resources/config/request-logger.php',
            'request-logger'
        );

        Benchmarking::start('application');

        /** @var Dispatcher $dispatcher */
        $dispatcher = app('events');

        $dispatcher->listen(RequestHandled::class, function (RequestHandled $event) {
            Benchmarking::end('application');

            if (!$this->excluded($event->request)) {
                $task = new LogTask($event->request, $event->response);

                if ($queueName = config('request-logger.queue')) {
                    $this->dispatch(is_string($queueName) ? $task->onQueue($queueName) : $task);
                } else {
                    $task->handle();
                }
            }
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Check whether request should be excluded from logging.
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function excluded(Request $request)
    {
        /** @var string[]|null $exclude */
        $exclude = config('request-logger.exclude');

        if (null === $exclude || empty($exclude)) {
            return false;
        }

        foreach ($exclude as $path) {
            if ($request->is($path)) {
                return true;
            }
        }

        return false;
    }
}
