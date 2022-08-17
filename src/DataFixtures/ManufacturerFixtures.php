<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ManufacturerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $titles = ["Flows", "Dior", "Victoria", "Deja Vu", "Momentum"];
        $address = ["Green Avenue 13", "209 Doi Can", "Fountain Square 45", "Riverside 20", "Route 40"];
        $image = ["https://www.llentab.com/references/llentab-data/pl/500x380/8915_6d0e6795-bd66-407a-afae-5a705dfd134b.jpg",
        "https://www.toshiba-tpsc.co.jp/images/business/project/production-plant_15_sp.jpg",
        "https://seico.vn/public/uploads/images/Anh-bai-viet-dong/Du-an/Du%20An%20Cong%20Nghiep/2013/Nissin%20Manufacturing/Nissin%20Manufacturing%20Slide%201.JPG",
        "https://obayashivn.com/Data/Sites/1/News/370/1--general-view---north-east-side.jpg",
        "https://dinco.com.vn/resources/dinco/upload/products/slider/76/800x800190723_BVN_B01_3D-VIEW-03.jpg"];

        // for ($i=0; $i < 10; $i++) { 
        //     $keytt = array_rand($titles,1);
        //     $manufacturer = new Manufacturer;
        //     $manufacturer->setName($titles[$keytt]);
        //     $manufacturer->setAddress("USA, New York");
        //     $manufacturer->setImage("https://www.llentab.com/references/llentab-data/pl/500x380/8915_6d0e6795-bd66-407a-afae-5a705dfd134b.jpg");
        //     $manager->persist($manufacturer);
        // }

        $length = count($titles);

        for($i=0; $i<$length; $i++){
            $manufacturer = new Manufacturer;
            $manufacturer->setName($titles[$i]);
            $manufacturer->setAddress($address[$i]);
            $manufacturer->setImage($image[$i]);
            $manager->persist($manufacturer);
        }

        $manager->flush();
    }
}
