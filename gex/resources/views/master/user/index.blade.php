@extends('layouts.app')

@section('title', 'Job Sheet')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h2 class="panel-title">Master - User</h2>
                    </div>

                    <div class="panel-body">
                        @if(Auth::user()->role != 'admin2')
                            <a  href="#" class="btn btn-success btn-xs add-modal m-b-10" data-target="#createModal" data-toggle="modal" >
                                <i class="fa fa-plus" data-toggle="tooltip" title="Add User"></i> Tambah User
                            </a>
                        @endif
                        @include('master.user.create')
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                                <thead>  
                                    <tr>  
                                        <th class="text-center" valign="middle">Code</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Alamat 1</th>
                                        <th class="text-center">Actions</th>
                                    </tr>  
                                </thead>  
                                <tbody>  
                                    @foreach($users as $user)
                                        <tr class="item{{$user->id}} ">
                                            <td class="text-center">{{$user->code}}</td>
                                            <td class="text-center">{{$user->name}}</td> 
                                            <td class="text-center">{{$user->role}}</td>
                                            <td class="text-center">{{$user->phone1}}</td>
                                            <td class="text-center">{{$user->address1}}</td>
                                            <td class="text-center">
                                                {!! Form::model($user, ['route' => ['master.user.destroy', $user->id], 'method' => 'delete', 'class' => ''] ) !!}
                                                    <button 
                                                       type="button" 
                                                       class="btn btn-success btn-xs" 
                                                       data-toggle="modal" 
                                                       data-target="#showModal{{ $user->id }}">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </button>

                                                    @if(Auth::user()->role != 'admin2')
                                                        <button 
                                                           type="button" 
                                                           class="btn btn-warning btn-xs" 
                                                           data-toggle="modal" 
                                                           data-target="#editModal{{ $user->id }}">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </button>
                                                    
                                                        <button 
                                                           type="submit" 
                                                           class="btn btn-danger btn-xs">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    @endif
                                                {!! Form::close()!!}
                                                
                                            </td>
                                        </tr>

                                       
                                        @include('master.user.show', [$user->id])
                                        @include('master.user.edit', [$user->id])

                                    @endforeach  
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--@include('_master.user.show')
@include('_master.user.edit')--}}

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#myTables').dataTable();
        });
    </script>

    {{--@include('_master.user._script')--}}
@endsection