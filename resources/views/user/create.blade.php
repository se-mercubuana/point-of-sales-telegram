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
                    <form method="POST" class="form-horizontal" action="/user" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">
                            <h4 class="card-title">Create User</h4>


                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Nama
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="fname"
                                           placeholder="Nama" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Username
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" id="fname"
                                           placeholder="Username" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Role
                                </label>
                                <div class="col-sm-9">
                                    <select class="select2 form-control custom-select"
                                            style="width: 100%; height:36px;" name="role" required>
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


