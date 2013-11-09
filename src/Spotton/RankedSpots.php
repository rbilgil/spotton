<?php
namespace Spotton;

class RankedSpots
{
	
	public static function rankSpots(array $spots)
	{
		$scores=[];
		foreach ($spots as $spot) {
			$spot->score=self::getScore($spot);
			$scores[]=$spot->score;
		}

		array_multisort($scores, $spots, SORT_DESC);

		return $spots;
	}

	public static function getScore(\stdClass $spot)
	{
		$rating=$spot->rating;
		$order=log(max($rating,1), 10);
		
		if ($rating > 0) {
			$sign=1;
		} else {
			$sign=0;
		}

		$seconds=strtotime($spot->time) - 113402800;

		$score=round($order + $sign * $seconds / 100000, 7);
		return $score;
	}

}