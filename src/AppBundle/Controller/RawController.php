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
        $article = new Raw();
        $nutri=new Nutrition_Info();
        $data = $request->request->get('raw');



        var_dump($data);

        if ($data) {

            $article->setDescription($data['description']);
            $article->setName($data["name"]);
            $article->setPicture($data["picture"]);
            $article->setPrice($data["price"]);
            $article->setQuantity($data["quantity"]);
            $article->setGlutenfree($data["glutenfree"]);
            $article->setOrganic($data["organic"]);
            $article->setVegan($data["vegan"]);
            $article->setVegetarian($data["vegetarian"]);
            $article->setLactosefree($data["lactosefree"]);




            $nutri->setKcal($data["kcal"]);
            $nutri->setCarbs($data['carbs']);
            $nutri->setFats($data['fats']);
            $nutri->setProteins($data['proteins']);
            $nutri->setSaturatedFats($data['saturatedFats']);
            $nutri->setSalt($data['salt']);
            $nutri->setSugars($data['sugars']);

            $article->setNutritionInfo($nutri);

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->persist($nutri);

            $em->flush();
            return $this->redirectToRoute('homepage');

        }

        return $this->render('raw/create.html.twig');

    }


    /**
     * @param Request $request
     *
     * @Route("/raw/search", name="raw_search")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchRaw(){
        return $this->render('raw/search.html.twig');

    }
}
