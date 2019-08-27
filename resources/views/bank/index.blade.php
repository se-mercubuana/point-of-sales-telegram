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
                        <h5 class="card-title"> Bank
                            <span style="float:right;">
                                <a href="/bank/create" class="btn btn-linkedin" style="margin-bottom: 10px;">Tambah</a>
                            </span>
                        </h5>


                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Bank Name</th>
                                    <th>No Rekening</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banks as $bank)
                                    <tr>
                                        <td>{{$bank->name}}</td>
                                        <td>{{$bank->no_rekening}}</td>
                                        <td>
                                            <a href="/bank/{{$bank->id}}/edit" class="btn btn-warning">Edit</a>
                                            <form method="POST" class="form-horizontal" action="/bank/{{$bank->id}}"
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


