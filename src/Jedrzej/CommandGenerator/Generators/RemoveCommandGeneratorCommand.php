<?php namespace Jedrzej\CommandGenerator\Generators;

class RemoveCommandGeneratorCommand extends CommandGeneratorCommand
{
    protected $name = 'generate:command:remove';

    protected $description = 'Generates Remove command';

    protected function getTemplateData()
    {
        $data = parent::getTemplateData();

        $data['ARGUMENTS'] = '$id';
        $data['ATTRIBUTES'] = 'public $id;';
        $data['ASSIGNMENTS'] = '$this->id = $id;';

        return $data;
    }

    protected function getAction()
    {
        return ucfirst($this->argument('action') ?: 'remove');
    }
}