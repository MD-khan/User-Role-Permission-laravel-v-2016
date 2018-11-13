@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Roles 
                   <span> <a href="/roles/create" class="pull-right"> Create New Role </a></span> 
                    </div>

                <div class="panel-body">
                    @include('partials/success')
                    @include('errors/input_errors')
                    @if( $roles->count() )
                     <ul class="list-group"> 
                            @foreach ( $roles as $role )
                                    <li class="list-group-item">  
                                        <a href="/roles/{{ $role->id }}"> {{ $role->name }}  </a> 
                                        <form class="pull-right" method="POST" action="/roles/{{ $role->id }}/destroy">
                                        {{ csrf_field( )}}
                                     <input name="_method" type="hidden" value="DELETE">
                                     <input class="btn btn-danger" type="submit" value="Delete">
                                            
                                        </form>
                                            
                                             <a href="/roles/{{ $role->id }}/edit" class="btn btn-primary pull-right">  Edit </a> 

                                    </li>
                            @endforeach
                            </ul>
                        
                          
                        
                   
                    @else 
                    <p> No roles found </p>
                 @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
