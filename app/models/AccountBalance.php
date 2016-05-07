<?php


class AccountBalance {

	public static function toString($balance) {

		$balance = $balance / 100;
		$balance = substr_replace($balance, '.', 18 - strlen($balance), 0);

		return $balance;
	}
}