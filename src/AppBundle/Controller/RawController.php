<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Test;
use AppBundle\Form\TestType;
use AppBundle\Repository\RecipeRepository;
use http\Env\Response;
use Proxies\__CG__\AppBundle\Entity\Raw;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Recipe;
use AppBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $data=    $request->request->get('test');
        $id=$data["id"];
        $db = $this->getDoctrine()->getRepository('AppBundle:Recipe');
        $entity=$db->find($id);

        $raw=new Test();
        $raw->setRecipe($entity);

        $em = $this->getDoctrine()->getManager();
        $em->persist($raw);
        $em->flush();
        return $this->render('search/search.html.twig');

    }


    /**
     * @Route("/raw/search", name="search_raw")
     */
    public function indexAction(Request $request)
    {
        return $this->render('search/search.html.twig');
    }


    /**
     * @param Request $request
     * @Route("search/search", name="raw_search")
 *

     */

    public function search(Request $request){




        $entityManager = $this->getDoctrine()->getManager();
        $data=    $request->request->get('query');

        $result = $entityManager->getRepository("AppBundle:Recipe")->createQueryBuilder('o')
            ->where('o.name LIKE :n')
            ->setParameter('n', '%'.$data.'%')
            ->getQuery()
            ->getArrayResult();
            return $this->json(array($result));
    }}










//{    /**
//    * @param Request $request
//    *
//    * @Route("/raw/create", name="raw_create")
//    * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
//    *
//    * @return \Symfony\Component\HttpFoundation\Response
//    */
//    public function create(Request $request)
//    {
//        $article = new Test();
//
//        $form = $this->createForm(TestType::class, $article);
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
////            $article->set($this->getUser());
//            $em = $this->getDoctrine()->getManager();
//
//            $em->persist($article);
//            $em->flush();
//
//            return $this->redirectToRoute('homepage');
//
//        }
//
//        return $this->render('raw/create.html.twig',
//            array('form' => $form->createView()));
//
//    }
//
//    /**
//     * @Route("/search-recipe", name="search_recipe", defaults={"_format"="json"})
//     * @Method("GET")
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function searchAuthor(Request $request)
//    {
//        $q = $request->query->get('q', $request->query->get('term', ''));
//        $results = $this->getDoctrine()->getRepository('AppBundle:Recipe')->findLike($q);
//        return $this->render('raw/create.html.twig', ['results' => $results]);
//    }
//    /**
//     * @Route("/get-recipe/{id}", name="get_recipe", defaults={"_format"="json"})
//     * @Method("GET")
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function getAuthor( $id )
//    {
//        $author = $this->getDoctrine()->getRepository('AppBundle:Recipe')->find($id);
//
//        return $this->json($author->getName());
//    }
