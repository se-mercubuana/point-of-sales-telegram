@extends('layouts.app')


@push('preScripts')

@endpush



@push('preStyles')

@endpush


@section('mainContent')


    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-b-20">
                        {{--<span class="db"><img src="../../assets/images/logo.png" alt="logo" /></span>--}}
                        <div style="font-size: 20px;color: white;">ParfumIslami.com</div>
                    </div>

                    <form class="form-horizontal m-t-20" id="loginform" method="POST" action="{{ route('login') }}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i
                                                    class="ti-user"></i></span>
                                    </div>
                                    <input type="text" name="username" class="form-control form-control-lg"
                                           placeholder="Username"
                                           aria-label="Username" aria-describedby="basic-addon1" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i
                                                    class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-lg"
                                           placeholder="Password"
                                           aria-label="Password" aria-describedby="basic-addon1" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        {{--<button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Lost password?</button>--}}
                                        <button class="btn btn-success float-right" type="submit">Login</button>
                                    </div>
                                </div>
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


