<?php
namespace Spotton;

class Ranker
{
    const RATING_WEIGHT=10;
    const TIME_WEIGHT=3;
	
	public static function rank(array $array)
	{
		$times=[];
		foreach ($array as $stdobj) {
			$times[]=$stdobj->time;
		}
        $maxTime=max($times);
        $scores=[];
        foreach ($array as $stdobj) {
            $stdobj->score=self::getScore($stdobj, $maxTime);
            $scores[]=$stdobj->score;
        }
		array_multisort($scores, SORT_NUMERIC, $array);

		return $array;
	}
    
    public static function sortLatest(array $array) {
        $times=[];
        
        foreach ($array as $stdobj) {
            $times[]=strtotime($stdobj->time);
        }
        array_multisort($times, SORT_NUMERIC, $array);
        
        return $array;
    }

	public static function getScore(\stdClass $stdobj, $maxTime)
	{
		$rating=$stdobj->rating;
        $time=$stdobj->time/$maxTime;
		$score=$rating*self::RATING_WEIGHT - $time*self::TIME_WEIGHT;
        return $score;
	}

}