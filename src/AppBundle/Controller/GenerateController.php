<?php

namespace AppBundle\Controller;
use AppBundle\Entity\DayPlan;
use AppBundle\Entity\Filters;
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
        return $this->render('day/view.html.twig'
            ,array('day' => $day));
    }


    /**
     * @param Request $request
     * @Route("/week/filter", name="week_filter")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function filterWeek(Request $request )
    {


        return $this->render('week/filter.html.twig');
    }



    public function generateDay($kcal=null,$price=null){
        $dayPlan= new DayPlan();
        $search=true;
        $count=100;
        while   ($search ) {
            $count--;
            if ($count<15){
                 $this->redirect('week/error.html.twig');
            }
            $meals[0] = $this->random('breakfast');
            $meals[1] = $this->random('snack');
            $meals[2] = $this->random('dinner');
            $meals[3] = $this->random('snack');
            $meals[4] = $this->random('dinner');
            if ($kcal==null){
                $search=false;
            }else{
                $currentKcal = 0;
                $currentPrice=0;
                for ($i = 0; $i <= 4; $i++) {
                    $currentKcal += $meals[$i]->getRecipeNutrition()->getKcal();
                    $currentPrice+=$meals[$i]->getPrice();

                }
                if (($kcal - 50 <= $currentKcal) && ($currentKcal <= $kcal + 50)&&($price -1 <= $currentPrice) && ($currentPrice <= $price + 1)) {
                    $search = false;
                };
            }
        }
        $filters=new Filters();
        $filters->setUserId($this->getUser()->getId())
        ->setKcal($kcal)
        ->setBudget($price);

        $dayPlan->setBreakfast($meals[0])
            ->setSnack1($meals[1])
            ->setDinner1($meals[2])
            ->setSnack2($meals[3])
            ->setDinner2($meals[4]);
        $this->dropOld('Filters');
        $em = $this->getDoctrine()->getManager();
        $em->persist($dayPlan);
        $em->merge($filters);
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
        $filtersRepository = $this->getDoctrine()->getRepository(Filters::class);
        $filters=$filtersRepository->findOneBy(['userId' => $user]);
        $kcal=$filters->getKcal();
        $price=$filters->getBudget();
        $newDay=$this->generateDay($kcal,$price);
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
     * @param Request $request

    /* @Route("/week/generateWeek", name="week_generate")
    /* @Security("is_granted('IS_AUTHENTICATED_FULLY')")
    /*
    /* @return \Symfony\Component\HttpFoundation\Response
     */
    public function generateWeek(Request $request){
        $weekPlan= new WeekPlan();
        $user = $this->getUser()->getId();
        $filter=    $request->request->get('filter');
        $kcal=$filter['kcal'];
        $price=$filter['price'];


        $weekPlan->setMonday($this->generateDay($kcal,$price))
            ->setTuesday($this->generateDay($kcal,$price))
            ->setWednesday($this->generateDay($kcal,$price))
            ->setThursday($this->generateDay($kcal,$price))
            ->setFriday($this->generateDay($kcal,$price))
            ->setSaturday($this->generateDay($kcal,$price))
            ->setSunday($this->generateDay($kcal,$price))
            ->setUserId($user);
        $this->dropOld('WeekPlan');

        $em = $this->getDoctrine()->getManager();
        $em->persist($weekPlan);
        $em->flush();
        return $this->redirectToRoute('week_view');


    }


    public function dropOld($entity){
        $user = $this->getUser()->getId();

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:'.$entity)->findOneBy(array('userId'=> $user));

        if ($post) {



            $em->remove($post);
            $em->flush();
        }


    }


}
