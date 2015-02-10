<?php namespace Jedrzej\CommandGenerator\Generators;

use Symfony\Component\Console\Input\InputArgument;

class ValidatorGeneratorCommand extends CommandGeneratorCommand
{
    protected $name = 'generate:validator';

    protected $description = 'Generates validator';

    protected function getTemplateData()
    {
        $data = [
            'NAMESPACE'    => !empty($this->getNamespace()) ? sprintf('namespace %s;', $this->getNamespace()) : '',
            'NAME'      => $this->getValidatorName(),
            'RULES'     => [],
        ];

        return $data;
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

    protected function getValidatorFilename()
    {
        return $this->getValidatorName() . '.php';
    }

    protected function getValidatorName()
    {
        return sprintf('%s%sValidator', $this->getModel(),
            $this->getAction());
    }

    /**
     * Get the path to the generator template
     *
     * @return mixed
     */
    protected function getTemplatePath()
    {
        return $this->getTemplatesRoot() . 'validator';
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
        . DIRECTORY_SEPARATOR . $this->getValidatorFilename();
    }
}