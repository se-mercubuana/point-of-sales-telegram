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
                    <form method="POST" class="form-horizontal" action="/bank/{{$bank->id}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        @method('PUT')
                        <div class="card-body">
                            <h4 class="card-title">Create Bank</h4>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    Nama Bank
                                </label>

                                <div class="col-sm-9">
                                    <select class="select2 form-control custom-select"
                                            style="width: 100%; height:36px;" name="name" required>

                                        <option value="{{$bank->name}}">{{$bank->name}}</option>
                                        @foreach($listBanks as $listBank)
                                            <option value="{{$listBank->name}}">{{$listBank->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">
                                    No Rekening
                                </label>
                                <div class="col-sm-9">
                                    <input type="number" name="no_rekening" class="form-control" id="fname"
                                           placeholder="Nomor Rekening" value="{{$bank->no_rekening}}" required>
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


