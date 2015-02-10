<?php namespace Jedrzej\CommandGenerator\Generators;

class WriteCommandGeneratorCommand extends CommandGeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:command:write';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Write command';

    protected function getTemplateData()
    {
        $data = parent::getTemplateData();

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
        return ucfirst($this->argument('action') ?: 'write');
    }
}