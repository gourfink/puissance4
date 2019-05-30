<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\RequestStack;

class MoveController
{
	public $auth;
	public $winn;

	/**
	
	*/
	public function __construct(RequestStack $request)
	{
		$query = $request->getCurrentRequest();
		$player = $query->query->get('p');
		$move = $query->query->get('m');
		
		$this->is_authorized($player,$move);

		$this->is_winning($player,$move);

		return $this;
	}

	protected function is_authorized($player,$move){

		$this->auth = true;

		return $this;
	}

	protected function is_winning($player, $move){

		$this->winn = false;

		return $this;
	}

}