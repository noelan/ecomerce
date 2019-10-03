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
    				 'red' => 'DC143C',
    				 'blue' => '4682B4',
    				 'white' => 'FFFFFF',
    				 'black' => '000000',
    				 'orange' => 'FF4500',
    				 'yellow' => 'F0E68C',
    				 'grey' => 'D3D3D3',
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
