<?php namespace Jedrzej\CommandGenerator\Generators;

class RemoveCommandHandlerGeneratorCommand extends HandlerGeneratorCommand
{
    protected $name = 'generate:handler:remove';

    protected $description = 'Generates Remove command handler';

    protected function getTemplateData()
    {
        $data = parent::getTemplateData();

        $data['PARAMETERS'] = '$command->id';

        return $data;
    }

    protected function getAction()
    {
        return ucfirst($this->argument('action') ?: 'remove');
    }
}