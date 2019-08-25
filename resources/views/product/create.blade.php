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
                    <form method="POST" class="form-horizontal" action="/product" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">
                            <h4 class="card-title">Create Produk</h4>


                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Nama Produk
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="fname"
                                           placeholder="Nama Produk" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Modal
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Modal" name="modal"
                                           onkeypress="return CheckNumeric();" onkeyup="FormatCurrency(this);" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Harga Jual
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Harga Jual" name="price"
                                           onkeypress="return CheckNumeric();" onkeyup="FormatCurrency(this);" required>
                                </div>
                            </div>


                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Submit</button>
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

            val = val.replace(/,/g, "")
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


