<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ViewDayController extends Controller
{/**
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
}
