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
        $title = ["RedDragon", "Steel", "CarbonFiber", "Pro Gaming", "Hellfire"];
        $image = ["https://images.unsplash.com/photo-1618424181497-157f25b6ddd5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bGFwdG9wJTIwY29tcHV0ZXJ8ZW58MHx8MHx8&w=1000&q=80",
        "https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/c1550d29975849.560cfea74dfc7.jpg",
        "https://images.unsplash.com/photo-1603302576837-37561b2e2302?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTF8fGxhcHRvcHxlbnwwfHwwfHw%3D&w=1000&q=80",
        "https://images.unsplash.com/photo-1583223667854-e0e05b1ad4f3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8aHAlMjBsYXB0b3B8ZW58MHx8MHx8&w=1000&q=80",
        "https://thumbs.dreamstime.com/b/broken-laptop-repair-insurance-concept-man-working-computer-damaged-screen-office-business-background-169357891.jpg",
        "https://maytinhanphat.vn/img/image/tin/283/sinh-vien-nen-chon-laptop-van-phong-moi-hay-cu-3.jpg"];
        for ($i=0; $i < 20; $i++) {
            $key = array_rand($title, 1);
            $keyImage = array_rand($image, 1);
            $laptop = new Laptop;
            $laptop->setName("Laptop ". $title[$key] . " " .rand(1000, 2000));
            $laptop->setDate(DateTime::createFromFormat('Y/m/d','2022/01/13'));
            $laptop->setPrice((float)(rand(300,2000)));
            $laptop->setQuantity(rand(10,100));
            $laptop->setColor("Black");
            $laptop->setImage($image[$keyImage]);
            $manager->persist($laptop);
        }
        $manager->flush();
    }
}
