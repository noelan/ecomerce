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

        $types = [
            'Tshirt'  => ['https://cdn.tzy.li/tzy/previews/images/001/549/014/398/normal/biere-edition-limitee.jpg?1545992533',
                          'https://cdn.tzy.li/tzy/previews/images/001/299/987/601/normal/moto-et-biere.jpg?1535236300',
                          'https://cdn.tzy.li/tzy/previews/images/001/173/563/759/normal/biere-jetaime.jpg?1529072469',
                          'https://cdn.tzy.li/tzy/previews/images/001/126/862/044/normal/velo-et-biere.png?1527112546',
                          'https://cdn.tzy.li/tzy/previews/images/855/149/157/normal/velo-biere2.png?1512946790',
                          'https://cdn.tzy.li/tzy/previews/images/001/174/395/465/normal/biere-et-peche.jpg?1529270880',
                          'https://cdn.tzy.li/tzy/previews/images/001/278/906/681/normal/velo-biere.png?1534715072',
                          'https://cdn.tzy.li/tzy/previews/images/001/560/524/584/normal/biere-entierefr.jpg?1547198585',
                          'https://cdn.tzy.li/tzy/previews/images/840/895/093/normal/velo-biere1.png?1512128943',
                          'https://cdn.tzy.li/tzy/previews/images/840/890/895/normal/velo-biere3.png?1512128759',
                          'https://cdn.tzy.li/tzy/previews/images/855/149/157/normal/velo-biere2.png?1512946790',
                          'https://cdn.tzy.li/tzy/previews/images/001/174/395/465/normal/biere-et-peche.jpg?1529270880',
                         ],
            'basket' =>  [ 'https://www.tati.fr/phototheque/boutique/200250/medium/00W20002900001.jpg',
                          'https://www.tati.fr/phototheque/boutique/199750/medium/00W19954401691.jpg',
                          'https://www.tati.fr/phototheque/boutique/199750/medium/00W19952900001.jpg',
                          'https://www.tati.fr/phototheque/boutique/196250/medium/00W19613501691.jpg',
                          'https://www.tati.fr/phototheque/boutique/196250/medium/00W19613501691.jpg',
                          'https://www.tati.fr/phototheque/boutique/207000/medium/00W20692400001.jpg',
                          'https://www.tati.fr/phototheque/boutique/207000/medium/00W20692302362.jpg',
                          'https://www.tati.fr/phototheque/boutique/199250/medium/00W19920100093.jpg',
                          'https://www.tati.fr/phototheque/boutique/199250/medium/00W19919900002.jpg',
                          'https://www.tati.fr/phototheque/boutique/195000/medium/00W19495000005.jpg',
                         ],
            'jogging' => ['https://www.tati.fr/phototheque/boutique/194500/medium/00W19438100591.jpg',
                          'https://www.tati.fr/phototheque/boutique/195000/medium/00W19493500017.jpg',
                          'https://www.tati.fr/phototheque/boutique/194500/medium/00W19437801539.jpg',
                          'https://www.tati.fr/phototheque/boutique/194750/medium/00W19465004602.jpg',
                          'https://www.tati.fr/phototheque/boutique/214250/medium/00W21422600001.jpg',
                          'https://www.tati.fr/phototheque/boutique/214250/medium/00W21422604602.jpg',
                          'https://www.tati.fr/phototheque/boutique/214250/medium/00W21422605151.jpg',
                          'https://www.tati.fr/phototheque/boutique/214250/medium/00W21409205151.jpg',
                          'https://www.tati.fr/phototheque/boutique/214250/medium/00W21409205151.jpg',
                          'https://www.tati.fr/phototheque/boutique/194750/medium/00W19464600009.jpg',
                         ],
            'Jean'    => ['https://www.tati.fr/phototheque/boutique/194750/medium/00W19462900033.jpg',
                          'https://www.tati.fr/phototheque/boutique/194750/medium/00W19462800001.jpg',
                          'https://www.tati.fr/phototheque/boutique/168000/medium/00W12233400005.jpg',
                          'https://www.tati.fr/phototheque/boutique/194500/medium/00W19436200005.jpg',
                          'https://www.tati.fr/phototheque/boutique/194750/medium/00W19463400001.jpg',
                          'https://www.tati.fr/phototheque/boutique/174000/medium/00W12787600019.jpg',
                          'https://www.tati.fr/phototheque/boutique/168000/medium/00W12233400005.jpg',
                          'https://www.tati.fr/phototheque/boutique/106000/medium/00W067418A.jpg',
                          'https://www.tati.fr/phototheque/boutique/191250/medium/00W19117800005.jpg',
                          'https://www.tati.fr/phototheque/boutique/194750/medium/00W19463400001.jpg',
                          'https://www.tati.fr/phototheque/boutique/163250/medium/00W118518A.jpg',
                         ],
            'Veste'   => ['https://www.tati.fr/phototheque/boutique/203250/medium/00W20323100012.jpg',
                          'https://www.tati.fr/phototheque/boutique/203250/medium/00W20323100012.jpg',
                          'https://www.tati.fr/phototheque/boutique/214250/medium/00W21418300019.jpg',
                          'https://www.tati.fr/phototheque/boutique/193250/medium/00W19321100001.jpg',
                          'https://www.tati.fr/phototheque/boutique/193250/medium/00W19321100019.jpg',
                          'https://www.tati.fr/phototheque/boutique/195750/medium/00W19563200001.jpg',
                          'https://www.tati.fr/phototheque/boutique/168000/medium/00W12234700009.jpg',
                          'https://www.tati.fr/phototheque/boutique/195750/medium/00W19563504602.jpg',
                          'https://www.tati.fr/phototheque/boutique/195750/medium/00W19563400276.jpg',
                         ],
            'Casquette' => ['https://www.tati.fr/phototheque/boutique/266250/medium/00W266007A.jpg',
                            'https://www.tati.fr/phototheque/boutique/310250/medium/00W310228A.jpg',
                            'https://www.tati.fr/phototheque/boutique/291750/medium/00W291569A.jpg',
                            'https://www.tati.fr/phototheque/boutique/290500/medium/00W290484A.jpg',
                            'https://www.tati.fr/phototheque/boutique/291500/medium/00W291340A.jpg',
                            'https://www.tati.fr/phototheque/boutique/257750/medium/00W257738A.jpg',
                            'https://www.tati.fr/phototheque/boutique/257750/medium/00W257737A.jpg',
                            'https://www.tati.fr/phototheque/boutique/257750/medium/00W257735A.jpg',
                            'https://www.tati.fr/phototheque/boutique/257750/medium/00W257734A.jpg',
                            'https://www.tati.fr/phototheque/boutique/257250/medium/00W257191A.jpg',
                           ],
            ];

        foreach ($types as $type => $picture) {
            for ($i=0; $i < count($picture) ; $i++) { 
                $cloth = new Cloth();
                $name = (ucfirst($faker->word) . rand(0,100));
                $cloth->setType($type)
                      ->setPrice(rand(10, 20))
                      ->setName($name)
                      ->setNote(rand(2, 5))
                      ->setDescription($faker->paragraph)
                      ->setPicture($picture[$i])
                      ->setSize(['S', 'M', 'L', 'XL', 'XXL','3XL', '4Xl', '5XL']);
                $manager->persist($cloth);
            }
           
        }
        
        // foreach ($tshirts as $tshirt) {
         
        // $cloth = new Cloth();
        // $cloth->setType('Tshirt')
        //       ->setPrice(rand(10, 20))
        //       ->setName(ucfirst($faker->word))
        //       ->setNote(rand(2, 5))
        //       ->setDescription($faker->sentence)
        //       ->setPicture($tshirt)
        //       ->setSize(['S', 'M', 'L', 'XL', 'XXL','3XL', '4Xl', '5XL']);
        // $manager->persist($cloth);
        // }
        
        // foreach ($joggings as $jogging) {
         
        // $cloth = new Cloth();
        // $cloth->setType('Jogging')
        //       ->setPrice(rand(10, 20))
        //       ->setName(ucfirst($faker->word))
        //       ->setNote(rand(2, 5))
        //       ->setDescription($faker->sentence)
        //       ->setPicture($jogging)
        //       ->setSize(['S', 'M', 'L', 'XL', 'XXL','3XL', '4Xl', '5XL']);
        // $manager->persist($cloth);
        // }
        

        $manager->flush();
    }
}
