<?php

namespace App\Command;

use DOMDocument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:transform-sitemap',
    description: 'Add a short description for your command',
)]
class SitemapTransformerCommand extends Command
{
    public function __construct(
        readonly private string $projectDir,
        string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'Argument description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $file = $input->getArgument('file');

        // Load the XML source
        $xml = new DOMDocument();
        $filepath = $this->projectDir . DIRECTORY_SEPARATOR . $file;
        $xml->load($filepath);

        $root = $xml->documentElement; // This can differ (I am not sure, it can be only documentElement or documentElement->firstChild or only firstChild)

        $urls = $root->getElementsByTagName('url');

        // Loop trough childNodes
        foreach ($urls as $url) {
            $loc = $url->getElementsByTagName('loc')->item(0);
            $value = $loc->nodeValue;
            $ext = pathinfo($value, PATHINFO_EXTENSION);
            if (in_array($ext, ['xml'], true)) {
                continue;
            }

            if (str_ends_with($value, '/')) {
                continue;
            }

            $loc->nodeValue = $value . '/';

            $url->replaceChild($loc, $loc);
        }

        $xml->save($filepath);

        return Command::SUCCESS;
    }
}
