<?php

namespace Kraken\_Unit\Console\Client\Command\Runtime;

use Kraken\_Unit\Console\Client\_T\TCommand;
use Kraken\Console\Client\Command\Runtime\RuntimeDestroyCommand;
use Kraken\Runtime\Runtime;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RuntimeDestroyCommandTest extends TCommand
{
    /**
     * @var string
     */
    protected $class = RuntimeDestroyCommand::class;

    /**
     *
     */
    public function testApiConfig_ConfiguresCommand()
    {
        $command = $this->createCommand();

        $args = [];
        $args[] = [ 'parent', InputArgument::REQUIRED ];
        $args[] = [ 'alias',  InputArgument::REQUIRED ];

        $opts = [];
        $opts[] = [ 'flags', null, InputOption::VALUE_OPTIONAL, '#^(.*?)$#', Runtime::DESTROY_FORCE_SOFT ];

        $this->assertCommand($command, 'runtime:destroy', '#^(.*?)$#si', $args, $opts);
    }

    /**
     *
     */
    public function testApiCommand_ReturnsCommandData()
    {
        $command  = $this->createCommand([ 'validateDestroyFlags' ]);
        $command
            ->expects($this->once())
            ->method('validateDestroyFlags')
            ->will($this->returnArgument(0));

        $input    = $this->createInputMock();
        $output   = $this->createOutputMock();

        $result   = $this->callProtectedMethod($command, 'command', [ $input, $output ]);
        $expected = [
            'parent',
            'runtime:destroy',
            [
                'alias' => 'alias',
                'flags' => 'flags'
            ]
        ];

        $this->assertSame($expected, $result);
    }
}
