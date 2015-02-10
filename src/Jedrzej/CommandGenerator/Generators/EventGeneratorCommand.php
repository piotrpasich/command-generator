<?php namespace Jedrzej\CommandGenerator\Generators;

use Illuminate\Support\Str;
use ReflectionClass;
use Symfony\Component\Console\Input\InputArgument;
use Way\Generators\Commands\GeneratorCommand;

class EventGeneratorCommand extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates event';

    protected function getArguments()
    {
        return [
            ['namespace', InputArgument::REQUIRED, 'Namespace for the event'],
            ['model', InputArgument::REQUIRED, 'Model fully qualified name'],
            ['name', InputArgument::REQUIRED, 'Event name'],
        ];
    }

    protected function getTemplateData()
    {
        $data = [
            'NAMESPACE' => !empty($this->getNamespace())
                ? sprintf('namespace %s;', $this->getNamespace()) : '',
            'NAME'      => $this->getEventName(),
            'MODEL'     => $this->getModel(),
            'MODEL_FQN' => $this->getModelFQN(),
            'INSTANCE'  => $this->getInstance()
        ];

        return $data;
    }

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
        . DIRECTORY_SEPARATOR . $this->getEventFilename();
    }

    /**
     * Get the path to the generator template
     *
     * @return mixed
     */
    protected function getTemplatePath()
    {
        return $this->getTemplatesRoot() . 'event';
    }

    protected function getTemplatesRoot()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
    }

    protected function getEventFilename()
    {
        return $this->getEventName() . '.php';
    }

    protected function getEventName()
    {
        return $this->argument('name');
    }

    protected function getNamespace()
    {
        return $this->argument('namespace');
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