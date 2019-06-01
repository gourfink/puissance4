<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Grid;

class MoveController extends Controller
{
	public $auth = false;
	public $winn = false;

	public function __construct(RequestStack $request)
	{
		return $this;
	}

	public function is_authorized($player,$move, $grid)
	{

		/* check if there is a token down this token */
		if( $grid[$move] === false ){
			$index = $move + 7;
			if( $move > 34 ){
				$this->auth = true;
			}else{
				if( $grid[$index] !== false ){
					$this->auth = true;	
				}
			}			
		}

		return $this;
	}

	public function is_winning($datas)
	{

		// split player1 & player 2
		$player1 = [];
		$player2 = [];

		foreach($datas as $key => $token){
			if( $token === '1' ){
				$player1[$key] = true;
			}
			if( $token === '2' ){
				$player2[$key] = true;
			}
		}

		// check for vertical winn
		// for player 1
		if( $this->checkForVertical($player1) === true ){
			$this->winn = '1';
		}
		// for player 2 
		if( $this->checkForVertical($player2) === true ){
			$this->winn = '2';
		}

		// check for horizontal winn
		// for player 1
		if( $this->checkForHorizontal($player1) === true ){
			$this->winn = '1';
		}
		// for player 2 
		if( $this->checkForHorizontal($player2) === true ){
			$this->winn = '2';
		}

		// check for diagonal winn
		// for player 1
		if( $this->checkForDiagonal($player1) === true ){
			$this->winn = '1';
		}
		// for player 2 
		if( $this->checkForDiagonal($player2) === true ){
			$this->winn = '2';
		}


		return $this;
	}


	public function checkForVertical($tokens)
	{

		$winn = false;
		foreach($tokens as $key => $token){
			if( isset($tokens[$key+7]) && isset($tokens[$key+14]) && isset($tokens[$key+21]) ){
				if( ($tokens[$key+7] === true) && ($tokens[$key+14] === true) && ($tokens[$key+21] === true) ){
					$winn = true;		
				}				
			}
		}
		return $winn;
	}

	public function checkForHorizontal($tokens)
	{
		
		$winn = false;
		$four = 1;
		foreach($tokens as $key => $token){
			if( isset($tokens[$key+1]) ){
				if( $tokens[$key+1] === true ){
					$four++;
				}else{
					$four = 1;
				}
			}else{
				$four = 1;
			}
			if( $four === 4 ){
				$winn = true;
				break;
			}
		}
		return $winn;
	}

	public function checkForDiagonal($tokens)
	{
		$winn = false;
		foreach($tokens as $key => $token){
			if( isset($tokens[$key+8]) && isset($tokens[$key+16]) && isset($tokens[$key+24]) ){
				if( ($tokens[$key+8] === true) && ($tokens[$key+16] === true) && ($tokens[$key+24] === true) ){
					$winn = true;		
				}				
			}
		}

		if( $winn === true ){
			return $winn;
		}

		foreach($tokens as $key => $token){
			if( isset($tokens[$key+6]) && isset($tokens[$key+12]) && isset($tokens[$key+18]) ){
				if( ($tokens[$key+6] === true) && ($tokens[$key+12] === true) && ($tokens[$key+18] === true) ){
					$winn = true;		
				}				
			}
		}
		return $winn;		
	}

}