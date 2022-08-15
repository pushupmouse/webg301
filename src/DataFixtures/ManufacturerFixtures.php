<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ManufacturerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 10; $i++) { 
            $manufacturer = new Manufacturer;
            $manufacturer->setName("Manufacturer $i");
            $manufacturer->setAddress("USA, New York");
            $manufacturer->setImage("https://www.llentab.com/references/llentab-data/pl/500x380/8915_6d0e6795-bd66-407a-afae-5a705dfd134b.jpg");
            $manager->persist($manufacturer);
        }

        $manager->flush();
    }
}
