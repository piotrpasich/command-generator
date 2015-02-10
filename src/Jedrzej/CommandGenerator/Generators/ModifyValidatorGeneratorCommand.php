<?php namespace Jedrzej\CommandGenerator\Generators;


class ModifyValidatorGeneratorCommand extends ValidatorGeneratorCommand {

    protected $name = 'generate:validator:modify';

    protected $description = 'Generates modify validator';

    protected function getTemplateData()
    {
        $data = parent::getTemplateData();

        $data['RULES'][] = "'id' => '',";
        foreach ($this->getAttributes() as $attribute) {
            $data['RULES'][] = sprintf("'%s' => '',", $attribute);
        }

        $data['RULES'] = implode(PHP_EOL . '        ', $data['RULES']);

        return $data;
    }

    protected function getAction()
    {
        return ucfirst($this->argument('action') ?: 'modify');
    }
}