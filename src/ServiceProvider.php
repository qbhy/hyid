<?php
/**
 * User: qbhy
 * Date: 2018/10/16
 * Time: 上午11:06
 */

namespace Qbhy\Hyid;

use \Illuminate\Support\ServiceProvider as BaseProvider;

use Laravel\Lumen\Application;

class ServiceProvider extends BaseProvider
{
    public function setupConfig()
    {
        $configSource = realpath(__DIR__ . '/../config/hyid.php');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $configSource => base_path('config/hyid.php')
            ]);
        }

        if ($this->app instanceof Application) {
            $this->app->configure('hyid');
        }

        $this->mergeConfigFrom($configSource, 'hyid');
    }

    public function register()
    {
        $this->setupConfig();

        $this->app->singleton(Hyid::class, function () {
            return new Hyid(config('hyid.secret'), config('hyid.offset'));
        });

        $this->app->alias(Hyid::class, 'hyid');
    }
}