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
        $deleteCart = $this->getDoctrine()
            ->getRepository(Cart::class)
            ->deleteCart();
        $plan = $this->getDoctrine()->getRepository(WeekPlan::class)
            ->findOneBy(array('userId' => $user));

        $sql = "SELECT Recipes.Id
        FROM
        (SELECT monday
        from week_plan
         WHERE
         userId = {$user}
        UNION
        SELECT tuesday
        FROM week_plan
         WHERE
         userId = {$user}
         UNION ALL
        SELECT wednesday
        FROM week_plan
         WHERE
         userId = {$user}
         UNION ALL
        SELECT thursday
        FROM week_plan
         WHERE
         userId = {$user}
         UNION ALL
        SELECT friday
        FROM week_plan
         WHERE
         userId = {$user}
         UNION ALL
        SELECT saturday
        FROM week_plan
         WHERE
         userId = {$user}
         UNION ALL
        SELECT sunday
        FROM week_plan
         WHERE
         userId = {$user}
        ) Week

        JOIN (
        SELECT breakfast, id
        FROM day_plan
         UNION ALL
        SELECT snack1, id
        FROM day_plan
             UNION ALL
        SELECT dinner1, id
        FROM day_plan
             UNION ALL
        SELECT snack2, id
        FROM day_plan
             UNION ALL
        SELECT dinner2, id
        FROM day_plan


        ) Day ON Week.monday = Day.id
        JOIN recipes Recipes ON Day.breakfast = Recipes.id";

        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        foreach ($result as $recipe) {
            $repo = $this->getDoctrine()->getRepository('AppBundle:Recipe');

// this returns a single item
            $found = $repo->find($recipe["Id"]);
            $this->foreEachDays($found, $user);

        }

        return $this->redirect('view');

    }
    public function foreEachDays($day, $user)
    {
        $raws = $day->getRaws();
        $grams = $day->getArray();
        for ($i = 0; $i < count($raws); $i++) {

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
        $userHasWeekPlan = ($this->getDoctrine()->getRepository(WeekPlan::class)
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
        return $this->render('cart/view.html.twig', array('entity' => $products, 'userhasweek' => $userHasWeekPlan));
    }

}
