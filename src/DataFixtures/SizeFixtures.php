<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Size;
use Faker;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $sizes =['XS',
        		 'S',
        		 'M',
        		 'L',
        		 'XL',
        		 'XXL',
        		 '2XL',
        		 '34',
        		 '36',
        		 '38',
        		 '40',
        		 '42',
        		 '44',
    		   ];
    	$i = 0;
		foreach ($sizes as $currentSize) {
			$size = new Size();
			$size->setName($currentSize);
			$this->addReference('size' . $i, $size);
    		$manager->persist($size);
    		$i++;
		}
  	
        $manager->flush();
    }
}
