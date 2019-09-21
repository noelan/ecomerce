<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClothRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
    * @Route("/show/{category}", name="showByCategory")
    */
    public function showByCategory(ClothRepository $ClothRepository, $category)
    {   
    	return $this->render('home/showbyCategory.html.twig', [
    		'articles' => $ClothRepository->findBy(['Type' => $category]),
    	]);
    }

    /**
    * @Route("/showOne/{id}", name="show_one")
    */
    public function showOne(ClothRepository $ClothRepository, $id)
    {
    	return $this->render('home/showone.html.twig', [
    		'article' => $ClothRepository->findOneBy(['id' => $id]),
    	]); 
    }

    /**
    /* @Route("/showCart", name="show_cart")
    */
    public function showCart()
        return $this->render('home/showcart.html.twig');
}
