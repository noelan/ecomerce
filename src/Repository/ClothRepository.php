<?php

namespace App\Repository;

use App\Entity\Cloth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cloth|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cloth|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cloth[]    findAll()
 * @method Cloth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cloth::class);
    }

    /**
    * @return 4 random article objetcs
    */

    public function findRandom()
    {   
        $randomNumber = rand(0,45);
        $qb = $this->createQueryBuilder('c')
                   ->setMaxResults(4)
                   ->setFirstResult($randomNumber)
                   ->getQuery();

        return $qb->execute();           
    }

    public function findByFilters($category, $arrayOfParameters) {
        $parameters = [];
        $paramSplited = explode('+', $arrayOfParameters);
        foreach($paramSplited as $param) {
            $tmp = explode('-', $param);
            if(!isset($parameters[$tmp[0]]))
                $parameters[$tmp[0]] = [];
            $parameters[$tmp[0]][] = $tmp[1];
        }
        $defineParam = ['category' => $category];
        $req = "SELECT cloth FROM App\Entity\Cloth cloth ";
        $whereString = "WHERE cloth.Type=:category ";
        $joinString = "";
        foreach($parameters as $key => $value) {
            $keyWTSATE = substr($key, 0, -1);
            $cpt = 1;
            $joinString .= "JOIN cloth.". $key ." ". $keyWTSATE ." ";
            $whereString .= " AND (". $keyWTSATE.".name=:".$keyWTSATE.$cpt;
            $defineParam[$keyWTSATE.$cpt] = $value[0];
            $cpt++;
            for($i = 1; $i < count($value); $i++) {
                $whereString .= " OR ".$keyWTSATE.".name=:".$keyWTSATE.$cpt;
                $defineParam[$keyWTSATE.$cpt] = $value[1];
                $cpt++;
            }
            $whereString .= ")";
        }
        $req .= $joinString . $whereString;
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            $req
        );
        $query->setParameters(
            $defineParam
         );
        return $query->getResult();
    }


    /**
    * @return array of cloth objetc by size
    */
    // 15h first try
    public function findByFiltersRIP($category, $arrayOfParameters) {
        $initialRequest = 'SELECT cloth FROM App\Entity\Cloth cloth';
        $possibleParameters = ['sizes','colors','materials'];
        $requestsToAdd = [];
        $joinAlreadyUsed = [];
        $whereAndOr ='';
        $everyJoin ="";
        // tableau associatif de requetes par type (color,type,matière)
        $parametersRequests = [];
        // compteur pour chaque type necessaire
        $c=1;
        $s=1;
        $m=1;
        foreach ($arrayOfParameters as $parameters) {
            foreach ($possibleParameters as $possibility) {
                //  $possibilityWTSAE = WITHOUT THE S A THE END (color,size,material)
                $possibilityWTSAE = substr($possibility, 0, -1);
                $joinTableUsed = "JOIN cloth.$possibility $possibilityWTSAE";        
                // si parameters(sizes-xl,colors-red) ne contient pas $possibility (sizes,colors,materials) ajouter la jointure et le where mais il il y a déja la jointure mettre que le where
                if((strpos($parameters, $possibility) === 0)) {
                    // incrémenter le bon compteur
                    if($possibility == 'sizes') {
                        $currentCompteur = $s;
                        $s++;
                    }if($possibility == 'colors') {
                        $currentCompteur = $c;
                        $c++;
                    }if($possibility == 'materials') {
                        $currentCompteur = $m;
                        $m++;
                    }
                    // Si la jointure n'a pas été faite l'ajouter dans un tableau et ajouter le WHERE dans un tableau si il est déja present mettre un OR
                    if((in_array($joinTableUsed, $joinAlreadyUsed ) == False)) {        
                        array_push($joinAlreadyUsed, $joinTableUsed);
                        $whereAndOr = $whereAndOr . ") AND (" . $possibilityWTSAE . ".name =:$possibilityWTSAE$currentCompteur";
                        //$parametersRequests[$possibility][] = $currentRequest;          
                    }else{
                        $whereAndOr = $whereAndOr . " OR " . $possibilityWTSAE . ".name =:$possibilityWTSAE$currentCompteur";
                        //$parametersRequests[$possibility][] = $currentRequest; 
                    }
                    $splitParameters = explode("-", $parameters);
                    $tableau[$possibilityWTSAE.$currentCompteur]=  $splitParameters[1];
                }
            }
        }
        $whereAndOr .= ")";
        foreach ($joinAlreadyUsed as $join) {
            $everyJoin = "$everyJoin$join ";
        }
        $tableau['category'] = $category;
        $finalRequest = $initialRequest . " ". $everyJoin. "WHERE (cloth.Type=:category". $whereAndOr;
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            $finalRequest
        );
        $query->setParameters(
            $tableau
         );
        return $query->getResult();

        // $em = $this->getEntityManager();
        // $query = $em->createQuery(
        //     'SELECT cloth
        //      FROM App\Entity\Cloth cloth
        //      JOIN cloth.sizes size
        //      WHERE size.name =:size 
        //      AND cloth.Type=:category'
        // );
    }

    //SELECT cloth.name, size.name, cloth.type, cloth.price, cloth.picture, cloth.description FROM cloth_size JOIN size ON size.id = cloth_size.size_id JOIN cloth ON cloth.id = cloth_size.cloth_id WHERE size.name =:size AND cloth.type=:category; 

    // /**
    //  * @return Cloth[] Returns an array of Cloth objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cloth
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}



// Si la jointure n'a pas été faite la faire sinon n'ajouter que le where
                    // if((in_array($joinTableUsed, $alreadyUsed ) == False)) {        
                    //     array_push($alreadyUsed, $joinTableUsed);
                    //     $currentRequest = " $joinTableUsed WHERE " . $possibilityWTSAE . ".name =:$possibilityWTSAE$currentCompteur";
                    //     $parametersRequests[$possibility][] = $currentRequest;          
                    // }else{
                    //     $currentRequest = " OR " . $possibilityWTSAE . ".name =:$possibilityWTSAE$currentCompteur";
                    //     $parametersRequests[$possibility][] = $currentRequest; 
                    // }
                    // // Si la requete n'est pas dans le tableu l'ajouter 
                    // if((in_array($currentRequest, $requestsToAdd)) == False) {                
                    //     $requestsToAdd[] = $currentRequest;
                    // }