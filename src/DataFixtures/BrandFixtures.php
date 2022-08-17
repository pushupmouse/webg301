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
        $cpbrands = ["ASUS", "DELL", "acer", "Razer", "MSI", "Lenovo", "HP"];
        $length = count($cpbrands);
        // for ($i=1; $i<=5; $i++) {
        //     $keycp = array_rand($cpbrands,1);
        //     $brand = new Brand;
        //     $brand->setName($cpbrands[$keycp])
        //         ->setDateFounded(DateTime::createFromFormat('Y/m/d', '2022/05/25'))
        //         ->setImage("https://inkythuatso.com/uploads/thumbnails/800/2021/11/logo-asus-inkythuatso-2-01-26-09-21-11.jpg");
        //     $manager->persist($brand);
        // }
        for($i=0; $i<$length; $i++){
            $brand = new brand;
            $brand->setName($cpbrands[$i])
                ->setDateFounded(DateTime::createFromFormat('Y/m/d', '2022/05/25'))
                ->setImage("https://inkythuatso.com/uploads/thumbnails/800/2021/11/logo-asus-inkythuatso-2-01-26-09-21-11.jpg");
            $manager->persist($brand);
        }

        $manager->flush();
    }
}