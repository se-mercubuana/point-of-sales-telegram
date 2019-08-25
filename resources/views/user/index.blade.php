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
                        <h5 class="card-title"> User
                            <span style="float:right;">
                                <a href="/user/create" class="btn btn-linkedin" style="margin-bottom: 10px;">Tambah</a>
                            </span>
                        </h5>


                        <div class="table-responsive">

                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->role->name}}</td>
                                        <td>
                                            <a href="/user/{{$user->id}}/edit" class="btn btn-warning">Edit</a>
                                            <form method="POST" class="form-horizontal" style="display: inline-block;"
                                                  action="/user/{{$user->id}}">
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


