<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Snack;
use AppBundle\Form\SnackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class SnackController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/snack/create", name="snack_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $article = new Snack();

        $form = $this->createForm(SnackType::class, $article);
//        var_dump($form);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $article->set($this->getUser());
            $em = $this->getDoctrine()->getManager();

            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('homepage');

        }

        return $this->render('snack/create.html.twig',
            array('form' => $form->createView()));

    }
}
