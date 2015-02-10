<?php namespace Jedrzej\CommandGenerator\Generators;

use Illuminate\Support\Str;
use ReflectionClass;
use Symfony\Component\Console\Input\InputArgument;
use Way\Generators\Commands\GeneratorCommand;

abstract class HandlerGeneratorCommand extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description;

    /**
     * The path where the file will be created
     *
     * @return mixed
     */
    protected function getFileGenerationPath()
    {
        return app_path()
        . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR,
            $this->getNamespace())
        . DIRECTORY_SEPARATOR . $this->getHandlerFilename();
    }

    protected function getTemplatePath()
    {
        return $this->getTemplatesRoot() . 'handler';
    }

    protected function getArguments()
    {
        return [
            ['namespace', InputArgument::REQUIRED, 'Namespace for the handler'],
            ['model', InputArgument::REQUIRED, 'Model name'],
            ['attributes', InputArgument::OPTIONAL],
            ['action', InputArgument::OPTIONAL],
        ];
    }

    protected function getHandlerFilename()
    {
        return $this->getHandlerName() . '.php';
    }

    protected function getHandlerName()
    {
        return sprintf('%s%sCommandHandler', $this->getModel(),
            $this->getAction());
    }

    protected function getNamespace()
    {
        return $this->argument('namespace');
    }

    protected function getAttributes()
    {
        return array_except(preg_split('/,/',
            $this->argument('attributes', '')), 'id');
    }

    protected function getTemplatesRoot()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
    }

    protected function getTemplateData()
    {
        $data = [
            'NAMESPACE'    => !empty($this->getNamespace())
                ? sprintf('namespace %s;', $this->getNamespace()) : '',
            'HANDLER_NAME' => $this->getHandlerName(),
            'PARAMETERS'   => [],
            'INSTANCE'     => $this->getInstance(),
            'ACTION'       => Str::snake($this->getAction()),
            'MODEL'        => $this->getModel(),
            'MODEL_FQN'    => $this->getModelFQN(),
        ];

        return $data;
    }

    protected function getModel()
    {
        $class = new ReflectionClass($this->argument('model'));
        return $class->getShortName();
    }

    protected function getModelFQN()
    {
        return $this->argument('model');
    }

    protected function getInstance()
    {
        $class = new ReflectionClass($this->argument('model'));
        return Str::snake($class->getShortName());
    }
}