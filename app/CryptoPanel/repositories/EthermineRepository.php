<?php
namespace CryptoPanel\repositories;

use Cache;
use Config;

class EthermineRepository {

	/**
	 * Get etherchain.org API data
	 */
	public static function get() {

		$cache_timeout = Config::get('apis.cache_timeout');
		$accountAddress = Config::get('apis.account_address');

		$data = Cache::get('ethermine');

		//dd($data);

		if(!$data) {

			$minerURL = 'http://ethermine.org/api/miner/' . $accountAddress;
        	$data = json_decode(file_get_contents($minerURL));
			
        	Cache::put('ethermine', $data, $cache_timeout);
		}

		return $data;
	}


}