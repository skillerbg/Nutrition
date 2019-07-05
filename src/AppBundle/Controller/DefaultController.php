<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\WeekPlan;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $day=date("l");


        if ( $this->getUser() && $this->getDoctrine()->getRepository(WeekPlan::class)
                ->findOneBy(array('userId' => $this->getUser()->getId()))){
            $weekController=$this->getWeek2();
            $datPlan=$this->findDay($day,$weekController);
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,'day'=>$datPlan
        ]);
        }else{
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
            ]);
        }
    }

    public function getWeek2(){
    $user = $this->getUser()->getId();

    return $this->getDoctrine()->getRepository(WeekPlan::class)
        ->findOneBy(array('userId' => $user));

}public function findDay($day,$weekController){


    $dayPlan=null;
        switch ($day){
            case 'Monday':$dayPlan=$weekController->getMonday();break;
            case 'Tuesday':$dayPlan=$weekController->getTuesday();break;
            case 'Wednesday':$dayPlan=$weekController->getWednesday();break;
            case 'Thursday':$dayPlan=$weekController->getThursday();break;
            case 'Friday':$dayPlan=$weekController->getFriday();break;
            case 'Saturday':$dayPlan=$weekController->getSaturday();break;
            case 'Sunday':$dayPlan=$weekController->getSunday();break;
        }
        return $dayPlan;

}
}