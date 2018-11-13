@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Role details </div>

                <div class="panel-body">
                    <h3>  Name: {{  $role->display_name  }} </h3>
                        <label> Description </label>
                        <p> {{ $role->description }} </p>
                        <label> Permissions </label>
                        @foreach ( $permissions as $permission )
                            <li> {{ $permission->display_name }} </li>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
