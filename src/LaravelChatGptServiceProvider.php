<?php


namespace Gouda\LaravelChatgpt;

use Illuminate\Support\ServiceProvider;

class LaravelChatGptServiceProvider extends ServiceProvider
{
    public function boot()
    {

//        if($this->app->runningInConsole())
//        {
//            $this->commands([
//            ]);
//        }

        $this->loadMigrationsFrom([
            __DIR__ . '/../Database/migrations'
        ]);

        $this->publishes([
            __DIR__ . '/../config/ChatGPT.php' => config_path('chatGPT.php'),
        ], 'chat-gpt-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ChatGPT.php', 'chatGPT');


    }

}