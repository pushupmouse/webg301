<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Laptop;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LaptopFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 20; $i++) { 
            $laptop = new Laptop;
            $laptop->setName("Laptop $i");
            $laptop->setDate(DateTime::createFromFormat('Y/m/d','2022/01/13'));
            $laptop->setPrice((float)(rand(300,2000)));
            $laptop->setQuantity(rand(10,100));
            $laptop->setColor("Black");
            $laptop->setImage("https://maytinhanphat.vn/img/image/tin/283/sinh-vien-nen-chon-laptop-van-phong-moi-hay-cu-3.jpg");
            $manager->persist($laptop);
        }
        $manager->flush();
    }
}
