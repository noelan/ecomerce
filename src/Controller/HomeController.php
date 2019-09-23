<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClothRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
    public function showCart(SessionInterface $session, ClothRepository $ClothRepository)
    {   

        $articles = $session->get('cart');
        $names = [];
        if($articles != 0) {
            foreach ($articles as $key => $value) {
                array_push($names, $key);
            }
        }
        $cloth = $ClothRepository->FindBy(['Name' => $names]);
        return $this->render('home/showcart.html.twig', ['articles' => $cloth,
                                                         'total' => 0]);
    }

    // /**
    // /* @Route("/addCart/{id}", name="add_cart")
    // */
    // public function addCart($id, ClothRepository $ClothRepository, Request $request)
    // {   
    //     $user = $this->getUser();
    //     $cloth = $ClothRepository->findOneBy(['id' => $id]);
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $quantity = $_POST['quantity'];
    //     dd($quantity);
    //     if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    //         for ($i=0; $i < $quantity ; $i++) { 
    //             $user->addCart($cloth);
    //             $entityManager->flush();
    //         }
    //     }

    //     return $this->redirectToRoute('show_cart');
    // }

    /**
    /* @Route("/removeCart/{id}", name="remove_cart")
    */
    public function removeCart($id, ClothRepository $ClothRepository, SessionInterface $session)
    {
        $cloth = $ClothRepository->findOneBy(['id' => $id]);
        $cart = $session->get('cart');
        unset($cart[$cloth->getName()]);
        // dd($cart);
        $session->set('cart', $cart);
        return $this->redirectToRoute('show_cart');
    }

    /**
    /* @Route("/addCart/{id}", name="add_cart")
    */
    public function addCart($id, ClothRepository $ClothRepository, SessionInterface $session)
    {   
        $array = [
                    'jean' => ['quantiter' => 4, 'taille' =>'XL'],
                ];       
        if (!$session->has('cart')) {
            $session->set('cart', 0); // if total doesn’t exist in session, it is initialized.
        }
        $cart = $session->get('cart'); // get actual value in session with ‘total' key.
        $cloth = $ClothRepository->findOneBy(['id' => $id]);
        $quantity = $_POST['quantity'];
        $size = $_POST['size'];
        $arrayArticle = [];
        for ($i=0; $i < $quantity ; $i++) { 
            array_push($arrayArticle, $cloth->getName());
        }
        if($cart != 0) {
            foreach ($cart as $key => $value) {
                for ($i=0; $i < $value ; $i++) { 
                    array_push($arrayArticle, $key);
                }       
            }      
        }
        array_push($arrayArticle, $size);  
        $countCart = array_count_values($arrayArticle);
        $session->set('cart', $countCart);
        return $this->redirectToRoute('show_cart');
    }
}
