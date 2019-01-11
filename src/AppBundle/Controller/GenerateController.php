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

class GenerateController extends Controller
{
     /**
     * @param Request $request
     * @Route("/raw/generate", name="raw_generate")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
   public function generate(Request $request )
   {

           $day = $this->generateDay();

       return $this->render('raw/view.html.twig'
           ,array('day' => $day));
   }

    public function generateDay(){
        $dayPlan= new DayPlan();

        $breakfast =$this->random('AppBundle:Raw');
        $snack=$this->random('AppBundle:Snack');
        $dinner=$this->random('AppBundle:Dinner');
        $snack2=$this->random('AppBundle:Snack');
        $dinner2=$this->random('AppBundle:Dinner');
        $dayPlan->setBreakfast($breakfast)
            ->setSnack1($snack)
            ->setDinner1($dinner)
            ->setSnack2($snack2)
            ->setDinner2($dinner2);

        $em = $this->getDoctrine()->getManager();
        $em->persist($dayPlan);
        $em->flush();

       return $dayPlan;

    }
    /**

    /* @Route("/week/generateWeek", name="week_generate")
    /* @Security("is_granted('IS_AUTHENTICATED_FULLY')")
    /*
    /* @return \Symfony\Component\HttpFoundation\Response
     */
    public function generateWeek(){
       $weekPlan= new WeekPlan();
        $user = $this->getUser()->getId();

        $weekPlan->setMonday($this->generateDay())
           ->setTuesday($this->generateDay())
           ->setWednesday($this->generateDay())
           ->setThursday($this->generateDay())
           ->setFriday($this->generateDay())
           ->setSaturday($this->generateDay())
           ->setSunday($this->generateDay())
           ->setUserId($user);
        $this->dropOld($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($weekPlan);
        $em->flush();
        return $this->redirectToRoute('week_view');


    }

    public function random($entity){
        $repo = $this->getDoctrine()->getRepository($entity);
        $number=$repo->createQueryBuilder('u')
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult();
        $number=intval($number);
        return  $repo->find(rand(1,$number));
    }
    public function dropOld($user){
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:WeekPlan')->findOneBy(array('userId'=> $user));

        if ($post) {



        $em->remove($post);
        $em->flush();
        }


    }

}
