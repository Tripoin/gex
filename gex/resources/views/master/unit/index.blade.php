@extends('layouts.app')

@section('title', 'Job Sheet')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h2 class="panel-title">Master - Unit</h2>
                    </div>

                    <div class="panel-body">
                        @if(Auth::user()->role != 'admin2')
                            <a  href="#" class="btn btn-success btn-xs add-modal m-b-10" data-target="#createModal" data-toggle="modal" >
                                <i class="fa fa-plus" data-toggle="tooltip" title="Add User"></i> Tambah Unit
                            </a>
                        @endif
                        @include('master.unit.create')
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                                <thead>  
                                    <tr>  
                                        <th class="text-center" valign="middle">Name</th>
                                        <th class="text-center">Display Name</th>
                                        <th class="text-center">Actions</th>
                                    </tr>  
                                </thead>  
                                <tbody>  
                                    @foreach($units as $unit)
                                        <tr class="item{{$unit->id}} ">
                                            <td class="text-center">{{$unit->name}}</td> 
                                            <td class="text-center">{{$unit->display_name}}</td>
                                            <td class="text-center">
                                                {!! Form::model($unit, ['route' => ['master.unit.destroy', $unit->id], 'method' => 'delete', 'class' => ''] ) !!}
                                                    
                                                    @if(Auth::user()->role != 'admin2')
                                                        <button 
                                                           type="button" 
                                                           class="btn btn-warning btn-xs" 
                                                           data-toggle="modal" 
                                                           data-target="#editModal{{ $unit->id }}">
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

                                        @include('master.unit.edit', [$unit->id])

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

{{--@include('_master.unit.show')
@include('_master.unit.edit')--}}

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#myTables').dataTable();
        });
    </script>

    {{--@include('_master.unit._script')--}}
@endsection