@extends('layout.master')

<?php $title = 'Stats'; ?>
@section('content')

<h1 class="title">Crypto Analytics</h1>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#miner-stats" aria-controls="miner-stats" role="tab" data-toggle="tab">Miner Stats</a>
    </li>
    <li role="presentation">
        <a href="#eth-stats" aria-controls="eth-stats" role="tab" data-toggle="tab">ETH Stats</a>
    </li>
    <li role="presentation">
        <a href="#operation" aria-controls="operation" role="tab" data-toggle="tab">Operation</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane animated fadeIn active" id="miner-stats">

        <table class="table table-bordered table-striped">
            <thead>
                <!-- <tr>
                    <th>Label</th>
                    <th>Value</th>
                </tr> -->
            </thead>
            <tbody>
                <tr>
                    <td>Account:</td>
                    <td>
                        <a href="https://etherchain.org/account/0x{{ $miner->address }}" target="_blank">0x{{ $miner->address }}</a>
                    </td>
                </tr>
                <tr>
                    <td>Main Rig Name:</td>
                    <td>{{ $miner->settings->name ? $miner->settings->name : 'unnamed' }}</td>
                </tr>
                <tr>
                    <td>Unpaid:</td>
                    <td>{{ $miner->unpaid }} ETH</td>
                </tr>
                <tr>
                    <td>ETA:</td>
                    <td>{{ $ETA }}</td>
                </tr>
                <tr>
                    <td>Effective Hash Rate:</td>
                    <td>{{ $miner->hashRate }}</td>
                </tr>
                <tr>
                    <td>Account Balance:</td>
                    <td>{{ $account->balance }} ETH</td>
                </tr>
                <tr>
                    <td>Active Rigs:</td>
                    <td>{{ $miner->activeWorkers }}</td>
                </tr>
                <tr>
                    <td>Payout Per Hour:</td>
                    <td>${{ $miner->usdPerMin * 60.00 }} USD</td>
                </tr>
                <tr>
                    <td>Payout Count:</td>
                    <td>{{ count($miner->payouts) }} payouts</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div role="tabpanel" class="tab-pane animated fadeIn" id="eth-stats">

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td>USD Price:</td>
                    <td>$ {{ $price }} USD</td>
                </tr>
                <tr>
                    <td>ETH Supply:</td>
                    <td>{{ $supply }} ETH</td>
                </tr>
                <tr>
                    <td>Difficulty:</td>
                    <td>{{ $difficulty }}</td>
                </tr>
                <tr>
                    <td>Gas Price:</td>
                    <td>{{ $gasPrice }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div role="tabpanel" class="tab-pane animated fadeIn" id="operation">

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td>Total:</td>
                    <td>$ {{ $total }} USD</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection