<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $now = new \DateTimeImmutable();

        $alice = new User();
        $alice->setEmail('alice@example.fr');
        $alice->setPassword($this->passwordHasher->hashPassword($alice, 'motdepasse'));
        $alice->setCreatedAt($now);
        $manager->persist($alice);

        $bob = new User();
        $bob->setEmail('bob@example.fr');
        $bob->setPassword($this->passwordHasher->hashPassword($bob, 'motdepasse'));
        $bob->setCreatedAt($now);
        $manager->persist($bob);

        $camille = new User();
        $camille->setEmail('camille.aubert@example.fr');
        $camille->setFirstName('Camille');
        $camille->setLastName('Aubert');
        $camille->setPassword($this->passwordHasher->hashPassword($camille, 'motdepasse'));
        $camille->setCreatedAt(new \DateTimeImmutable('2026-02-04'));
        $manager->persist($camille);

        $cityNames = ['Paris', 'Lyon', 'Marseille', 'Bordeaux', 'Lille', 'Strasbourg', 'Toulouse', 'Nantes', 'Dijon', 'Brest'];

        foreach ($cityNames as $cityName) {
            $city = new City();
            $city->setName($cityName);
            $city->setCreatedAt($now);
            $manager->persist($city);
        }

        $manager->flush();
    }
}
