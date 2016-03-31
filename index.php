<?php

ini_set('precision',20);

	$accountAddress = '71e691772b64940d940ba4587fbccca55ddd9677';

	$minerURL = 'http://ethermine.org/api/miner/' . $accountAddress;
	$minerData = json_decode(file_get_contents($minerURL));

	//dd($minerData);

	
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
	$price = 'API CALL TOO SLOW';


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

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Ethereum Miner - Stats</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: 'Lato';
            }

            .title {
                font-weight: 600;
                font-size: 32px;
                text-align: center;
            }

            .stats {
                padding-top: 24px;
            }

            .table > tbody > tr > td {
                color: #000 !important;
                font-weight: 600;
            }

            .table > tbody > tr:first-child > td {
                border: none;
            }
        </style>

    </head>
    <body>
        <div class="container">

            <h1 class="title">Ethereum Miner Analytics</h1>

            <div class="row stats">
                <div class="col-md-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Miner Stats</h3>
                        </div>
                        <div class="panel-body">

                            <table class="table">
                                <tr>
                                    <td>Account:</td>
                                    <td><a href="https://etherchain.org/account/0x<?php echo $miner->address ?>" target="_blank">0x<?php echo $miner->address ?></a></td>
                                </tr>
                                <tr>
                                    <td>Main Rig Name:</td>
                                    <td><?php echo $miner->settings->name ? $miner->settings->name : 'unnamed' ?></td>
                                </tr>
                                <tr>
                                    <td>Unpaid:</td>
                                    <td>0.<?php echo $miner->unpaid ?> ETH</td>
                                </tr>
                                <tr>
                                    <td>ETA:</td>
                                    <td><?php echo $ETA ?></td>
                                </tr>
                                <tr>
                                    <td>Effective Hash Rate:</td>
                                    <td><?php echo $miner->hashRate ?></td>
                                </tr>
                                <tr>
                                    <td>Account Balance:</td>
                                    <td><?php echo substr_replace($account->balance, '.', 2, 0) ?> ETH</td>
                                </tr>
                                <tr>
                                    <td>Active Rigs:</td>
                                    <td><?php echo $miner->activeWorkers ?></td>
                                </tr>
                                <tr>
                                    <td>Payout Per Hour:</td>
                                    <td>$<?php echo $miner->usdPerMin * 60.00 ?> USD</td>
                                </tr>
                                <tr>
                                    <td>Payout Count:</td>
                                    <td><?php echo count($miner->payouts) ?> payouts</td>
                                </tr>
                            </table>

                        </div>

                    </div>
                </div>

                <div class="col-md-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ethereum Stats</h3>
                        </div>
                        <div class="panel-body">

                            <table class="table">
                                <tr>
                                    <td>USD Price:</td>
                                    <td>$ <?php echo $price ?> USD</td>
                                </tr>
                                <tr>
                                    <td>ETH Supply:</td>
                                    <td><?php echo $supply ?> ETH</td>
                                </tr>
                                <tr>
                                    <td>Difficulty:</td>
                                    <td><?php echo $difficulty ?></td>
                                </tr>
                                <tr>
                                    <td>Gas Price:</td>
                                    <td><?php echo $gasPrice ?></td>
                                </tr>
                                
                            </table>

                        </div>

                    </div>
                </div>
            </div>

        </div>



        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
</html>
