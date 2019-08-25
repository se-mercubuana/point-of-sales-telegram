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
                        <h5 class="card-title"> Transaction
                            <span style="float:right;">
                                <a href="/transaction/create" class="btn btn-linkedin"
                                   style="margin-bottom: 10px;">Tambah</a>
                            </span>
                        </h5>


                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No Transaksi</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->transaction_number}}</td>
                                        <td>({{$transaction->customer->code}}){{$transaction->customer->name}} - {{$transaction->customer->no_telp}}</td>
                                        <td>{{\App\Utility\PosUtility::returnPrice($transaction->total)}}</td>
                                        <td>{{ \App\Utility\PosUtility::returnIndoDate($transaction->created_at, true)  }}</td>

                                        <td>
                                            <a href="/transaction/{{$transaction->id}}/edit" class="btn btn-warning">Detail</a>
                                            {{--<form method="POST" class="form-horizontal" action="/transaction/{{$transaction->id}}"--}}
                                            {{--style="display: inline-block;">--}}
                                            {{--{{csrf_field()}}--}}
                                            {{--@method('DELETE')--}}
                                            {{--<button type="submit" class="btn btn-danger">Delete</button>--}}
                                            {{--</form>--}}
                                        </td>
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


