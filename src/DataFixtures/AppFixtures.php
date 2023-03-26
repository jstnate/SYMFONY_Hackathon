<?php

namespace App\DataFixtures;

use App\Entity\Clutter;
use App\Entity\Difficulty;
use App\Entity\Domain;
use App\Entity\Level;
use App\Entity\Lift;
use App\Entity\Material;
use App\Entity\Station;
use App\Entity\Track;
use App\Entity\Type;
use App\Entity\User;
use App\Repository\ClutterRepository;
use App\Repository\DifficultyRepository;
use App\Repository\DomainRepository;
use App\Repository\LevelRepository;
use App\Repository\MaterialRepository;
use App\Repository\TypeRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {

    }
    public function load(ObjectManager $manager): void
    {
        foreach (['ski', 'snowboard'] as $key) {
            $material = new Material();
            $material->setTitle($key);
            $manager->persist($material);
        }
        foreach (['télésiège', 'tire-fesses'] as $key) {
            $type = new Type();
            $type->setTitle($key);
            $manager->persist($type);
        }
        foreach (['débutant', 'intermédiaire', 'avancé', 'confirmé', 'expert'] as $key) {
            $level = new Level();
            $level->setTitle($key);
            $manager->persist($level);
        }
        foreach (['bleue', 'verte', 'rouge', 'noire'] as $key) {
            $difficulty = new Difficulty();
            $difficulty->setTitle($key);
            $manager->persist($difficulty);
        }
        foreach (['faible', 'fort', 'bouchée'] as $key) {
            $clutter = new Clutter();
            $clutter->setTitle($key);
            $manager->persist($clutter);
        }

        foreach (['Les 3 Vallées', 'Les Portes du Soleil', 'Paradiski', 'La Voie Lactée', 'Les Sybelles', "Tignes-Val d'Isères", 'Serre Chevalier'] as $key) {
            $domain = new Domain();
            $domain->setName($key);
            $domain->setDescription('Ceci est la description de ce domaine de ski');
            $manager->persist($domain);
        }

        $manager->flush();

        $domainRepository = $manager->getRepository(Domain::class);
        $domains = $domainRepository->findAll();

        for ($i = 0; $i < 70; $i++) {
            $station = new Station();
            $station->setName('Station ' . $i);
            $station->setDomain($domains[random_int(0, count($domains) - 1)]);
            $manager->persist($station);
        }

        $manager->flush();

        $materialRepository = $manager->getRepository(Material::class);
        $materials = $materialRepository->findAll();
        $typeRepository = $manager->getRepository(Type::class);
        $types = $typeRepository->findAll();
        $levelRepository = $manager->getRepository(Level::class);
        $levels = $levelRepository->findAll();
        $difficultyRepository = $manager->getRepository(Difficulty::class);
        $difficulties = $difficultyRepository->findAll();
        $clutterRepository = $manager->getRepository(Clutter::class);
        $clutters = $clutterRepository->findAll();
        $stationRepository = $manager->getRepository(Station::class);
        $stations = $stationRepository->findAll();

        $openingTime = '08:30';
        $closingTime = '18:00';

        for ($i = 0; $i < 700; $i++) {
            $track = new Track();
            $track->setName('Track ' . $i);
            $track->setStation($stations[random_int(0, count($stations) - 1)]);
            $track->setClosing(DateTime::createFromFormat('H:i', $closingTime));
            $track->setOpening(DateTime::createFromFormat('H:i', $openingTime));
            $track->setClutter($clutters[random_int(0, count($clutters) - 1)]);
            $track->setLevel($levels[random_int(0, count($levels) - 1)]);
            $track->setDifficulty($difficulties[random_int(0, count($difficulties) - 1)]);
            $track->setMaterial($materials[random_int(0, count($materials) - 1)]);

            if(random_int(1, 8) === 8) {
                $track->setMessage('Fermé pour des raisons techniques');
                $track->setForcedClosure(true);
            }

            $manager->persist($track);
        }

        for ($i = 0; $i < 700; $i++) {
            $lift = new Lift();
            $lift->setName('Lift ' . $i);
            $lift->setStation($stations[random_int(0, count($stations) - 1)]);
            $lift->setClosing(DateTime::createFromFormat('H:i', $closingTime));
            $lift->setOpening(DateTime::createFromFormat('H:i', $openingTime));
            $lift->setClutter($clutters[random_int(0, count($clutters) - 1)]);
            $lift->setType($types[random_int(0, count($types) - 1)]);

            if(random_int(1, 8) === 8) {
                $lift->setMessage('Fermé pour des raisons techniques');
                $lift->setForcedClosure(true);
            }

            $manager->persist($lift);
        }

        $manager->flush();

        foreach ($stations as $key) {
            $user = new User();
            $user->setStation($key);
            $user->setEmail($key->getName() . '@admin.fr');
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $user,
                    'password'
                )
            );

            $manager->persist($user);
        }

        $superAdmin = new User();
        $superAdmin->setEmail('user@superadmin.fr');
        $superAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $superAdmin->setPassword(
            $this->userPasswordHasher->hashPassword(
                $superAdmin,
                'password'
            )
        );

        $manager->persist($superAdmin);

        $manager->flush();
    }
}
