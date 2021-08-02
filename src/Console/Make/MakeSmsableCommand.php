<?php

namespace HirbodKhatami\SmsPackage\Console\Make;

use Illuminate\Console\GeneratorCommand;

class MakeSmsableCommand extends GeneratorCommand
{
    protected $name = 'make:smsable';

    protected $description = 'Create a new Smsable class';

    protected $type = 'sms';

    protected function getStub()
    {
        return __DIR__ . '/Smsable.php.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Smsables';
    }

    public function handle()
    {
        parent::handle();

        $this->doOtherOperations();
    }

    protected function doOtherOperations()
    {
        // Get the fully qualified class name (FQN)
        $class = $this->qualifyClass($this->getNameInput());

        // get the destination path, based on the default namespace
        $path = $this->getPath($class);

        $content = file_get_contents($path);

        // Update the file content with additional data (regular expressions)

        file_put_contents($path, $content);
    }
}