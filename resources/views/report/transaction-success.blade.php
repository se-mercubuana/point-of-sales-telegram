@extends('layouts.app')


@push('preScripts')

@endpush



@push('preStyles')

@endpush


@section('mainContent')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> Transaction </h5>

                        <a href="/report/transaction-success/export" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>


                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No Transaksi</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>CS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->transaction_number}}</td>
                                        <td>{{$transaction->customer->name}}</td>
                                        <td>{{\App\Utility\PosUtility::returnPrice($transaction->total)}}</td>
                                        <td>{{$transaction->user->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@push('postScripts')


    <script type="text/javascript">
    </script>

@endpush


