<?php
/**
 * Created by PhpStorm.
 * User: jdebray
 * Date: 04/02/2015
 * Time: 10:48
 */

namespace CCMLocatorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LocatorCommand  extends ContainerAwareCommand {
    protected function configure()
    {
        $this->setDefinition(array(
            new InputArgument('query', InputArgument::REQUIRED, 'an url query string')
        ))
            ->setName('ccm:locator')
            ->setDescription('gets all location by a query')
            ->setHelp(<<<EOF
The <info>%command.name%</info> get all addresses from any locator implemented
how to use it :

EOF
            )
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this->getContainer()->get('ccm_locator.chained_locator')->searchByKeyword($input->getArgument('query'));

        foreach ($result as $item) {
            $output->writeln($item['name']);
            $output->writeln($item['address']);
            $output->writeln('<comment>found by ' . $item['source'] . '</comment>');
            $output->writeln('===========================--=========================');
        }
    }
}