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
                    <form method="POST" class="form-horizontal" action="/user/{{$user->id}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('PUT')
                        <div class="card-body">
                            <h4 class="card-title">Edit User</h4>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    {{--Reset Password--}}
                                </label>
                                <div class="col-sm-9">
                                    <a href="/user/{{$user->id}}/reset-password" class="btn btn-danger">Reset
                                        Password
                                    </a>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Nama
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="fname"
                                           placeholder="Nama" value="{{$user->name}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Username
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" id="fname"
                                           placeholder="Username" value="{{$user->username}}" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Role
                                </label>
                                <div class="col-sm-9">
                                    <select class="select2 form-control custom-select"
                                            style="width: 100%; height:36px;" name="role" required>
                                        <option value="{{$user->role_id}}">{{$user->role->name}}</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
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


