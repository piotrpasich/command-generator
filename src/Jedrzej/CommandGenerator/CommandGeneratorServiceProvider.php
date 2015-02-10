<?php namespace Jedrzej\CommandGenerator;

use Jedrzej\CommandGenerator\Generators\EventGeneratorCommand;
use Jedrzej\CommandGenerator\Generators\ModifyCommandGeneratorCommand;
use Jedrzej\CommandGenerator\Generators\ModifyCommandHandlerGeneratorCommand;
use Jedrzej\CommandGenerator\Generators\ModifyValidatorGeneratorCommand;
use Jedrzej\CommandGenerator\Generators\RemoveCommandGeneratorCommand;
use Jedrzej\CommandGenerator\Generators\RemoveCommandHandlerGeneratorCommand;
use Jedrzej\CommandGenerator\Generators\RemoveValidatorGeneratorCommand;
use Jedrzej\CommandGenerator\Generators\WriteCommandGeneratorCommand;
use Jedrzej\CommandGenerator\Generators\WriteCommandHandlerGeneratorCommand;
use Jedrzej\CommandGenerator\Generators\WriteValidatorGeneratorCommand;
use Illuminate\Support\ServiceProvider;

class CommandGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register the commands
     *
     * @return void
     */
    public function register()
    {
        foreach (
            [
                'Write',
                'Modify',
                'Remove',
            ] as $action
        ) {
            $this->{"register{$action}Command"}();
            $this->{"register{$action}CommandHandler"}();
            $this->{"register{$action}Validator"}();
        }

        $this->registerEvent();
    }

    protected function registerWriteCommand()
    {
        $this->app['generate.command.write'] =
            $this->app->share(function ($app) {
                $generator = $this->app->make('Way\Generators\Generator');

                return new WriteCommandGeneratorCommand($generator);
            });

        $this->commands('generate.command.write');
    }

    protected function registerModifyCommand()
    {
        $this->app['generate.command.modify'] =
            $this->app->share(function ($app) {
                $generator = $this->app->make('Way\Generators\Generator');

                return new ModifyCommandGeneratorCommand($generator);
            });

        $this->commands('generate.command.modify');
    }

    protected function registerRemoveCommand()
    {
        $this->app['generate.command.remove'] =
            $this->app->share(function ($app) {
                $generator = $this->app->make('Way\Generators\Generator');

                return new RemoveCommandGeneratorCommand($generator);
            });

        $this->commands('generate.command.remove');
    }

    protected function registerEvent()
    {
        $this->app['generate.event'] =
            $this->app->share(function ($app) {
                $generator = $this->app->make('Way\Generators\Generator');

                return new EventGeneratorCommand($generator);
            });

        $this->commands('generate.event');
    }

    protected function registerWriteValidator()
    {
        $this->app['generate.validator.write'] =
            $this->app->share(function ($app) {
                $generator = $this->app->make('Way\Generators\Generator');

                return new WriteValidatorGeneratorCommand($generator);
            });

        $this->commands('generate.validator.write');
    }

    protected function registerModifyValidator()
    {
        $this->app['generate.validator.modify'] =
            $this->app->share(function ($app) {
                $generator = $this->app->make('Way\Generators\Generator');

                return new ModifyValidatorGeneratorCommand($generator);
            });

        $this->commands('generate.validator.modify');
    }

    protected function registerRemoveValidator()
    {
        $this->app['generate.validator.remove'] =
            $this->app->share(function ($app) {
                $generator = $this->app->make('Way\Generators\Generator');

                return new RemoveValidatorGeneratorCommand($generator);
            });

        $this->commands('generate.validator.remove');
    }

    protected function registerWriteCommandHandler()
    {
        $this->app['generate.command.write-handler'] =
            $this->app->share(function ($app) {
                $generator = $this->app->make('Way\Generators\Generator');

                return new WriteCommandHandlerGeneratorCommand($generator);
            });

        $this->commands('generate.command.write-handler');
    }

    protected function registerModifyCommandHandler()
    {
        $this->app['generate.command.modify-handler'] =
            $this->app->share(function ($app) {
                $generator = $this->app->make('Way\Generators\Generator');

                return new ModifyCommandHandlerGeneratorCommand($generator);
            });

        $this->commands('generate.command.modify-handler');
    }

    protected function registerRemoveCommandHandler()
    {
        $this->app['generate.command.remove-handler'] =
            $this->app->share(function ($app) {
                $generator = $this->app->make('Way\Generators\Generator');

                return new RemoveCommandHandlerGeneratorCommand($generator);
            });

        $this->commands('generate.command.remove-handler');
    }
}
