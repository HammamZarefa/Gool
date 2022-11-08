@extends('admin.layout.master')
@section('import-css')
@stop
@section('content')

    <div class="page-header">
        <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                  <i class="mdi mdi-account-multiple-outline"></i>
              </span> {{$page_title}} </h3>
    </div>
    <div class="row">
{{--        @include('admin.users.user-sidebar')--}}
        <div class="col-md-9 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">
                        New Profile Settings
                    </h4>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form class="forms-sample" role="form" action="{{route('user.store')}}"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="first_name" value=""
                                               class="form-control" id="first_name" placeholder="First Name">
                                        @if ($errors->has('first_name'))
                                            <p class="text-danger">{{ $errors->first('first_name') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="last_name" value=""
                                               class="form-control" id="last_name" placeholder="Last Name">
                                        @if ($errors->has('last_name'))
                                            <p class="text-danger">{{ $errors->first('last_name') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="username" value=""
                                               class="form-control" id="username" placeholder="Username">
                                        @if ($errors->has('username'))
                                            <p class="text-danger">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" value="" class="form-control"
                                               id="email" placeholder="Email Address">
                                        @if ($errors->has('email'))
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
                                        @if ($errors->has('new_password'))
                                            <p class="text-danger">{{ $errors->first('new_password') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                                        @if ($errors->has('password_confirmation'))
                                            <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="balance" class="col-sm-3 col-form-label">Balance</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="balance" class="form-control" value="{{old('balance')}}" id="balance" placeholder="Balance">
                                        @if ($errors->has('balance'))
                                            <p class="text-danger">{{ $errors->first('balance') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-3 col-form-label">Mobile Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" value="" class="form-control"
                                               id="mobile" placeholder="Mobile number">
                                        @if ($errors->has('phone'))
                                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" value=""
                                               class="form-control" id="address" placeholder="Address">
                                        @if ($errors->has('address'))
                                            <p class="text-danger">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="city" class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="city" value="" class="form-control"
                                               id="city" placeholder="City">
                                        @if ($errors->has('city'))
                                            <p class="text-danger">{{ $errors->first('city') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zip_code" class="col-sm-3 col-form-label">Zip</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="zip_code" value=""
                                               class="form-control" id="zip_code" placeholder="Zip code">
                                        @if ($errors->has('zip_code'))
                                            <p class="text-danger">{{ $errors->first('zip_code') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zip_code" class="col-sm-3 col-form-label">Country</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="country" value=""
                                               class="form-control" id="country" placeholder="Country">
                                        @if ($errors->has('country'))
                                            <p class="text-danger">{{ $errors->first('country') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Can add users</label>
                                    <div class="col-sm-9">
                                        <select name="is_admin" id="is_admin" class="form-control">
                                            <option selected disabled>choose one</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <p class="text-danger">{{ $errors->first('is_admin') }}</p>
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


