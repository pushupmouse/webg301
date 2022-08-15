<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //$ct = ["Laptop", "Ultraportable", "Ultrabook", "Chromebook", "MacBook", "Convertible", "Tablet", "Netbook"];
        
        for ($i=1; $i<=20; $i++) {
            //$keyct = array_rand($ct,1)
            $category = new Category();
            //$brand->setCt($ct[$keyct]);
            $category->setName("Category $i");
            
        }

        $manager->flush();
    }
}
