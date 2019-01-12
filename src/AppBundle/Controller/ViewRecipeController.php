<?php

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use Proxies\__CG__\AppBundle\Entity\Recipe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Raw;
use AppBundle\Form\RawType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ViewRecipeController extends Controller
{ /**
 * @param Request $request
 *
 * @Route("/recipe/view", name="recipe_view")
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 *
 * @return \Symfony\Component\HttpFoundation\Response
 */
    public function View(Request $request)
    {
        $id=    $request->query->get('id');

        $db = $this->getDoctrine()->getRepository('AppBundle:Recipe');
          $entity=$db->find($id);

        return $this->render('default/view.html.twig.php', array('entity' => $entity));
    }
}
