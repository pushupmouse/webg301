<?php

namespace App\DataFixtures;

use App\Entity\Origin;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class OriginFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $country = array(
        //     "America"=>"https://cdn.britannica.com/79/4479-050-6EF87027/flag-Stars-and-Stripes-May-1-1795.jpg", 
        //     "France"=>"https://www.rankred.com/wp-content/uploads/2020/08/French-Naval-Ensign.png?ezimgfmt=rs:332x221/rscb6/ngcb6/notWebP", 
        //     "China"=>"https://cdn.pixabay.com/photo/2020/04/04/11/45/flag-5001937_1280.jpg", 
        //     "Germany"=>"https://thenationonlineng.net/wp-content/uploads/2020/05/germany-flag-1.jpg", 
        //     "Japan"=>"https://thumbs.dreamstime.com/b/japan-flag-vector-file-86146544.jpg"
        // );

        $country = ["America", "France", "China", "Germany", "Japan"];
        $length = count($country);
        for ($i=0; $i < $length; $i++) {
            $origin = new Origin;
            $origin->setName($country[$i])
                  ->setImage("https://preview.redd.it/1jnsfe05vjg21.jpg?auto=webp&s=aaaa7fb926c3ea6c7f92b278d1050d206d78c0bb");
            $manager->persist($origin);
        }

        $manager->flush();
    }
}
