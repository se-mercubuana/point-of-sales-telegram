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
                    <form method="POST" class="form-horizontal" action="/transaction" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">
                            <h4 class="card-title">Create Transaction</h4>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Produk
                                </label>


                                <?php
                                $productAll = [];
                                foreach ($products as $product) {
                                    $getProduct = new \App\Product();
                                    $getProduct->id = $product->id;
                                    $getProduct->name = $product->name;
                                    $getProduct->modal = \App\Utility\PosUtility::returnPrice($product->modal, true);
                                    $getProduct->price_convert = \App\Utility\PosUtility::returnPrice($product->price, true);
                                    $getProduct->price = $product->price;
                                    $getProduct->is_active = $product->is_active;
                                    $getProduct->created_at = $product->created_at;
                                    $getProduct->updated_at = $product->updated_at;
                                    array_push($productAll, $getProduct);
                                }

                                ?>

                                <addproduct :products="{{json_encode($productAll)}}"></addproduct>

                            </div>

                            <div class="border-top" style="margin-bottom: 30px;">
                            </div>


                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Ongkir
                                </label>

                                <div class="col-sm-9">
                                    <input type="text" name="ongkir" class="form-control" id="fname"
                                           placeholder="Ongkir" onkeypress="return CheckNumeric();"
                                           onkeyup="FormatCurrency(this);" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Customer
                                </label>
                                <div class="col-sm-9">
                                    <select class="select2 form-control custom-select customer-select"
                                            onchange="customerSelect(this.value)"
                                            style="width: 100%; height:36px;" name="customer" required>
                                        <option value="">
                                            -
                                        </option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">
                                                ({{$customer->code}}){{$customer->name}} - {{$customer->no_telp}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div id="customerAddressShow"></div>
                            {{--<div class="form-group row"  style="display:none;">--}}
                                {{--<label for="fname" class="col-sm-3 text-right control-label col-form-label">--}}
                                    {{--Customer Address--}}
                                {{--</label>--}}
                                {{--<div class="col-sm-9">--}}
                                    {{--<select class="select2 form-control custom-select customer-select"--}}
                                            {{--onchange="customerSelect(this.value)"--}}
                                            {{--style="width: 100%; height:36px;" name="customer_address" required>--}}
                                        {{--<option value="">--}}
                                            {{-----}}
                                        {{--</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}


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

        // jQuery('.mydatepicker').datepicker();
        // jQuery('#datepicker-autoclose').datepicker({
        //     autoclose: true,
        //     todayHighlight: true
        // });
    </script>



    <script type="text/javascript">


        var customerId = '';
        // var url = 'https://admin-parfumislami.test/api';
        var url = 'http://127.0.0.1:8000/api';

        function customerSelect(id) {
            customerId = id;

            $.ajax({
                url: '/customer/address/' + customerId,
                type: "GET",
                data: {},
                success: function (data) {
                    $('#customerAddressShow').css('display', 'block');
                    $('#customerAddressShow').html(data);
                    // $('#category').val(category);
                }
            });

        //     axios.get(this.url + '/customer/address/' + customerId).then(response = > {
        //         var data = response.data;
        //
        //     // document.getElementById('customer-address-show').innerHTML = '';
        // })
        //     ;
        }


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


