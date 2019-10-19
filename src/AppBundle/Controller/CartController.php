<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cart;
use AppBundle\Entity\WeekPlan;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{   /**
    * @Route("/cart/generate", name="cart_generate")
    * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function cartGenerateAction()
    {

        //delete user's old cart
        $deleteCart = $this->getDoctrine()
            ->getRepository(Cart::class)
            ->deleteCart();
        $user = $this->getUser()->getId();

        //get all the recipes needed for the user's week plan
        $recipes = $this->getDoctrine()
            ->getRepository(Cart::class)
            ->weekGetAllRecipes($user);

        //Store all of the needed ingredients for the week plan
        foreach ($recipes as $recipe) {
            $repo = $this->getDoctrine()->getRepository('AppBundle:Recipe');
            $found = $repo->find($recipe["Id"]);
            $this->foreEachDays($found, $user);
        }

        //View all the ingredients with amount needed and total price for the week
        return $this->redirect('view');

    }
    public function foreEachDays($day, $user)
    {
        //get the data needed
        $em = $this->getDoctrine()->getManager();
        $raws = $day->getRaws();
        $grams = $day->getArray();

        //loop through all the recipes and calculate the quantity of the igredients
        for ($i = 0; $i < count($raws); $i++) {

            //find the ingredient by id
            $id = $raws[$i]->getId();
            $db = $this->getDoctrine()->getRepository('AppBundle:Raw');

            //Get the user's cart entity
            $entity = $db->find($id);
            $repository = $this->getDoctrine()
                ->getRepository(Cart::class);

            //check if the igredient is already in the cart entity
            $q = $repository->createQueryBuilder('p')
                ->where('p.rawId = :raw')
                ->andWhere('p.userId = :user')
                ->setParameter('raw', $entity)
                ->setParameter('user', $user)
                ->orderBy('p.rawId', 'ASC')
                ->getQuery()
            ;
            $products = $q->getResult();
            //Sum the ingrediet's quantity if the product is in the enetity
            if ($products) {
                $oldGrams = $products[0]->getGrams();
                $newGrams = $oldGrams += $grams[$i];
                $q2 = $repository->createQueryBuilder('p')
                    ->where('p.rawId = :raw')
                    ->andWhere('p.userId = :user')
                    ->setParameter('raw', $entity)
                    ->setParameter('user', $user)
                    ->update('AppBundle:Cart', 'p')
                    ->set('p.grams', $newGrams)
                    ->getQuery()
                ;
                $q2->execute();
                //Add the igredient to the cart enetity
            } else {
                $cartEntity = new Cart();
                $cartEntity->setRawId($entity)->setUserId($user);
                $cartEntity->setGrams($grams[$i]);
                $em->persist($cartEntity);
                $em->flush();
            }
            $repository->clear();
        }
    }
    /**
     * @param Request $request
     *
     * @Route("/cart/view", name="cart_view")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function viewCartAction()
    {
        //check if the user have week plan
        $user = $this->getUser();
        $userHasWeekPlan = ($this->getDoctrine()->getRepository(WeekPlan::class)
                ->findOneBy(array('userId' => $this->getUser()->getId()))) ? true : false;

        //get get user's cart data
        $repository = $this->getDoctrine()
            ->getRepository(Cart::class);

        $q = $repository->createQueryBuilder('p')
            ->andWhere('p.userId = :user')
            ->setParameter('user', $user)
            ->orderBy('p.rawId', 'ASC')
            ->getQuery()
        ;
        $products = $q->getResult();

        return $this->render('cart/view.html.twig', array('entity' => $products, 'userhasweek' => $userHasWeekPlan));
    }

}
