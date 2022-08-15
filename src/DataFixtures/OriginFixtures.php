<?php

namespace App\DataFixtures;

use App\Entity\Origin;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class OriginFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //$country = ["America", "France", "China", "Germany", "Japan"];

        for ($i=0; $i < 10; $i++) {
            //$key = array_rand($titles,1)
            $origin = new Origin;
            //$brand->setTitle($titles[$key]);
            $origin->setName("Origin $i")
                  ->setImage("https://preview.redd.it/1jnsfe05vjg21.jpg?auto=webp&s=aaaa7fb926c3ea6c7f92b278d1050d206d78c0bb");
            $manager->persist($origin);
        }

        $manager->flush();
    }
}
