<?php

namespace App\Command;

use App\Entity\Person;
use App\Entity\Building;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add-data',
    description: 'test'
)]

class AddDataCommand extends Command
{
    protected static string  $defaultName = 'app:add-data';
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $building = new Building();
            $building->setName($faker->company);

            for ($j = 0; $j < random_int(1, 10); $j++) {
                $person = new Person();
                $person->setName($faker->name);
                $person->setBuilding($building);
                $this->entityManager->persist($person);
            }

            $this->entityManager->persist($building);
        }

        $this->entityManager->flush();

        $output->writeln('Données ajoutées avec succès.');

        return Command::SUCCESS;
    }
}
