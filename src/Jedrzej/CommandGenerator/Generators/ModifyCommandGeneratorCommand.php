<?php namespace Jedrzej\CommandGenerator\Generators;

class ModifyCommandGeneratorCommand extends CommandGeneratorCommand
{
    protected $name = 'generate:command:modify';

    protected $description = 'Generates Modify command';

    protected function getTemplateData()
    {
        $data = parent::getTemplateData();

        $data['ARGUMENTS'][] = '$id';
        $data['ATTRIBUTES'][] = 'public $id;';
        $data['ASSIGNMENTS'][] = '$this->id = $id;';

        foreach ($this->getAttributes() as $attribute) {
            $data['ARGUMENTS'][] = sprintf('$%s', $attribute);
            $data['ATTRIBUTES'][] = sprintf('public $%s;', $attribute);
            $data['ASSIGNMENTS'][] = sprintf('$this->%1$s = $%1$s;', $attribute);
        }

        $data['ARGUMENTS'] = implode(', ', $data['ARGUMENTS']);
        $data['ATTRIBUTES'] = implode(PHP_EOL . PHP_EOL . '    ', $data['ATTRIBUTES']);
        $data['ASSIGNMENTS'] = implode(PHP_EOL . '        ', $data['ASSIGNMENTS']);

        return $data;
    }

    protected function getAction()
    {
        return ucfirst($this->argument('action') ?: 'modify');
    }
}