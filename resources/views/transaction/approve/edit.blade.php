@extends('layouts.app')


@push('preScripts')

@endpush



@push('preStyles')

@endpush

@section('mainContent')

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">Detail Pembayar</h4>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-6 text-right control-label col-form-label">
                                Nomor Transaksi
                            </label>
                            <div class="col-sm-6">
                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">
                                    {{ $transaction->transaction_number }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-6 text-right control-label col-form-label">
                                Customer
                            </label>
                            <div class="col-sm-6">
                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">
                                    {{ $transaction->customer->name }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-6 text-right control-label col-form-label">
                                Total
                            </label>
                            <div class="col-sm-6">
                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">
                                    {{\App\Utility\PosUtility::returnPrice($transaction->total)}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-sm-6 text-right control-label col-form-label">
                                CS
                            </label>
                            <div class="col-sm-6">
                                <label for="fname" class="col-sm-12 text-left control-label col-form-label">
                                    {{ $transaction->user->name }}
                                </label>
                            </div>
                        </div>


                    </div>
                </div>


            </div>

            <div class="col-6">
                <div class="card">
                    <form method="POST" class="form-horizontal" action="/transaction/approve/{{$transaction->id}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('PUT')
                        <div class="card-body">
                            <h4 class="card-title">Konfirmasi Pembayaran</h4>


                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Transfer Date
                                </label>
                                <div class="col-sm-9 input-group">
                                    <input type="text" name="transfer_date" class="form-control" id="datepicker-autoclose"
                                           placeholder="">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Bank
                                </label>
                                <div class="col-sm-9">
                                    <select class="select2 form-control custom-select"
                                            style="width: 100%; height:36px;" name="bank" required>
                                        @foreach($banks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->name}}
                                                - {{$bank->no_rekening}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="border-top">
                            <div class="card-body text-right">
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            </div>
                        </div>
                    </form>
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


