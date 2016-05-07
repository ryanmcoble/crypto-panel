<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // set the decimal percision so we can deal with crypto currencies
        ini_set('precision',20);


        // miner stats repository

        // currency stats repository



        /*
         * OLD STUFF - just to get it back up quickly
         */

        $accountAddress = '71e691772b64940d940ba4587fbccca55ddd9677';

        $minerURL = 'http://ethermine.org/api/miner/' . $accountAddress;
        $minerData = json_decode(file_get_contents($minerURL));


        $accountURL = 'https://etherchain.org/api/account/0x' . $accountAddress;
        $accountData = json_decode(file_get_contents($accountURL))->data[0];

        // convert balance
        $accountData->balance = $accountData->balance / 100;

        //calculated ETA
        $ethBeforePayout = 1.00 - ('0.' . $minerData->unpaid);
        $mins = $ethBeforePayout / $minerData->ethPerMin;
        $hours = $mins / 60;

        $etaHours = (int)$hours;
        $etaMins = (int)(($hours - (int)$hours) * 60);

        $eta = $etaHours . ' hour(s), ' . $etaMins . ' min(s)';


        // SLOW API CALL - NEED TO CACHE
        $priceURL = 'https://etherchain.org/api/statistics/price';
        $priceData = json_decode(file_get_contents($priceURL));
        $price = $priceData->data[count($priceData->data) - 1]->usd;
        //$price = 'API CALL TOO SLOW';


        $gasPriceURL = 'https://etherchain.org/api/gasPrice';
        $gasPriceData = json_decode(file_get_contents($gasPriceURL));
        $gasPrice = $gasPriceData->data[0]->price;


        $difficultyURL = 'https://etherchain.org/api/difficulty';
        $difficultyData = json_decode(file_get_contents($difficultyURL));
        $difficulty = $difficultyData->data[0]->difficulty;


        $supplyURL = 'https://etherchain.org/api/supply';
        $supplyData = json_decode(file_get_contents($supplyURL));
        $supply = $supplyData->data[0]->supply;

        $miner = $minerData;
        $ETA = $eta;
        $account = $accountData;

        $total = doubleval(substr_replace($account->balance, '.', (strlen($account->balance)-18), 0)) * $price;


        $viewData = [
            'miner'      => $miner,
            'account'    => $account,
            'ETA'        => $ETA,
            'price'      => $price,
            'supply'     => $supply,
            'difficulty' => $difficulty,
            'gasPrice'   => $gasPrice,
            'total'      => $total,
        ];

        return view('dashboard')->with($viewData);
    }
}
