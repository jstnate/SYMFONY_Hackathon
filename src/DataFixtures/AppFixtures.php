<?php

namespace App\DataFixtures;

use App\Entity\Domain;
use App\Entity\Lift;
use App\Entity\Station;
use App\Entity\Track;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 10; $i++) {
            $domain = new Domain();
            $domain->setLogo('url logo domain m' . $i);
            $domain->setDescription('description domain m' . $i);
            $manager->persist($domain);
        }
        $manager->flush();

        $domainRepository = $manager->getRepository(Domain::class);
        $domains = $domainRepository->findAll();

        for($i = 1; $i <= 50; $i++) {
            $station = new Station();
            $station->setDescription('description for station n' . $i);
            $station->setLogo('logo for station n' . $i);
            $station->setName('Station n' . $i);
            $station->setDomain($domains[random_int(0, count($domains) - 1)]);
            $manager->persist($station);
        }
        $manager->flush();

        $liftRepository = $manager->getRepository(Lift::class);
        $lifts = $liftRepository->findAll();

        for($i = 1; $i <= 200; $i++) {
            $lift = new Lift();
            $lift->setOpening(new \DateTime('8:00:00'));
            $lift->setClosing(new \DateTime('17:00:00'));
            $manager->persist($lift);
        }
        $manager->flush();
    }
}
