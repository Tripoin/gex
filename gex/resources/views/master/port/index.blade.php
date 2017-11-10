@extends('layouts.app')

@section('title', 'Job Sheet')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h2 class="panel-title">Master - Port</h2>
                    </div>

                    <div class="panel-body">
                        @if(Auth::user()->role != 'admin2')
                            <a  href="#" class="btn btn-success btn-xs add-modal m-b-10" data-target="#createModal" data-toggle="modal" >
                                <i class="fa fa-plus" data-toggle="tooltip" title="Add User"></i> Tambah Port
                            </a>
                        @endif
                        @include('master.port.create')
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                                <thead>  
                                    <tr>  
                                        <th class="text-center" valign="middle">Code</th>
                                        <th class="text-center">Nickname</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Loading</th>
                                        <th class="text-center">Actions</th>
                                    </tr>  
                                </thead>  
                                <tbody>  
                                    @foreach($ports as $port)
                                        <tr class="item{{$port->id}} ">
                                            <td class="text-center">{{$port->code}}</td>
                                            <td class="text-center">{{$port->nick_name}}</td> 
                                            <td class="text-center">{{$port->address}}, {{$port->city}}, {{$port->provice}}, {{$port->country}}</td>
                                            <td class="text-center">{{$port->type}}</td>
                                            <td class="text-center">{{$port->loading}}</td>
                                            <td class="text-center">
                                                {!! Form::model($port, ['route' => ['master.port.destroy', $port->id], 'method' => 'delete', 'class' => ''] ) !!}
                                                    <button 
                                                       type="button" 
                                                       class="btn btn-success btn-xs" 
                                                       data-toggle="modal" 
                                                       data-target="#showModal{{ $port->id }}">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </button>

                                                    @if(Auth::user()->role != 'admin2')
                                                        <button 
                                                           type="button" 
                                                           class="btn btn-warning btn-xs" 
                                                           data-toggle="modal" 
                                                           data-target="#editModal{{ $port->id }}">
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

                                       
                                        @include('master.port.show', [$port->id])
                                        @include('master.port.edit', [$port->id])

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

{{--@include('_master.port.show')
@include('_master.port.edit')--}}

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#myTables').dataTable();
        });
    </script>

    {{--@include('_master.port._script')--}}
@endsection