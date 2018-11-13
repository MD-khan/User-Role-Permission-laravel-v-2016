@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">  
                 <a href="/users/create" class="pull-right"> Add  New User </a>
                <h3 class="panel-title"> Users </h3>
                </div>
                <div class="panel-body">
                <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role </th>
                    <th>Action </th>
                  </tr>
                </thead>

                    <tbody>
                    @foreach ( $users as $user )
                      <tr>
                            <td> <a href="/users/{{$user->id}}/show"> {{ $user->name }} </a> </td>
                            <td> {{ $user->email }} </td>
                            <td> 
                                    @if(!empty($user->roles))
                                            @foreach($user->roles as $v)
                                        <label class="label label-success">{{ $v->display_name }}</label>
                                        @endforeach
                              @endif
                            </td>
                            <td> 
                                <a href="/users/{{ $user->id}}/edit">  Edit </a>
                             | Block 
                            </td>
                      </tr>
                      @endforeach
                    </tbody>
  </table>
                    {{ $users->links() }}
                        
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
