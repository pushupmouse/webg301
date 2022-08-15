<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //$ct = ["Laptop", "Ultraportable", "Ultrabook", "Chromebook", "MacBook", "Convertible", "Tablet", "Netbook"];
        
        for ($i=1; $i<=20; $i++) {
            //$keyct = array_rand($ct,1)
            $category = new Category();
            //$brand->setCt($ct[$keyct]);
            $brand->setName("Category $i");
            //fdfdfddffd
        }

        $manager->flush();
    }
}
