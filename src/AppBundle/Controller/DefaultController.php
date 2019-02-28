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
        $datPlan=$this->findDay($day);
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,'day'=>$datPlan
        ]);
    }
    public function getWeek2(){
    $user = $this->getUser()->getId();

    return $this->getDoctrine()->getRepository(WeekPlan::class)
        ->findOneBy(array('userId' => $user));

}public function findDay($day){
    $weekController=$this->getWeek2();

    $dayPlan=null;
        switch ($day){
            case 'Monday':$dayPlan=$weekController->getMonday();break;
            case 'Tuesday':$dayPlan=$weekController->getThuesday();break;
            case 'Wednesday':$dayPlan=$weekController->getWednesday();break;
            case 'Thursday':$dayPlan=$weekController->getThursday();break;
            case 'Friday':$dayPlan=$weekController->getFriday();break;
            case 'Saturday':$dayPlan=$weekController->getSaturday();break;
            case 'Sunday':$dayPlan=$weekController->getSunday();break;
        }
        return $dayPlan;

}
}