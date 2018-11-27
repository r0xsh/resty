<?php

namespace App\Command;

use App\Scrappers\Scrapper;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TestCommand extends Command
{
    protected static $defaultName = 'app:test';

    /** @var Scrapper */
    private $scrapper;

    /**
     * @param Scrapper $scrapper
     */
    public function __construct(Scrapper $scrapper)
    {
        $this->scrapper = $scrapper;
        parent::__construct();
    }

    protected function configure()
    {

        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->text($this->scrapper->isValidScrapper($io->ask("scrapp")));

    }
}
