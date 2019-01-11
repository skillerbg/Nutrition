<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Dinner;
use AppBundle\Form\DinnerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DinnerController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/dinner/create", name="dinner_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $article = new Dinner();

        $form = $this->createForm(DinnerType::class, $article);
//        var_dump($form);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $article->set($this->getUser());
            $em = $this->getDoctrine()->getManager();

            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('homepage');

        }

        return $this->render('dinner/create.html.twig',
            array('form' => $form->createView()));

    }
}
