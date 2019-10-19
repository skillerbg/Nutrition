<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cart;
use AppBundle\Entity\DayPlan;
use AppBundle\Entity\WeekPlan;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    public function generate(Request $request)
    {
        $userId = $this->getUser()->getId();

        $em = $this->getDoctrine()->getManager();

        $filter = $em->getRepository('AppBundle:Filter')->findOneBy(array('userId' => $userId)); //Gets user's filter
        if (isset($filter)) {
            $day = $this->generateDay($filter->getKcal(), $filter->getBudget()); //Generates dat plan

            return $this->render('day/view.html.twig'
                , array('day' => $day));
        } else {
            return $this->redirectToRoute('week_filter');
        }
    }

    public function generateDay($kcal = null, $price = null)
    {
        $dayPlan = new DayPlan();

        $search = true; //Generate day plan with the filter params

        $count = 100; //Amount of attempts to generate a day with the user's filter
        while ($search) {
            $count--;
            if ($count < 1) {
                $this->redirect('week/error.html.twig');
            }
            //Generates a random day plan
            $meals[0] = $this->randomRecipe('breakfast');
            $meals[1] = $this->randomRecipe('snack');
            $meals[2] = $this->randomRecipe('dinner');
            $meals[3] = $this->randomRecipe('snack');
            $meals[4] = $this->randomRecipe('dinner');
            if ($kcal == null) { //checks if user has set kcal filter
                $search = false; //stops the search
            } else {
                //sums the generated plan's params
                $currentKcal = 0;
                $currentPrice = 0;
                for ($i = 0; $i <= 4; $i++) {
                    $currentKcal += $meals[$i]->getRecipeNutrition()->getKcal();
                    $currentPrice += $meals[$i]->getPrice();

                }

                // checks if the generated plan matches the user's filters
                if ((intval($kcal) - 50 <= $currentKcal) && ($currentKcal <= intval($kcal) + 50) && ($currentPrice <= intval($price) + 1)) {
                    $search = false;
                };
            }
        }

        //Saves the day plan in db
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

    public function randomRecipe($entity)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Recipe');

        //gets amount of recipes in DB
        $countOfRecipes = $repo->createQueryBuilder('u')
            ->where('u.type = ?1')
            ->setParameter(1, $entity)
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $countOfRecipes = intval($countOfRecipes);
        $randomRecipeId = rand(1, $countOfRecipes); //Choses a random recipe Id

        $recipeEntity = $repo->findBy(array('type' => $entity), array('type' => 'ASC'), 1, $randomRecipeId - 1)[0]; //gets the recipe entity by the random id

        return $recipeEntity;

    }

    /**
     * @param Request $request
     * @Route("/day/regenerate", name="day_regenerate")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function regenerateDay(Request $request)
    {
        $day = $request->query->get('day'); //the day to regenerate

        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $filter = $em->getRepository('AppBundle:Filter')->findOneBy(array('userId' => $user)); //get the users filter

        if (!isset($filter)) {

            return $this->redirectToRoute('week_filter');
        }

        $kcal = $filter->getKcal();
        $price = $filter->getBudget();
        $newDay = $this->generateDay($kcal, $price); //generate new day plan with the user's filter

        //updates the week plan with the newly generated day
        $em = $this->getDoctrine()
            ->getRepository(WeekPlan::class);
        $day = "u." . $day;
        $q = $em->createQueryBuilder('u')
            ->update('AppBundle:WeekPlan', 'u')
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
    public function generateWeek(Request $request)
    {
        $deleteCart = $this->getDoctrine()
            ->getRepository(Cart::class)
            ->deleteCart();
        $weekPlan = new WeekPlan();
        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $filter = $em->getRepository('AppBundle:Filter')->findOneBy(array('userId' => $user)); //gets the user's filter params
        if (!isset($filter)) {

            return $this->redirectToRoute('week_filter');
        }
        $kcal = $filter->getKcal();
        $price = $filter->getBudget();

        $weekPlan->setMonday($this->generateDay($kcal, $price))
            ->setTuesday($this->generateDay($kcal, $price))
            ->setWednesday($this->generateDay($kcal, $price))
            ->setThursday($this->generateDay($kcal, $price))
            ->setFriday($this->generateDay($kcal, $price))
            ->setSaturday($this->generateDay($kcal, $price))
            ->setSunday($this->generateDay($kcal, $price))
            ->setUserId($user);

        //deletes the user's previous week plan
        $this->dropOld('WeekPlan');

        $em = $this->getDoctrine()->getManager();
        $em->persist($weekPlan);
        $em->flush();
        return $this->redirectToRoute('week_view');

    }

    public function dropOld($entity)
    {
        $user = $this->getUser()->getId();

        $em = $this->getDoctrine()->getManager();

        //gets the user's previous week plan
        $oldWeekPlan = $em->getRepository('AppBundle:' . $entity)->findOneBy(array('userId' => $user));

        //deletes user's previous week plan if exists
        if ($oldWeekPlan) {
            $em->remove($oldWeekPlan);
            $em->flush();
        }

    }

}
