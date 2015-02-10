<?php namespace Jedrzej\CommandGenerator\Generators;

use ReflectionClass;
use Symfony\Component\Console\Input\InputArgument;
use Way\Generators\Commands\GeneratorCommand;

abstract class CommandGeneratorCommand extends GeneratorCommand {

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
        . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $this->getNamespace())
        . DIRECTORY_SEPARATOR . $this->getCommandFilename();
    }

    protected function getTemplatePath()
    {
        return $this->getTemplatesRoot() . 'command';
    }

    protected function getArguments()
    {
        return [
            ['namespace', InputArgument::REQUIRED, 'Namespace for the command'],
            ['model', InputArgument::REQUIRED, 'Model name'],
            ['attributes', InputArgument::OPTIONAL],
            ['action', InputArgument::OPTIONAL],
        ];
    }

    protected function getCommandFilename()
    {
        return $this->getCommandName() . '.php';
    }

    protected function getCommandName()
    {
        return sprintf('%s%sCommand', $this->getModel(), $this->getAction());
    }

    protected function getModel()
    {
        $class = new ReflectionClass($this->argument('model'));
        return $class->getShortName();
    }

    protected function getNamespace()
    {
        return $this->argument('namespace');
    }

    protected function getAttributes()
    {
        return array_except(preg_split('/,/', $this->argument('attributes', '')), 'id');
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
            'NAMESPACE'    => !empty($this->getNamespace()) ? sprintf('namespace %s;', $this->getNamespace()) : '',
            'COMMAND_NAME' => $this->getCommandName(),
            'ATTRIBUTES'   => [],
            'ASSIGNMENTS'  => [],
            'ARGUMENTS'    => [],
        ];

        return $data;
    }
}