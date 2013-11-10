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

		array_multisort($scores, $array, SORT_ASC);

		return $array;
	}
    
    public static function sortLatest(array $array) {
        $times=[];
        
        foreach ($array as $stdobj) {
            $times[]=strtotime($stdobj->time);
        }
        array_multisort($times, $array, SORT_DESC);
        
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

		$seconds=strtotime($stdobj->time);

		$score=round($order * $sign * $seconds, 2);
		return $score;
	}

}