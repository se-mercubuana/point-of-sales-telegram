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
                    <form method="POST" class="form-horizontal" action="/customer/address/{{$customer_id}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">
                            <h4 class="card-title">Create Alamat Customer</h4>


                            <input type="hidden" name="customer_id"
                                   class="form-control"
                                   id="fname" value="{{$customer_id}}">

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Atas Nama
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_name"
                                           class="form-control"
                                           id="fname"
                                           placeholder="Atas Nama" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Alamat
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="address"
                                           class="form-control"
                                           id="fname"
                                           placeholder="Alamat" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Kota
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="city"
                                           class="form-control"
                                           id="fname"
                                           placeholder="Kota" required>
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


