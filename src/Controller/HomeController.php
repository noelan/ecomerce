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
            'articlesProposition' => $ClothRepository->findRandom()
    	]); 
    }

    /**
    /* @Route("/showCart", name="show_cart")
    */
    public function showCart()
    {   
        return $this->render('home/showcart.html.twig');
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
                    'article1Id' => ['quantiter' => 4, 'taille' =>'XL'],
                    'article2Id' => ['quantiter' => 4, 'taille' =>'XL'],
                ];  
        if (!$session->has('cart')){
            $session->set('cart', []); // if cart doesn’t exist in session, it is initialized.
        }
        $cart = $session->get('cart');

        $cloth = $ClothRepository->findOneBy(['id' => $id]);
        $quantity = $_POST['quantity'];
        $size = $_POST['size'];
        $id = $cloth->getId();
        $description = $cloth->getDescription();
        $name = $cloth->getName();
        $picture = $cloth->getPicture();
        $price = $cloth->getPrice();
        $total = 0;
        $cartArray = $cart;
        $articleToAdd = [ 
                        'size' => $size, 
                        'quantity' => $quantity,
                        'id'=> $id,
                        'description' => $description,
                        'name' => $name,
                        'picture' => $picture,
                        'price' => $price,                            
                        ];

        array_push($cartArray, $articleToAdd);
        foreach ($cartArray as $article) {
            $total += $article['price'] * $article['quantity'];
        }
        $session->set('cart', $cartArray);
        if (!$session->has('totalCart')){
            $session->set('totalCart', 0); // if cart doesn’t exist in session, it is initialized.
        }
        $session->set('totalCart', $total);
        return $this->redirectToRoute('show_cart');
        // $cart = $session->get('cart'); // get actual value in session with ‘total' key.
        // $cloth = $ClothRepository->findOneBy(['id' => $id]);
        // $quantity = $_POST['quantity'];
        // $size = $_POST['size'];
        // $arrayArticle = [];
        // for ($i=0; $i < $quantity ; $i++) { 
        //     array_push($arrayArticle, $cloth->getName());
        // }
        // if($cart != 0) {
        //     foreach ($cart as $key => $value) {
        //         for ($i=0; $i < $value ; $i++) { 
        //             array_push($arrayArticle, $key);
        //         }       
        //     }      
        // }
        // array_push($arrayArticle, $size);  
        // $countCart = array_count_values($arrayArticle);
        // $session->set('cart', $countCart);

        
    }
}
