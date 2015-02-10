<?php namespace Jedrzej\CommandGenerator\Generators;

class ModifyCommandHandlerGeneratorCommand extends HandlerGeneratorCommand
{
    protected $name = 'generate:handler:modify';

    protected $description = 'Generates Modify command handler';

    protected function getTemplateData()
    {
        $data = parent::getTemplateData();

        $data['PARAMETERS'] = '$command->id, (array)$command';

        return $data;
    }

    protected function getAction()
    {
        return ucfirst($this->argument('action') ?: 'modify');
    }
}