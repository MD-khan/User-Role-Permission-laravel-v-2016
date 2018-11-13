@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <span> <a href="/roles/" class="pull-right"> Back </a></span> 
                   <h3 class="panel-title"> Edit User </h3>
                    </div>

                <div class="panel-body">
                @include('errors/input_errors')
                @include('partials/success')
                   
                    <form class="form-horizontal" role="form" method="POST" action="/users/{{$user->id}}/update">
                     {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                       

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4"> 
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h3 class="panel-title"> Edit Role(s) </h3>
                    </div>

                <div class="panel-body">
                    <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                           <div class="checkbox">
                                @foreach ( $roles as $role )
                                        <label>
                                        <input type="checkbox" 
                                                    value=" {{ $role->id}}" 
                                                    name="roles[]" 
                                                    @if($user->hasRole($role->name)) checked="" @endif >
                                                    {{ $role->display_name }}
                                        </label>
                                                                                        
                                @endforeach
                                                </div>
                        <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                </div>
                </form>
        </div>
    </div>

</div>
@endsection
