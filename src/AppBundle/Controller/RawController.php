<?php

namespace AppBundle\Controller;


use AppBundle\Entity\GenerateRecipe;
use AppBundle\Entity\Raw;
use AppBundle\Entity\RecipeSRaw;
use AppBundle\Form\RawType;
use AppBundle\Repository\GenerateRecipeRepository;
use AppBundle\Repository\RecipeRepository;
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
//        $data = $request->request->get('raw');
//        $id = $data["id"];
//        $name=$data["name"];
//        $em = $this->getDoctrine()->getManager();

//        $article = new Raw();
//
//        $form = $this->createForm(RawType::class, $article);
////        var_dump($form);
//
//        $form->handleRequest($request);

//
//        if (isset($form)) {
////            $recipe = $em->getRepository('AppBundle:Recipe')->find($id);
//
//
//            return $this->render('search/raw.html.twig',  array('name' => $form));
//
//        }
//        else  {

//        $data = $request->request->get('test');
//        if (isset($data )){
//        $recipeid=$data['id'];
//            $id=    $data['id'];
//
//            $quantity=    $data['quantity'];
//
//
//
//
//            $db = $this->getDoctrine()->getRepository('AppBundle:Recipe');
//            $entity=$db->find($id);
//        $generateRecipe=new RecipeSRaw();
//        var_dump($entity);
//        $generateRecipe->setRecipeId($entity)
//        ->setQantity($quantity);
//            $db2 = $this->getDoctrine()->getRepository('AppBundle:Raw');
//            if ( isset($data['oldid'])){
//                $oldid=    $data['oldid'];
//            $rawdb=$db2->find($oldid);
//             $rawdb->setRecipe($generateRecipe);
//
//            }else{
//        $raw=new Raw();
//
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($raw);
//                $em->flush();
//                $em->persist($generateRecipe);
//                $em->flush();
//        $raw->setRecipe($generateRecipe);
//
//
//            }
//            $rawid=$raw->getId();
//            return $this->render('search/raw.html.twig',array('oldid'=> $rawid));//
//        }

        return $this->render('search/search.html.twig');//        }
    }

    public function createAction(Request $request){
        var_dump($request);
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

    public function search(Request $request)
    {


        $entityManager = $this->getDoctrine()->getManager();
        $data = $request->request->get('query');

        $result = $entityManager->getRepository("AppBundle:Recipe")->createQueryBuilder('o')
            ->where('o.name LIKE :n')
            ->setParameter('n', '%' . $data . '%')
            ->getQuery()
            ->getArrayResult();
        return $this->json(array($result));
    }

    /**
     * @param Request $request
     *
     * @Route("/raw/flush", name="raw_flush")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function flushAction(Request $request)
    {
        return $this->render('default/index.html.twig');

    }


}










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
//        $article = new Raw();
//
//        $form = $this->createForm(RawType::class, $article);
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
