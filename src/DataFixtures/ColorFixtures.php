<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Color;
use Faker;

class ColorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
    	$colors = [
    				 'red' => 'DE1212',
    				 'blue' => '123BDE',
    				 'white' => 'FFFFFF',
    				 'black' => '000000',
    				 'orange' => 'E58A03',
    				 'yellow' => 'EFE710',
    				 'grey' => '8E8D73',
    			  ];
    	$i = 0;
    	foreach ($colors as $currentColor => $hexadecimal) {
    		$color = new Color();
    		$color->setName($currentColor)
    			  ->setHexadecimal($hexadecimal);
    		$this->addReference('color' . $i, $color);
    		$i++;
    		$manager->persist($color);
    	}
        $manager->flush();
    }
}
