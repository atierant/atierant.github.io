<?php

// src/Command/HelloCommand.php
namespace App\Command;
// ...
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\InputStream;
use Symfony\Component\Process\Process;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:hello')]
class HelloCommand extends Command
{
    /**
     * @param LoggerInterface $logger
     */
    public function __construct(private readonly LoggerInterface $logger)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $executableFinder = new ExecutableFinder();
        $nodePath = $executableFinder->find('node');

        $finder = new Finder();
        $finder->in(__DIR__.'/../../vendor/stenope/stenope/dist/bin')->files()->name('prism.js');

        // check if there are any search results
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $absoluteFilePath = $file->getRealPath();
            }
        }

        $language = 'php';
        $value = <<<'END'
<?php $foo = true;
\n
END;
        $input = new InputStream();
        $json_encode = json_encode(['language' => $language, 'value' => $value]);
        echo $json_encode;

        $process = new Process([
            $nodePath,
            $absoluteFilePath
        ], null, null, $input, 30);

        $process->start(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo 'ERR > '.$buffer;
                $this->logger->alert('ERR > '.$buffer);
            } else {
                echo 'OUT > '.$buffer;
                $this->logger->alert('OUT > '.$buffer);
            }
        });

        $input->write(
            $json_encode . PHP_EOL
        );

        $input->close();

        $process->wait();

// will echo: foobar
        echo $process->getOutput();



        // Depuis Symfony 5.2, vous pouvez utiliser directement la variable Command::SUCCESS
        return Command::SUCCESS;
    }
}
