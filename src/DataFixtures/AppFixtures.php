<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $users = new Users;
            $users->setName('User ' . $i);
            $users->setEmail('user@user.com');
            $users->setPassword('unpassword');
            $users->setDescription('une description');
            $manager->persist($users);
    }
    $manager->flush();
}
}