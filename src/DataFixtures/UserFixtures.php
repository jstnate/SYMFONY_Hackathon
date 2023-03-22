<?php

namespace App\DataFixtures;

use App\Entity\Station;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@mail.com');

        $password = $this->hasher->hashPassword($user, 'password');
        $user->setPassword($password);

        $user->setRoles([
            'ROLE_ADMIN'
        ]);

        $manager->persist($user);

        $stationRepository = $manager->getRepository(Station::class);
        $stations = $stationRepository->findAll();

        for($i = 1; $i <= 10; $i++) {
            $user = new User();

            $user->setStation($stations[$i - 1]);

            $user->setEmail('user' . $i . '@mail.com');

            $password = $this->hasher->hashPassword($user, 'password');
            $user->setPassword($password);
            $user->setRoles([]);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
