<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\AppBundle;
use Proxies\__CG__\AppBundle\Entity\Recipe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;

class ViewRecipeController extends Controller
{
    /**
     *
     * @Route("recipe/view", name="recipe_view")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ViewAction($slug)
    {
        $id=   $slug;
        $db = $this->getDoctrine()->getRepository('AppBundle:Recipe');
          $entity=$db->find($id);
          $nutrition=$entity->getRecipeNutrition();
        return $this->render('recipe/view.html.twig', array('entity' => $entity,'nutrition'=>$nutrition));
    }

    /**
     * @param Request $request
     *
     * @Route("/raw/view", name="raw_view")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ViewRawAction($slug)
    {
        $id=   $slug;

        $db = $this->getDoctrine()->getRepository('AppBundle:Raw');
        $entity=$db->find($id);
        $nutrition=$entity->getNutritionInfo();

        return $this->render('raw/view.html.twig', array('entity' => $entity,'nutrition'=>$nutrition));
    }
}
