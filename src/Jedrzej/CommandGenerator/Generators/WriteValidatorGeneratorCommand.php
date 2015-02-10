<?php namespace Jedrzej\CommandGenerator\Generators;


class WriteValidatorGeneratorCommand extends ValidatorGeneratorCommand {

    protected $name = 'generate:validator:write';

    protected $description = 'Generates write validator';

    protected function getTemplateData()
    {
        $data = parent::getTemplateData();

        foreach ($this->getAttributes() as $attribute) {
            $data['RULES'][] = sprintf("'%s' => '',", $attribute);
        }

        $data['RULES'] = implode(PHP_EOL . '        ', $data['RULES']);

        return $data;
    }

    protected function getAction()
    {
        return ucfirst($this->argument('action') ?: 'write');
    }
}