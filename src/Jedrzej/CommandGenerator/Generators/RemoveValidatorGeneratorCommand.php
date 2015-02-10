<?php namespace Jedrzej\CommandGenerator\Generators;


class RemoveValidatorGeneratorCommand extends ValidatorGeneratorCommand {

    protected $name = 'generate:validator:remove';

    protected $description = 'Generates remove validator';

    protected function getTemplateData()
    {
        $data = parent::getTemplateData();

        $data['RULES']  =  "'id' => ''";

        return $data;
    }

    protected function getAction()
    {
        return ucfirst($this->argument('action') ?: 'remove');
    }
}