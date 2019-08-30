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
                    <form method="POST" class="form-horizontal" action="/customer/address/{{$customer_address->id}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('PUT')
                        <div class="card-body">
                            <h4 class="card-title">Edit Alamat Customer</h4>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Atas Nama
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_name" value="{{$customer_address->full_name}}"
                                           class="form-control"
                                           id="fname"
                                           placeholder="Nama Customer" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Alamat
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" value="{{$customer_address->address}}"
                                           class="form-control"
                                           id="fname"
                                           placeholder="Nama Customer" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Kota
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="city" value="{{$customer_address->city}}"
                                           class="form-control"
                                           id="fname"
                                           placeholder="Nama Customer" required>
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

@endpush


