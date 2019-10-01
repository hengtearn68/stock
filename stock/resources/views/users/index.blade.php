@extends('layouts.master')
@section('header')
    <strong>Users</strong>
@endsection

@section('content')

    <div class="card card-gray">
        <div class="toolbox">
            <a href="{{url('user/create')}}" class="btn btn-primary btn-sm btn-oval">
                <i class="fa fa-plus-circle"></i>Create
            </a>
        </div>
        <div class="card-block">

            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>
                    {{session('success')}}
                </p>    
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
            @endif

            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>
                   

                        <?php

                            $page=@$_GET['page'];
                            if($page)
                            {
                                $page=1;
                            }
                            $i=config('app.row')*($page-1)+1;
                        ?>
                        @foreach($users as $u)
                        <tr>

                            <td>{{$i++}}</td>
                            <td>{{$u->name}}</td>
                            <td>{{$u->username}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->rname}}</td>
                            <td class="action">
                                <a href="{{url('user/delete/'.$u->id)}}" class="text-danger" title='Delete'
                                onclick="return confirm('You want to delete?')">
                                    <i class="fa fa-trash"></i>
                                </a>&nbsp;
                                <a href="{{url('user/edit/'.$u->id)}}" class="text-success" title='Edit'>
                                
                                    <i class="fa fa-edit"></i>
                                </a>

                            </td>
                        </tr>

                        @endforeach
                    

                </tbody>
                
            </table>
            {{$users->links()}}
        </div>
    </div>
@endsection

@section('js')

                            <script>
                            
                                $(document).ready(function()){


                                    $("#sidebar-menu").removeClass('active open');
                                    $("#sidebar-menu li ul li").removeClass('active');
                                    $("#menu_security").addClass('active open');
                                    $("#security_collapse").addClass('collapse in')
                                    $("#menu_user").addClass('collapse')



                                }
                            </script>


@endsection