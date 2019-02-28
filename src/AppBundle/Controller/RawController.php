<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nutrition_Info;
use AppBundle\Entity\Raw;
use AppBundle\Form\Nutrition_InfoType;
use AppBundle\Form\RawType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class RawController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/raw/create", name="raw_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $rawEntity = new Raw();
        $rawNutritionInfo=new Nutrition_Info();

        $params = $request->request->get('raw');


        if ($params) {

            //sets the raw entity params
            $rawEntity->setDescription($params['description']);
            $rawEntity->setName($params["name"]);
            $rawEntity->setPicture($params["picture"]);
            $rawEntity->setPrice($params["price"]);
            $rawEntity->setQuantity($params["quantity"]);
            $rawEntity->setGlutenfree($params["glutenfree"]);
            $rawEntity->setOrganic($params["organic"]);
            $rawEntity->setVegan($params["vegan"]);
            $rawEntity->setVegetarian($params["vegetarian"]);
            $rawEntity->setLactosefree($params["lactosefree"]);

            //sets the raw's nutrition info params
            $rawNutritionInfo->setKcal($params["kcal"]);
            $rawNutritionInfo->setCarbs($params['carbs']);
            $rawNutritionInfo->setFats($params['fats']);
            $rawNutritionInfo->setProteins($params['proteins']);
            $rawNutritionInfo->setSaturatedFats($params['saturatedFats']);
            $rawNutritionInfo->setSalt($params['salt']);
            $rawNutritionInfo->setSugars($params['sugars']);

            $rawEntity->setNutritionInfo($rawNutritionInfo);//binds the nutrition info to the raw entity

            $em = $this->getDoctrine()->getManager();
            $em->persist($rawEntity);
            $em->persist($rawNutritionInfo);

            $em->flush();
            return $this->redirectToRoute('raw_create');

        }

        return $this->render('raw/create.html.twig');

    }


    /**
     * @param Request $request
     * @Route("raw/search", name="recipe_search")
     *

     */

    public function search(Request $request)//search the Db for recipes entities with the ajax params
    {


        $entityManager = $this->getDoctrine()->getManager();
        $ajaxQuery = $request->request->get('query');

        $result = $entityManager->getRepository("AppBundle:Recipe")->createQueryBuilder('o')
            ->where('o.name LIKE :n')
            ->setParameter('n', '%' . $ajaxQuery . '%')
            ->getQuery()
            ->getArrayResult();
        return $this->json(array($result));
    }


}
