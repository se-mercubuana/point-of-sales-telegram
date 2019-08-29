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
                    <form method="POST" class="form-horizontal" action="/customer/{{$customer->id}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('PUT')
                        <div class="card-body">
                            <h4 class="card-title">Edit Customer</h4>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Nama Customer
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{$customer->name}}" class="form-control"
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


            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> Alamat Customer
                            <span style="float:right;">
                                <a href="/customer/address/{{$customer->id}}/create" class="btn btn-linkedin"
                                   style="margin-bottom: 10px;">Tambah</a>
                            </span>
                        </h5>


                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Atas Nama</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer_address as $address)
                                    <tr>
                                        <td>{{$address->full_name}}</td>
                                        <td>{{$address->address}}</td>
                                        <td>{{$address->city}}</td>
                                        <td>
                                            <a href="/customer/address/{{$address->id}}/edit" class="btn btn-warning">Edit</a>
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


