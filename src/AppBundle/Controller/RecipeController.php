<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Raw;
use AppBundle\Entity\Recipe;
use AppBundle\Entity\Recipe_Nutrion;
use http\Env\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

        $recipe = new Recipe();
        $recipesNutriInfo = new Recipe_Nutrion();

        $data = $request->query->get('recipe');
        if ($data) {

            list($kcal, $fats, $proteins, $carbs, $saFats, $salt, $sugars, $price, $amount) = array(0, 0, 0, 0, 0, 0, 0, 0, 0); //sum of all the params of the ingredients
            $quantityArray = []; //array of all the quantities of the ingredients
            $servings = intval($data['servings']);
            $em = $this->getDoctrine()->getManager();

            //goes through the set ingredients and binds their params together
            for ($i = 1; $i <= 10; $i++) {
                $requestRawId = 'id' . $i; //id of the raws in the form

                //find raw entity with the provided id
                if ($data[$requestRawId] && $em->getRepository('AppBundle:Raw')->find($data[$requestRawId])) { //checks if the form has a raw

                    $quantity = intval($data['quantity' . $i]) / $servings; //gets the quantity of one serving
                    $quantityArray[] = $quantity;
                    $amount += $quantity; //sum of quantities

                    $raw = $em->getRepository('AppBundle:Raw')->find($data[$requestRawId]); //finds the raw entity by id
                    $recipe->getRaws()->add($raw); //adds the raw entity to the recipe's raws list

                    //adds the params to the current params
                    $price += ($raw->getPricePerG() * $quantity);
                    $kcal += (($raw->getNutritionInfo()->getKcalPerG()) * $quantity);
                    $fats += (($raw->getNutritionInfo()->getFatsPerG()) * $quantity);
                    $proteins += (($raw->getNutritionInfo()->getProteinsPerG()) * $quantity);
                    $carbs += (($raw->getNutritionInfo()->getCarbsPerG()) * $quantity);
                    $saFats += (($raw->getNutritionInfo()->getSaturatedFatsPerG()) * $quantity);
                    $salt += (($raw->getNutritionInfo()->getSaltPerG()) * $quantity);
                    $sugars += (($raw->getNutritionInfo()->getSugarsPerG()) * $quantity);

                }
            }

            //sets the recipe's nutrition info
            $recipesNutriInfo->setKcal($kcal)
                ->setSugars($sugars)
                ->setSalt($salt)
                ->setSaturatedFats($saFats)
                ->setProteins($proteins)
                ->setFats($fats)
                ->setCarbs($carbs);

            //sets the recipe's params
            $recipe->setName($data['name'])
                ->setArray($quantityArray)
                ->setDescription($data['description'])
                ->setType($data['type'])
                ->setPicture($data['picture'])
                ->setPrice($price)
                ->setQuantity($amount)
                ->setRecipeNutrition($recipesNutriInfo);

            $em->persist($recipe);
            $em->persist($recipesNutriInfo);

            $em->flush();
        }

        return $this->render('search/search.html.twig'); //        }
    }

    /**
     * @param Request $request
     * @Route("search/search", name="raw_search")
     *

     */

    public function search(Request $request) //searches the Db for raw entities with the ajax query

    {

        $entityManager = $this->getDoctrine()->getManager();
        $ajaxQuery = $request->request->get('query');

        $result = $entityManager->getRepository("AppBundle:Raw")->createQueryBuilder('o')
            ->where('o.name LIKE :n')
            ->setParameter('n', '%' . $ajaxQuery . '%')
            ->getQuery()
            ->getArrayResult();

        return $this->json(array($result));
    }

}
