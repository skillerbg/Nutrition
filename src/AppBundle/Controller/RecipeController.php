<?php

namespace AppBundle\Controller;


use AppBundle\Entity\GenerateRecipe;
use AppBundle\Entity\Nutrition_Info;
use AppBundle\Entity\Raw;
use AppBundle\Entity\Recipe_Nutrion;
use AppBundle\Entity\RecipeSRaw;
use AppBundle\Form\RawType;
use AppBundle\Repository\GenerateRawRepository;
use AppBundle\Repository\RawRepository;
use http\Env\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Recipe;
use AppBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class RecipeController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/recipe/create", name="recipe_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {

        $recipe= new Recipe();
        $nutriInfo=new Recipe_Nutrion();
        $data =$request->query->get('recipe');
        if ($data) {
            $kcal=0;
            $fats=0;
            $proteins=0;
            $carbs=0;
            $saFats=0;
            $salt=0;
            $sugars=0;

            $price=0;
            $amount=0;
            $array=[];
            $em = $this->getDoctrine()->getManager();
            for ($i=1;$i<=10;$i++) {
                $id='id'.$i;
                $quantity=intval($data['quantity'.$i]);
                $array[]=$quantity;
                $amount+=$quantity;
                if ($data[$id]) {
                    $raw = $em->getRepository('AppBundle:Raw')->find($data[$id]);
                    $recipe->getRaws()->add($raw);
                    $price+=($raw->getPricePerG()*$quantity);
                    $kcal+=(($raw->getNutritionInfo()->getKcalPerG())*$quantity);
                    $fats+=(($raw->getNutritionInfo()->getFatsPerG())*$quantity);
                    $proteins+=(($raw->getNutritionInfo()->getProteinsPerG())*$quantity);
                    $carbs+=(($raw->getNutritionInfo()->getCarbsPerG())*$quantity);
                    $saFats+=(($raw->getNutritionInfo()->getSaturatedFatsPerG())*$quantity);
                    $salt+=(($raw->getNutritionInfo()->getSaltPerG())*$quantity);
                    $sugars+=(($raw->getNutritionInfo()->getSugarsPerG())*$quantity);


                }
            }
            $nutriInfo->setKcal($kcal)
                ->setSugars($sugars)
                ->setSalt($salt)
                ->setSaturatedFats($saFats)
                ->setProteins($proteins)
                ->setFats($fats)
                ->setCarbs($carbs);
            $recipe->setName($data['name'])
                ->setArray($array)
                ->setDescription($data['description'])
                ->setType($data['type'])
                ->setPicture($data['picture'])
                ->setPrice($price)
                ->setQuantity($amount)
                ->setRecipeNutrition($nutriInfo);
            $em->persist($recipe);
            $em->persist($nutriInfo);

            $em->flush();
        }



        return $this->render('search/search.html.twig');//        }
    }







    /**
     * @param Request $request
     * @Route("search/search", name="recipe_search")
     *

     */

    public function search(Request $request)
    {


        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request->get('query');

        $result = $entityManager->getRepository("AppBundle:Raw")->createQueryBuilder('o')
            ->where('o.name LIKE :n')
            ->setParameter('n', '%' . $data . '%')
            ->getQuery()
            ->getArrayResult();
        return $this->json(array($result));
    }




}









