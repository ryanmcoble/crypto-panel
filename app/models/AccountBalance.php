<?php


class AccountBalance {

	public static function toString($balance) {

		$balance = substr_replace($balance, '.', strlen($balance) - 18, 0);

		return $balance;
	}
}