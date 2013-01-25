<?php

namespace NoM\Bundle\CMSBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use WowApi\Client;
use WowApi\Request\Curl;

class FetchCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
                ->setName('CMSBundle:Fetch')
                ->setDescription('Fetch all wow data from the API');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $request = new Curl();
        $api = new Client();
        $api->setRequest($request);
        $api->setRegion('eu', 'en_GB');

        $data = $api->getGuildApi()->getGuild('turalyon', 'non omnis moriar', true);

        var_dump($data);

        $output->writeln('');
    }
}
