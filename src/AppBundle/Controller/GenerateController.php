<?php

namespace AppBundle\Controller;
use AppBundle\Entity\DayPlan;
use AppBundle\Entity\WeekPlan;
use AppBundle\Form\DayPlanType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class GenerateController extends Controller
{
     /**
     * @param Request $request
     * @Route("/day/generate", name="day_generate")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
   public function generate(Request $request )
   {

           $day = $this->generateDay();
       return $this->render('recipe/view.html.twig'
           ,array('day' => $day));
   }



    public function generateDay(){
        $dayPlan= new DayPlan();

        $meals[0] =$this->random('breakfast');
        $meals[1]=$this->random('snack');
        $meals[2]=$this->random('dinner');
        $meals[3]=$this->random('snack');
        $meals[4]=$this->random('dinner');

        $dayPlan->setBreakfast($meals[0])
            ->setSnack1($meals[1])
            ->setDinner1($meals[2])
            ->setSnack2($meals[3])
            ->setDinner2($meals[4]);

        $em = $this->getDoctrine()->getManager();
        $em->persist($dayPlan);
        $em->flush();

        return $dayPlan;

    }
    public function random($entity){
        $repo = $this->getDoctrine()->getRepository('AppBundle:Recipe');
        $number=$repo->createQueryBuilder('u')
            ->where('u.type = ?1')
            ->setParameter(1, $entity)
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $number=intval($number);
        $number=rand(1,$number);
        $result= $repo->findBy(array('type' => $entity),array('type' => 'ASC'),1, $number-1)[0];


       return $result;



    }

    /**
     * @param Request $request
     * @Route("/day/regenerate", name="day_regenerate")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function regenerateDay(Request $request){
        $day=    $request->query->get('day');
        $day="u.".$day;
        $user = $this->getUser()->getId();
        $newDay=$this->generateDay();
        $em = $this->getDoctrine()
            ->getRepository(WeekPlan::class);

        $q=$em->createQueryBuilder('u')
            ->update('AppBundle:WeekPlan','u')
            ->set($day, $newDay->getId())
            ->Where('u.userId = ?1')
            ->setParameter(1, $user)

            ->getQuery();
         $q->execute();

        return $this->redirectToRoute('week_view');




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


    public function dropOld($user){
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:WeekPlan')->findOneBy(array('userId'=> $user));

        if ($post) {



        $em->remove($post);
        $em->flush();
        }


    }

}
