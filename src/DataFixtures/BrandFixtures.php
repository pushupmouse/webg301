<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Brand;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //$titles = ["ACER", "HP", "DELL", "ASUS", "MSI"];
        
        for ($i=0; $i < 10; $i++) {
            //$key = array_rand($titles,1)
            $brand = new Brand;
            //$brand->setTitle($titles[$key]);
            $brand->setName("Brand $i")
                  ->setDateFounded(DateTime::createFromFormat('Y/m/d', '2022/05/25'))
                  ->setImage("https://inkythuatso.com/uploads/thumbnails/800/2021/11/logo-asus-inkythuatso-2-01-26-09-21-11.jpg");
        }

        $manager->flush();
    }
}
