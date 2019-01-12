<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Recipe;
use AppBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $article = new Recipe();

        $form = $this->createForm(RecipeType::class, $article);
//        var_dump($form);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $article->set($this->getUser());
            $em = $this->getDoctrine()->getManager();

            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('homepage');

        }

        return $this->render('recipe/create.html.twig',
            array('form' => $form->createView()));

    }
}
