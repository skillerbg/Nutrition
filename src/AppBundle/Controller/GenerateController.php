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

        return $this->render('day/view.html.twig'
            , array('day' => $this->generateDay()));

    }

    //Generate day plan with user's filter options (calories and budget per day)
    public function generateDay()
    {
        $dayPlan = new DayPlan();

        $userId = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        //Gets user's filter
        $filter = $em->getRepository('AppBundle:Filter')->findOneBy(array('userId' => $userId));

        //Generates day plan or ask the user to chose filter
        if (isset($filter)) {

            //attemp to generate a day plan with the filter
            $meals = $this->attempDay($filter);

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
        } else {
            return $this->redirectToRoute('week_filter');
        }

    }

    public function attempDay($filter)
    {

        $count = 100; //Amount of attempts to generate a day with the user's filter
        $kcal = $filter->getKcal();
        $price = $filter->getBudget();

        $search = true; //Generate day plan with the filter params
        while ($search) {
            $count--;
            if ($count < 1) {
                $this->redirect('week/error.html.twig');
            }
            //Generates a random day plan
            $meals = array(
                $this->randomRecipe('breakfast'),
                $this->randomRecipe('snack'),
                $this->randomRecipe('dinner'),
                $this->randomRecipe('snack'),
                $this->randomRecipe('dinner'),
            );

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
        return $meals;
    }

    public function randomRecipe($entity)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Recipe');

        //check how many recipes are in DB
        $countOfRecipes = $repo->createQueryBuilder('u')
            ->where('u.type = ?1')
            ->setParameter(1, $entity)
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult();
        $countOfRecipes = intval($countOfRecipes);

        //Choses a random recipe Id
        $randomRecipeId = rand(1, $countOfRecipes);

        //get the recipe entity by the random id
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

        //generate new day plan with the user's filter
        $newDay = $this->generateDay();

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
    * @Route("/week/generateWeek", name="week_generate")
    * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
    *
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function generateWeek(Request $request)
    {
        //delete the user's filter
        $deleteCart = $this->getDoctrine()
            ->getRepository(Cart::class)
            ->deleteCart();

        //deletes the user's previous week plan
        $this->deleteOldWeek('WeekPlan');

        //create new week plan with new day plans
        $weekPlan = new WeekPlan();
        $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $weekPlan->setMonday($this->generateDay())
            ->setTuesday($this->generateDay())
            ->setWednesday($this->generateDay())
            ->setThursday($this->generateDay())
            ->setFriday($this->generateDay())
            ->setSaturday($this->generateDay())
            ->setSunday($this->generateDay())
            ->setUserId($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($weekPlan);
        $em->flush();

        return $this->redirectToRoute('week_view');

    }

    public function deleteOldWeek($entity)
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
