<?php

namespace App\DataFixtures;
use App\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        // ...
        $user->setRole();
         $user->setPassword($this->passwordEncoder->encodePassword(             
         $user,
             'password'
         ));
        $manager->flush();
    }
}
