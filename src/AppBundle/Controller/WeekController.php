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

class WeekController extends Controller
{
    /**

    /* @Route("/week/view", name="week_view")
    /* @Security("is_granted('IS_AUTHENTICATED_FULLY')")

    /* @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewWeek()
    {

          $plan=$this->getWeek();
            if ($plan){
            return $this->render('week/view.html.twig'
                , array('plan' => $plan));}
            else{      return  $this->redirect('/week/generateWeek');
            }

    }
    public function getWeek(){
         $user = $this->getUser()->getId();

        return $this->getDoctrine()->getRepository(WeekPlan::class)
            ->findOneBy(array('userId' => $user));

    }



}
