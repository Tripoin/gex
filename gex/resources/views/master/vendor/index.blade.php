@extends('layouts.app')

@section('title', 'Job Sheet')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h2 class="panel-title">Master - Vendor</h2>
                    </div>

                    <div class="panel-body">
                        @if(Auth::user()->role != 'admin2')
                            <a  href="#" class="btn btn-success btn-xs add-modal m-b-10" data-target="#createModal" data-toggle="modal" >
                                <i class="fa fa-plus" data-toggle="tooltip" title="Add User"></i> Tambah Vendor
                            </a>
                        @endif
                        @include('master.vendor.create')
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                                <thead>  
                                    <tr>  
                                        <th class="text-center" valign="middle">Code</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Address 1</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Zipcode</th>
                                        <th class="text-center">RC Type</th>
                                        <th class="text-center">Actions</th>
                                    </tr>  
                                </thead>  
                                <tbody>  
                                    @if(Auth::user()->role == 'marketing')
                                        @foreach($vendors->where('type','customer') as $vendor)
                                            <tr class="item{{$vendor->id}} ">
                                                <td class="text-center">{{$vendor->code}}</td>
                                                <td class="text-center">{{$vendor->name}}</td> 
                                                <td class="text-center">{{$vendor->city}}, {{$vendor->provice}}, {{$vendor->country}}</td>
                                                <td class="text-center">{{$vendor->phone1}}</td>
                                                <td class="text-center">{{$vendor->zipcode}}</td>
                                                <td class="text-center">{{ strtoupper($vendor->type) }}</td>
                                                <td class="text-center">
                                                    {!! Form::model($vendor, ['route' => ['master.vendor.destroy', $vendor->id], 'method' => 'delete', 'class' => ''] ) !!}
                                                        <button 
                                                           type="button" 
                                                           class="btn btn-success btn-xs" 
                                                           data-toggle="modal" 
                                                           data-target="#showModal{{ $vendor->id }}">
                                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                        </button>
                                                        @if(Auth::user()->role != 'admin2')
                                                            <button 
                                                               type="button" 
                                                               class="btn btn-warning btn-xs" 
                                                               data-toggle="modal" 
                                                               data-target="#editModal{{ $vendor->id }}">
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
 
                                            @include('master.vendor.show', [$vendor->id])
                                            @include('master.vendor.edit', [$vendor->id])

                                        @endforeach
                                    @elseif(Auth::user()->role == 'pelayaran')
                                        @foreach($vendors->where('type','pelayaran') as $vendor)
                                            <tr class="item{{$vendor->id}} ">
                                                <td class="text-center">{{$vendor->code}}</td>
                                                <td class="text-center">{{$vendor->name}}</td> 
                                                <td class="text-center">{{$vendor->city}}, {{$vendor->provice}}, {{$vendor->country}}</td>
                                                <td class="text-center">{{$vendor->phone1}}</td>
                                                <td class="text-center">{{$vendor->zipcode}}</td>
                                                <td class="text-center">{{ strtoupper($vendor->type) }}</td>
                                                <td class="text-center">
                                                    {!! Form::model($vendor, ['route' => ['master.vendor.destroy', $vendor->id], 'method' => 'delete', 'class' => ''] ) !!}
                                                        <button 
                                                           type="button" 
                                                           class="btn btn-success btn-xs" 
                                                           data-toggle="modal" 
                                                           data-target="#showModal{{ $vendor->id }}">
                                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                        </button>

                                                        <button 
                                                           type="button" 
                                                           class="btn btn-warning btn-xs" 
                                                           data-toggle="modal" 
                                                           data-target="#editModal{{ $vendor->id }}">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </button>
                                                    
                                                        <button 
                                                           type="submit" 
                                                           class="btn btn-danger btn-xs">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    {!! Form::close()!!}
                                                    
                                                </td>
                                            </tr>
 
                                            @include('master.vendor.show', [$vendor->id])
                                            @include('master.vendor.edit', [$vendor->id])

                                        @endforeach
                                    @elseif(Auth::user()->role == 'operation')
                                        @foreach($vendors->where('type','payable') as $vendor)
                                            <tr class="item{{$vendor->id}} ">
                                                <td class="text-center">{{$vendor->code}}</td>
                                                <td class="text-center">{{$vendor->name}}</td> 
                                                <td class="text-center">{{$vendor->city}}, {{$vendor->provice}}, {{$vendor->country}}</td>
                                                <td class="text-center">{{$vendor->phone1}}</td>
                                                <td class="text-center">{{$vendor->zipcode}}</td>
                                                <td class="text-center">{{ strtoupper($vendor->type) }}</td>
                                                <td class="text-center">
                                                    {!! Form::model($vendor, ['route' => ['master.vendor.destroy', $vendor->id], 'method' => 'delete', 'class' => ''] ) !!}
                                                        <button 
                                                           type="button" 
                                                           class="btn btn-success btn-xs" 
                                                           data-toggle="modal" 
                                                           data-target="#showModal{{ $vendor->id }}">
                                                            <span class="glyphicon glyphicon-eye-open"></span>
                                                        </button>

                                                        <button 
                                                           type="button" 
                                                           class="btn btn-warning btn-xs" 
                                                           data-toggle="modal" 
                                                           data-target="#editModal{{ $vendor->id }}">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                        </button>
                                                    
                                                        <button 
                                                           type="submit" 
                                                           class="btn btn-danger btn-xs">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </button>
                                                    {!! Form::close()!!}
                                                    
                                                </td>
                                            </tr>
 
                                            @include('master.vendor.show', [$vendor->id])
                                            @include('master.vendor.edit', [$vendor->id])

                                        @endforeach  
                                    @endif
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--@include('_master.vendor.show')
@include('_master.vendor.edit')--}}

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#myTables').dataTable();
        });
    </script>

    {{--@include('_master.vendor._script')--}}
@endsection