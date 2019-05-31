<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\MoveController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Grid;

class GameController extends Controller
{

	/**
     * Matches /move exactly
     *
     * @Route("/move", name="move_token")
     */
	public function move(RequestStack $request)
	{
		$response = new JsonResponse;
		$return = new MoveController($request);

		$response->headers->set('Access-Control-Allow-Origin', '*');
		$response->setData($return);

		return $response;
	}

	/**
     * Matches /grid exactly
     *
     * @Route("/grid", name="grid_design")
     */
	public function grid()
	{
		$grid = $this->getDoctrine()->getRepository(Grid::class)->find(1);
		$response = new JsonResponse;

		$datas = [];
		for($i=0; $i < 42; $i++){
			$datas[$i] = false;
		}

		$response->headers->set('Access-Control-Allow-Origin', '*');
		$response->setData(json_decode($grid->getState()));

		return $response;
	}

}