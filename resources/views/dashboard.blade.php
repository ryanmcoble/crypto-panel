@extends('layout.master')

@section('content')

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
                        <td><?php echo substr_replace((string)$account->balance, '.', (strlen($account->balance)-18), 0) ?> ETH</td>
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

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Operation Stats</h3>
            </div>
            <div class="panel-body">

                <table class="table">
                    <tr>
                        <td>Total:</td>
                        <td>$ <?php echo $total ?> USD</td>
                    </tr>
                    
                </table>

            </div>

        </div>
    </div>
</div>

@endsection