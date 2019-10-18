<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cart;
use AppBundle\Entity\WeekPlan;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{/**

/* @Route("/cart/generate", name="cart_generate")
/* @Security("is_granted('IS_AUTHENTICATED_FULLY')")

/* @return \Symfony\Component\HttpFoundation\Response
 */
    public function cartGenerateAction()
    {
        $user = $this->getUser()->getId();

        $plan = $this->getDoctrine()->getRepository(WeekPlan::class)
            ->findOneBy(array('userId' => $user));

        $monday = $plan->getMonday()->getBreakfast();
        $this->foreEachDays($monday, $user);
        $monday = $plan->getMonday()->getDinner1();
        $this->foreEachDays($monday, $user);
        $monday = $plan->getMonday()->getDinner2();
        $this->foreEachDays($monday, $user);
        $monday = $plan->getMonday()->getSnack1();
        $this->foreEachDays($monday, $user);
        $monday = $plan->getMonday()->getSnack2();
        $this->foreEachDays($monday, $user);

        $tuesday = $plan->getTuesday()->getBreakfast();
        $this->foreEachDays($tuesday, $user);
        $tuesday = $plan->getTuesday()->getDinner1();
        $this->foreEachDays($tuesday, $user);
        $tuesday = $plan->getTuesday()->getDinner2();
        $this->foreEachDays($tuesday, $user);
        $tuesday = $plan->getTuesday()->getSnack1();
        $this->foreEachDays($tuesday, $user);
        $tuesday = $plan->getTuesday()->getSnack2();
        $this->foreEachDays($tuesday, $user);

        $wednesday = $plan->getWednesday()->getBreakfast();
        $this->foreEachDays($wednesday, $user);
        $wednesday = $plan->getWednesday()->getDinner1();
        $this->foreEachDays($wednesday, $user);
        $wednesday = $plan->getWednesday()->getDinner2();
        $this->foreEachDays($wednesday, $user);
        $wednesday = $plan->getWednesday()->getSnack1();
        $this->foreEachDays($wednesday, $user);
        $wednesday = $plan->getWednesday()->getSnack2();
        $this->foreEachDays($wednesday, $user);

        $thursday = $plan->getThursday()->getBreakfast();
        $this->foreEachDays($thursday, $user);
        $thursday = $plan->getThursday()->getDinner1();
        $this->foreEachDays($thursday, $user);
        $thursday = $plan->getThursday()->getDinner2();
        $this->foreEachDays($thursday, $user);
        $thursday = $plan->getThursday()->getSnack1();
        $this->foreEachDays($thursday, $user);
        $thursday = $plan->getThursday()->getSnack2();
        $this->foreEachDays($thursday, $user);

        $friday = $plan->getFriday()->getBreakfast();
        $this->foreEachDays($friday, $user);
        $friday = $plan->getFriday()->getDinner1();
        $this->foreEachDays($friday, $user);
        $friday = $plan->getFriday()->getDinner2();
        $this->foreEachDays($friday, $user);
        $friday = $plan->getFriday()->getSnack1();
        $this->foreEachDays($friday, $user);
        $friday = $plan->getFriday()->getSnack2();
        $this->foreEachDays($friday, $user);

        $saturday = $plan->getSaturday()->getBreakfast();
        $this->foreEachDays($saturday, $user);
        $saturday = $plan->getSaturday()->getDinner1();
        $this->foreEachDays($saturday, $user);
        $saturday = $plan->getSaturday()->getDinner2();
        $this->foreEachDays($saturday, $user);
        $saturday = $plan->getSaturday()->getSnack1();
        $this->foreEachDays($saturday, $user);
        $saturday = $plan->getSaturday()->getSnack2();
        $this->foreEachDays($saturday, $user);

        $sunday = $plan->getSunday()->getBreakfast();
        $this->foreEachDays($sunday, $user);
        $sunday = $plan->getSunday()->getDinner1();
        $this->foreEachDays($sunday, $user);
        $sunday = $plan->getSunday()->getDinner2();
        $this->foreEachDays($sunday, $user);
        $sunday = $plan->getSunday()->getSnack1();
        $this->foreEachDays($sunday, $user);
        $sunday = $plan->getSunday()->getSnack2();
        $this->foreEachDays($sunday, $user);

        return $this->redirect('view');

    }
    public function foreEachDays($day, $user)
    {
        $raws = $day->getRaws();
        $grams = $day->getArray();

        $rawsLenght = 0;

        foreach ($raws as $item) {
            $rawsLenght++;

        }
        for ($i = 0; $i < $rawsLenght; $i++) {

            $em = $this->getDoctrine()->getManager();
            $id = $raws[$i]->getId();
            $db = $this->getDoctrine()->getRepository('AppBundle:Raw');
            $cartR = $this->getDoctrine()->getRepository('AppBundle:Cart');
            
            $entity = $db->find($id);

            $repository = $this->getDoctrine()
                ->getRepository(Cart::class);

            $q = $repository->createQueryBuilder('p')
                ->where('p.rawId = :raw')
                ->andWhere('p.userId = :user')
                ->setParameter('raw', $entity)
                ->setParameter('user', $user)

                ->orderBy('p.rawId', 'ASC')

                ->getQuery()
            ;

            $products = $q->getResult();
            if ($products) {

                $oldGrams = $products[0]->getGrams();
                var_dump($oldGrams);
                $newGrams = $oldGrams += $grams[$i];
                var_dump($newGrams);
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
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function viewCartAction()
    {
        $user = $this->getUser();
        $userHasWeekPlan= ($this->getDoctrine()->getRepository(WeekPlan::class)
        ->findOneBy(array('userId' => $this->getUser()->getId()))) ? true : false;
        $repository = $this->getDoctrine()
            ->getRepository(Cart::class);

        $q = $repository->createQueryBuilder('p')
            ->andWhere('p.userId = :user')
            ->setParameter('user', $user)

            ->orderBy('p.rawId', 'ASC')

            ->getQuery()
        ;

        $products = $q->getResult();
        return $this->render('cart/view.html.twig', array('entity' => $products,'userhasweek' => $userHasWeekPlan));
    }
}
