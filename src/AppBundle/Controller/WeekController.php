<?php

namespace AppBundle\Controller;
use AppBundle\Entity\DayPlan;
use AppBundle\Entity\WeekPlan;
use AppBundle\Form\DayPlanType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Raw;
use AppBundle\Form\RawType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class WeekController extends Controller
{
    /**

    /* @Route("/week/view", name="week_view")
    /* @Security("is_granted('IS_AUTHENTICATED_FULLY')")

    /* @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewWeek()
    {

        $user = $this->getUser()->getId();

        $plan = $this->getDoctrine()->getRepository(WeekPlan::class)
            ->findOneBy(array('userId'=> $user));

        return $this->render('week/view.html.twig'
                  ,array('plan' => $plan));

    }

//    public function getName($day,$meal){
//        $user = $this->getUser()->getId();
//
//        $repo = $this->getDoctrine()->getRepository(WeekPlan::class);
//
//        $sday="u.".$day;
//        $smeal="p.".$meal;
//        return $repo->createQueryBuilder('u')
//            ->select('z.name','z.id')
//            ->where('u.userId = :user_id')
//            ->setParameter(':user_id', $user)
//            ->innerJoin($sday, "p")
//            ->innerJoin($smeal, "z")->addSelect("z.name")
//
//            ->getQuery()->getResult() ;
//
//
//
//    }




//    public function getDayplan($id){
//        $em = $this->getDoctrine()->getManager();
//        $day = $em->getRepository('AppBundle:DayPlan')->find($id);
//        var_dump($day);
//            return $day;
//    }

}
