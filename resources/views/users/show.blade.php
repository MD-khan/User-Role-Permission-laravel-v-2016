@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Details details </div>

                <div class="panel-body">
                    <h3>  Name: {{  $user->name  }} </h3>
                    <label class=""> Roles </label>
                        @foreach ( $user->roles as $role )
                            <li> {{ $role->display_name }} </li>
                        @endforeach
                <label> Created at: {{ $user->created_at->diffForHumans() }}</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
