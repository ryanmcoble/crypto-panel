<?php
namespace CryptoPanel\repositories;

use Cache;
use Config;

class EtherchainRepository {

	/**
	 * Get etherchain.org API data
	 */
	public static function get() {

		$cache_timeout = Config::get('apis.cache_timeout');
		$accountAddress = Config::get('apis.account_address');

		$data = Cache::get('etherchain');

		if(!$data) {

			$data = [];

			$accountURL = 'https://etherchain.org/api/account/0x' . $accountAddress;
        	$data['account'] = json_decode(file_get_contents($accountURL))->data[0];

	        $priceURL = 'https://etherchain.org/api/statistics/price';
	        $priceData = json_decode(file_get_contents($priceURL));
	        $data['price'] = $priceData->data[count($priceData->data) - 1]->usd;

	        $gasPriceURL = 'https://etherchain.org/api/gasPrice';
	        $gasPriceData = json_decode(file_get_contents($gasPriceURL));
	        $data['gasPrice'] = $gasPriceData->data[0]->price;

	        $difficultyURL = 'https://etherchain.org/api/difficulty';
	        $difficultyData = json_decode(file_get_contents($difficultyURL));
	        $data['difficulty'] = $difficultyData->data[0]->difficulty;

	        $supplyURL = 'https://etherchain.org/api/supply';
        	$supplyData = json_decode(file_get_contents($supplyURL));
        	$data['supply'] = $supplyData->data[0]->supply;
			
        	Cache::put('etherchain', $data, $cache_timeout);
		}

		return $data;
	}


}