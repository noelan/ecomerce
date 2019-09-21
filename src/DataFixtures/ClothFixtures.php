<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Cloth;
use Faker;

class ClothFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker  =  Faker\Factory::create('fr_FR');

        $tshirts = ['https://cdn.tzy.li/tzy/previews/images/001/549/014/398/normal/biere-edition-limitee.jpg?1545992533',
                    'https://cdn.tzy.li/tzy/previews/images/001/299/987/601/normal/moto-et-biere.jpg?1535236300',
                    'https://cdn.tzy.li/tzy/previews/images/001/173/563/759/normal/biere-jetaime.jpg?1529072469',
                    'https://cdn.tzy.li/tzy/previews/images/001/126/862/044/normal/velo-et-biere.png?1527112546',
                    'https://cdn.tzy.li/tzy/previews/images/855/149/157/normal/velo-biere2.png?1512946790',
                    'https://cdn.tzy.li/tzy/previews/images/001/174/395/465/normal/biere-et-peche.jpg?1529270880',
                    'https://cdn.tzy.li/tzy/previews/images/001/278/906/681/normal/velo-biere.png?1534715072',
                    'https://cdn.tzy.li/tzy/previews/images/001/560/524/584/normal/biere-entierefr.jpg?1547198585',
                    'https://cdn.tzy.li/tzy/previews/images/840/895/093/normal/velo-biere1.png?1512128943',
                    'https://cdn.tzy.li/tzy/previews/images/840/890/895/normal/velo-biere3.png?1512128759',
        ];

        foreach ($tshirts as $tshirt) {
         
        $cloth = new Cloth();
        $cloth->setType('Tshirt')
              ->setPrice(rand(10, 20))
              ->setName(ucfirst($faker->word))
              ->setNote(rand(2, 5))
              ->setDescription($faker->sentence)
              ->setPicture($tshirt)
              ->setSize(['S', 'M', 'L', 'XL', 'XXL','3XL', '4Xl', '5XL']);
        $manager->persist($cloth);
        }
        

        $manager->flush();
    }
}
