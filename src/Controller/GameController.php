<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\MoveController;


class GameController
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
		$response = new JsonResponse;
		$response->setData(['data' => 123]);

		return $response;
	}

}