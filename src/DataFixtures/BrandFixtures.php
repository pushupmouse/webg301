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
        $cpbrands = ["ASUS", "DELL", "Acer", "Razer", "MSI", "Lenovo", "HP"];
        $image = ["https://inkythuatso.com/uploads/thumbnails/800/2021/11/logo-asus-inkythuatso-2-01-26-09-21-11.jpg",
            "https://koreaprofessional.com/wp-content/uploads/2020/12/Dell-Logo.png",
            "https://brandlogos.net/wp-content/uploads/2014/10/acer-logo_brandlogos.net_qsj9a.png",
            "https://w1.pngwing.com/pngs/166/143/png-transparent-mouse-computer-keyboard-computer-mouse-razer-inc-laptop-razer-blade-15-razer-orochi-razer-raiju.png",
            "https://logos-world.net/wp-content/uploads/2020/11/MSI-Logo.png",
            "https://i.insider.com/556c53886bb3f7790ecba7ad?width=1000&format=jpeg&auto=webp",
            "https://brandcentral.hp.com/content/dam/sites/brand-central/elem-logo/images/Logo_1_dont.jpeg"];
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
                ->setImage($image[$i]);
            $manager->persist($brand);
        }

        $manager->flush();
    }
}