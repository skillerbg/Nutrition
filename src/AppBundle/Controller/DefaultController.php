<?php
namespace AppBundle\Controller;

use AppBundle\Entity\WeekPlan;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        if ($this->getUser()) {
            //$userData is used to tell twig which homepage templates to render
            $userData = array("filter" => false, "weekplan" => false);
            $em = $this->getDoctrine()->getManager();

            if ($em->getRepository('AppBundle:Filter')->findOneBy(array('userId' => $this->getUser()->getId()))) {
                $userData["filter"] = true;
            }
            if ($this->getDoctrine()->getRepository(WeekPlan::class)
                ->findOneBy(array('userId' => $this->getUser()->getId()))) {
                $userData["weekplan"] = true;
            }

            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR, 'userdata' => $userData,
            ]);
        } else {
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            ]);
        }
    }

}
