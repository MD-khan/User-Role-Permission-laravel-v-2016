@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Roles 
                   <span> <a href="/roles/" class="pull-right"> Back </a></span> 
                    </div>

                <div class="panel-body">
                @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
                    <form action="/roles/{{$role->id}}/update/" method="POST"> 
                    {{ csrf_field() }}
                    <div class="row"> 
                            <div class="col-md-7"> 
                                <h3> Edit Role </h3>
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Dispaly Name:</label>
                                        <input type="text" class="form-control" id="display_name" name="display_name" 
                                            value="{{ $role->display_name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="Description:">Description:</label>
                                        <textarea class="form-control" name="description"> {{$role->description}}</textarea>
                                       
                                    </div>
                               
                            </div>

                            <div class="col-md-5"> 
                                    <h3> Give Permission(s)</h3>
                                        @if( $permissions->count() )
                                            @foreach ( $permissions as $permission )
                                                <div class="checkbox">
                                                    <label>
                                                    <input type="checkbox" value=" {{ $permission->id}}" name="permission[]"  checked="checked">

                                                             {{ $permission->display_name }}
                                                    
                                                            
                                                     </label>
                                                </div>
                                            @endforeach
                   
                    @else 
                    <p> No Permissions found </p>
                 @endif
                            </div>
                                      
                    </div>
                    <div class="form-group"> 
                    <button class="btn btn-block btn-primary"> Submit </button>
                    </div>
      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
