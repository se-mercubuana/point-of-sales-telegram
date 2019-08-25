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
                        <h5 class="card-title"> Product
                            <span style="float:right;">
                                <a href="/product/create" class="btn btn-linkedin"
                                   style="margin-bottom: 10px;">Tambah</a>
                            </span>
                        </h5>


                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Modal</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{\App\Utility\PosUtility::returnPrice($product->price)}}</td>
                                        <td>{{\App\Utility\PosUtility::returnPrice($product->modal)}}</td>
                                        <td>
                                            <a href="/product/{{$product->id}}/edit" class="btn btn-warning">Edit</a>
                                            <form method="POST" class="form-horizontal"
                                                  action="/product/{{$product->id}}"
                                                  style="display: inline-block;">
                                                {{csrf_field()}}
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
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


