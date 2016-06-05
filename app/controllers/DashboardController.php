<?php

use CryptoPanel\repositories\EthermineRepository;
use CryptoPanel\repositories\EtherchainRepository;

class DashboardController extends BaseController {

	public function index() {

		// set the decimal percision so we can deal with crypto currencies
        ini_set('precision',20);


        // ethermine and etherchain API data
        $ethermine = EthermineRepository::get();
        $etherchain = EtherchainRepository::get();
        
        extract($etherchain); // extract all the etherchain API call data into separate variables

        // convert balance
        $account->balance = AccountBalance::toString($account->balance);

        //calculate ETA
        $ETA = ETA::calculate($ethermine);

        // calculate USD total
        $total = (double) $account->balance * $price;

        // setup view data
        $viewData = [
            'miner'      => $ethermine,
            'account'    => $account,
            'ETA'        => $ETA,
            'price'      => $price,
            'supply'     => $supply,
            'difficulty' => $difficulty,
            'gasPrice'   => $gasPrice,
            'total'      => $total,
        ];

        return View::make('dashboard', $viewData);
	}

    public function uploads() {
        return View::make('uploads');
    }

}
