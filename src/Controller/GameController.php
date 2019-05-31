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
		$MoveController = new MoveController($request);

		$entityManager = $this->getDoctrine()->getManager();
		$grid = $entityManager->getRepository(Grid::class)->find(1);

		$current = json_decode($grid->getState());

		$query = $request->getCurrentRequest();
		$player = $query->query->get('p');
		$move = intval($query->query->get('m'));

		$MoveController->is_authorized($player, $move, $current->data);

		if( $MoveController->auth === true ){

			$current->data[$move] = $player;
			$return = $current;

			// save the move
			$grid->setState(json_encode([ 'data' => $current->data]));
			$entityManager->flush();

			$MoveController->is_winning($current->data);

			// return auth
			$response = new JsonResponse;
			$response->headers->set('Access-Control-Allow-Origin', '*');
			$response->setData(['auth' => true,'winn' => $MoveController->winn]);
		}else{
			// return auth
			$response = new JsonResponse;
			$response->headers->set('Access-Control-Allow-Origin', '*');
			$response->setData(['auth' => false, 'winn' => false]);
		}



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


	/**
     * Matches /clear exactly
     *
     * @Route("/clear", name="clear_game")
     */
	public function clear()
	{
		$entityManager = $this->getDoctrine()->getManager();
		$grid = $entityManager->getRepository(Grid::class)->find(1);

		$datas = [];
		for($i=0; $i < 42; $i++){
			$datas[$i] = false;
		}

		$grid->setState(json_encode([ 'data' => $datas]));
		$entityManager->flush();

		$response = new JsonResponse;
		$response->headers->set('Access-Control-Allow-Origin', '*');
		return $response;
	}

}