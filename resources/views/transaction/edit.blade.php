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
                        <h4 class="card-title">Detail Pembelian</h4>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-5 text-right control-label col-form-label">
                                Nomor Transaksi
                            </label>
                            <div class="col-sm-7">
                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">
                                    <b>{{ $transaction->transaction_number }}</b>
                                </label>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="fname" class="col-sm-5 text-right control-label col-form-label">
                                Customer
                            </label>
                            <div class="col-sm-7">
                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">
                                    ({{ $transaction->customer->code }}){{ $transaction->customer->name }}
                                    - {{ $transaction->customer->no_telp }}
                                    <br>
                                    {{ $transaction->customer->alamat }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-5 text-right control-label col-form-label">
                                Alamat
                            </label>
                            <div class="col-sm-7">
                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">
                                    {{ $transaction->transaction_address->full_name }} - {{ $transaction->transaction_address->city }}, {{ $transaction->transaction_address->address }}
                                    <br>
                                    {{\App\Utility\PosUtility::returnPrice($transaction->ongkir)}} <span style="font-size: 10px;">ongkir</span>
                                </label>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="fname" class="col-sm-5 text-right control-label col-form-label">
                                Tanggal Dibuat Transaksi
                            </label>
                            <div class="col-sm-7">
                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">
                                    {{ \App\Utility\PosUtility::returnIndoDate($transaction->created_at, true)  }}
                                    <span style="font-size: 10px;">
                                        ({{ \Carbon\Carbon::createFromTimeStamp(strtotime($transaction->created_at))->diffForHumans() }}
                                        )
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-5 text-right control-label col-form-label">
                                Produk
                            </label>
                            <div class="col-sm-7">
                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">
                                    @foreach($products as $product)
                                        {{$product->product_log->name}}
                                        ({{\App\Utility\PosUtility::returnPrice($product->product_log->price)}}
                                        ) - {{$product->quantity}}<span style="font-size:11px;">pcs</span>
                                        <br>
                                    @endforeach
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-5 text-right control-label col-form-label">
                                Total
                            </label>
                            <div class="col-sm-7">
                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">
                                    {{\App\Utility\PosUtility::returnPrice($transaction->total)}}
                                </label>
                            </div>
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



    <script type="text/javascript">


        function FormatCurrency(ctrl) {
            //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
            if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
                return;
            }

            var val = ctrl.value;

            val = val.replace(/,/g, "");
            ctrl.value = "";
            val += '';
            x = val.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';

            var rgx = /(\d+)(\d{3})/;

            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }

            ctrl.value = x1 + x2;
        }

        function CheckNumeric() {
            return event.keyCode >= 48 && event.keyCode <= 57;
        }


    </script>
@endpush


