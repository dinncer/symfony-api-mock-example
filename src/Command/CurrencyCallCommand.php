<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Currency;

class CurrencyCallCommand extends Command
{
    /**
     * @var
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    /**
     * @var string
     */
    protected static $defaultName = 'currency:call';

    /**
     * @return mixed
     */
    protected function configure()
    {
        $this
            ->setDescription('Add exchange rates from the API services to the database')
            ->setHelp('Fetch the exchange rates. Does not take additional parameters and arguments.')
        ;
    }

    /**
     * Add exchange rates from the API services to the database.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        
        $providers = [
            '\App\Service\Provider\ExampleCurrencyProvider',
            '\App\Service\Provider\OtherCurrencyProvider'
        ];

        foreach ($providers as $provider) {
            $currencyProvider = new $provider();
            $this->record($currencyProvider->request());
        }

        $io->success('Currency rates have been added to the database.');
    }

    /**
     * Add to database.
     *
     * @param  array $currencyList
     * @return null
     */
    protected function record($currencyList)
    {
        $product = new Currency();
        $product
            ->setUsd($currencyList->usd)
            ->setEuro($currencyList->euro)
            ->setGbp($currencyList->gbp)
            ;

        $this->em->persist($product);
        $this->em->flush();
    }
}
