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





        if ($data) {

            $article->setDescription($data['description']);
            $article->setName($data["name"]);
            $article->setPicture($data["picture"]);
            $article->setPrice($data["price"]);
            $article->setQuantity($data["quantity"]);
            $article->setType($data["type"]);





            $nutri->setKcal($data["kcal"]);
            $nutri->setCarbs($data['carbs']);
            $nutri->setFats($data['fats']);
            $nutri->setProteins($data['proteins']);
            $nutri->setSaturatedFats($data['saturatedFats']);
            $nutri->setUnSaturatedFats($data['unSaturatedFats']);
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
}
