<?php
namespace Spotton;

class Ranker
{
	
	public static function rank(array $array)
	{
		$scores=[];
		foreach ($array as $stdobj) {
			$stdobj->score=self::getScore($stdobj);
			$scores[]=$stdobj->score;
		}

		array_multisort($scores, $array, SORT_DESC);

		return $array;
	}

	public static function getScore(\stdClass $stdobj)
	{
		$rating=$stdobj->rating;
		$order=log(max($rating,1), 10);
		
		if ($rating > 0) {
			$sign=1;
		} else {
			$sign=0;
		}

		$seconds=strtotime($stdobj->time) - 113402800;

		$score=round($order + $sign * $seconds / 100000, 7);
		return $score;
	}

}