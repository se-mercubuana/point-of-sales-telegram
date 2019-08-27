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
                    <form method="POST" class="form-horizontal" action="/customer" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">
                            <h4 class="card-title">Create Customer</h4>


                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Kode
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="code" class="form-control" id="fname"
                                           placeholder="Kode Customer" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Nama Customer
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="fname"
                                           placeholder="Nama Customer" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    No Telp
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_telp" class="form-control" id="fname"
                                           placeholder="No Telp" required>
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


