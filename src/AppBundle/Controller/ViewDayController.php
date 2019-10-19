<?php

namespace AppBundle\Controller;

use AppBundle\Entity\WeekPlan;
use AppBundle\AppBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ViewDayController extends Controller
{   /**
    * @param Request $request
    *
    * @Route("/day/view", name="day_view")
    * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
    *
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function viewDay(Request $request)
    {
        $dayId = $request->query->get('day');
        $em = $this->getDoctrine()->getManager();

        $day = $em->getRepository('AppBundle:DayPlan')->find($dayId);

        return $this->render('day/view.html.twig'
            , array('day' => $day));

    }

    /**
     * @Route("day/today", name="view_today")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * 
     */
    public function viewTodayAction(Request $request)
    {

        $day = date("l");

        
            $weekController = $this->getWeek2();
            $datPlan = $this->findDay($day, $weekController);
            return $this->render('day/view.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR, 'day' => $datPlan,
            ]);
        
    }
    public function getWeek2()
    {
        $user = $this->getUser()->getId();

        return $this->getDoctrine()->getRepository(WeekPlan::class)
            ->findOneBy(array('userId' => $user));

    }public function findDay($day, $weekController)
    {

        $dayPlan = null;
        switch ($day) {
            case 'Monday':$dayPlan = $weekController->getMonday();
                break;
            case 'Tuesday':$dayPlan = $weekController->getTuesday();
                break;
            case 'Wednesday':$dayPlan = $weekController->getWednesday();
                break;
            case 'Thursday':$dayPlan = $weekController->getThursday();
                break;
            case 'Friday':$dayPlan = $weekController->getFriday();
                break;
            case 'Saturday':$dayPlan = $weekController->getSaturday();
                break;
            case 'Sunday':$dayPlan = $weekController->getSunday();
                break;
        }
        return $dayPlan;

    }
}
