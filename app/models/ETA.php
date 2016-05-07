<?php

class ETA {


	public static function calculate($minerData) {
		
		$ethBeforePayout = 1.00 - ('0.' . $minerData->unpaid);
        $mins = $ethBeforePayout / $minerData->ethPerMin;
        $hours = $mins / 60;

        $etaHours = (int)$hours;
        $etaMins = (int)(($hours - (int)$hours) * 60);

        $eta = $etaHours . ' hour(s), ' . $etaMins . ' min(s)';

        return $eta;
	}

}