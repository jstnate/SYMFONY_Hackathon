<?php

namespace App\DataFixtures;

use App\Entity\Domain;
use App\Entity\Difficulty;
use App\Entity\Track;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $difficulties = ['easy', 'medium', 'hard', 'very hard'];
        foreach ($difficulties as $difficulty) {
            $TrackDifficulty = new Difficulty();
            $TrackDifficulty->setTitle($difficulty);
            $manager->persist($TrackDifficulty);
        }

        for ($i = 1; $i <= 10; $i++) {
            $domain = new Domain();
//            $domain->setName('Domain n ' . $i);
            $domain->setDescription('Description od domain n ' . $i);
            $domain->setLogo('url logo domain n ' . $i);
            $manager->persist($domain);
        }
        $manager->flush();


        $domainRepository = $manager->getRepository(Domain::class);
        $domains = $domainRepository->findAll();

        $trackDifficultyRepository = $manager->getRepository(TrackDiffuclty::class);
        $trackDifficulties = $trackDifficultyRepository->findAll();

        for ($i = 1; $i <= 50; $i++) {
            $track = new Track();
            $track->setDifficulty($trackDifficulties[random_int(0, count($trackDifficulties) - 1)]);
            $date = new DateTime();
            $track->setOpening($date);
//            $track->setClosure($date);
//            $track->setDomain($domains[random_int(0, count($domains) - 1)]);
            $manager->persist($track);
        }
        $manager->flush();
    }
}
