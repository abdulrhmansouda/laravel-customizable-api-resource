<?php
 
namespace LaravelCustomizableApiResource\Providers;
 
use Illuminate\Support\ServiceProvider;
 
final class PackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // if ($this->app->runningInConsole()) {
        //     $this->commands(
        //         commands: [
        //             DataTransferObjectMakeCommand::class,
        //         ],
        //     );
        // }
    }
} 