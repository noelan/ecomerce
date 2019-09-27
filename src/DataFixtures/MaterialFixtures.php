<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Material;
use Faker;

class MaterialFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
    	$materials = ['coton',
    				  'cuir',
    				  'laine',
    				  'lin',
    				  'soie',
    				  'polyester',
    				  'coton bio', 
    				 ];
    	$i = 0;
    	foreach ($materials as $currentMaterial) {
    		$material = new Material();
    		$material->setName($currentMaterial);
    		$this->addReference('material' . $i, $material);
    		$i++;
    		$manager->persist($material);
    	}
        $manager->flush();
    }
}
