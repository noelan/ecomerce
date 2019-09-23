<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
    	$user = New User();
    	$user->setEmail('mdp@mdp.mdp')
    		 ->setRoles(['user'])
             ->setToken(1)
    		 ->setPassword($this->encoder->encodePassword($user,'mdp'));
    	$manager->persist($user);
        $manager->flush();
    }
}
