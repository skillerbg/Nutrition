<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Filter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class FilterController extends Controller
{/**
* @param Request $request
* @Route("/week/filter", name="week_filter")
* @Security("is_granted('IS_AUTHENTICATED_FULLY')")
*
* @return \Symfony\Component\HttpFoundation\Response
*/
public function filterWeek(Request $request )
{
    $data=    $request->request->get('filter');
    $user = $this->getUser()->getId();

    if ($data) {
        $em = $this->getDoctrine()->getManager();
        $filter = new Filter();

        //sets the params to filter entity
        $filter->setBudget($data['price'])
            ->setKcal($data['kcal'])
            ->setUserId($user);



        //checks if user has an old filter and deletes it
        $userCurrentFilter = $em->getRepository('AppBundle:Filter')->findOneBy(array('userId' => $user));
        if ($userCurrentFilter) {
            $em->remove($userCurrentFilter);
            $em->flush();
        }

        //saves the new filter
        $em->persist($filter);
        $em->flush();
        return $this->redirectToRoute('homepage');

    }

    //renders the the filter with user's current params or the default params
    $em = $this->getDoctrine()->getManager();
    $userCurrentFilter = $em->getRepository('AppBundle:Filter')->findOneBy(array('userId' => $user));
    if ($userCurrentFilter) {
    return $this->render('week/filter.html.twig'
        ,array('filter' => $userCurrentFilter));
    }else{
        $newFilter=new Filter();
        $newFilter->setKcal(2000)->setBudget(20);
        return $this->render('week/filter.html.twig'
            ,array('filter' => $newFilter));    }
}}