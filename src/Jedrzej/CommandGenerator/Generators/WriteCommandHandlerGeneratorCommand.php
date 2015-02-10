<?php namespace Jedrzej\CommandGenerator\Generators;

class WriteCommandHandlerGeneratorCommand extends HandlerGeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:handler:write';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Write command handler';

    protected function getTemplateData()
    {
        $data = parent::getTemplateData();

        foreach ($this->getAttributes() as $attribute) {
            $data['PARAMETERS'][] = sprintf('$command->%s', $attribute);
        }

        $data['PARAMETERS'] = implode(",\n            ", $data['PARAMETERS']);

        return $data;
    }

    protected function getAction()
    {
        return ucfirst($this->argument('action') ?: 'write');
    }
}