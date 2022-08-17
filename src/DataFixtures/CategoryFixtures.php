<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ct = ["Notebook", "Ultraportable", "Ultrabook", "Chromebook", "MacBook", "Convertible", "Tablet", "Netbook"];
        $length = count($ct);
        for ($i=0; $i<$length; $i++) {
            $category = new Category;
            $category->setName($ct[$i]);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
