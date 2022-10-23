@extends('user')
@section('import-css')
@stop
@section('content')

    <div class="row">

        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">
                       New User
                    </h4>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form class="forms-sample" role="form" action="{{route('user.users.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="first_name" value="" class="form-control"
                                               id="first_name" placeholder="First Name">
                                        @if ($errors->has('first_name'))
                                            <p class="text-danger">{{ $errors->first('first_name') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="last_name" value="" class="form-control" id="last_name"
                                               placeholder="Last Name">
                                        @if ($errors->has('last_name'))
                                            <p class="text-danger"></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="username" value="" class="form-control" id="username"
                                               placeholder="Username">
                                        @if ($errors->has('username'))
                                            <p class="text-danger"></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="password" value="" class="form-control" id="username"
                                               placeholder="password">
                                        @if ($errors->has('password'))
                                            <p class="text-danger"></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Balance</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="balance" value="0" class="form-control" id="balance"
                                               placeholder="balance">
                                        @if ($errors->has('balance'))
                                            <p class="text-danger"></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" value="" class="form-control" id="email"
                                               placeholder="Email Address">
                                        @if ($errors->has('email'))
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-3 col-form-label">Mobile Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" value="" class="form-control" id="mobile"
                                               placeholder="Mobile number">
                                        @if ($errors->has('phone'))
                                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1"  selected>Active</option>
                                            <option value="0" >Blocked</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <p class="text-danger">{{ $errors->first('status') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-gradient-success btn-block">Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


