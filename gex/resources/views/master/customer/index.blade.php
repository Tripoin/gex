@extends('layouts.app')

@section('title', 'Job Sheet')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h2 class="panel-title">Master - Customer</h2>
                    </div>

                    <div class="panel-body">
                        @if(Auth::user()->role != 'admin2')
                            <a  href="#" class="btn btn-success btn-xs add-modal m-b-10" data-target="#createModal" data-toggle="modal" >
                                <i class="fa fa-plus" data-toggle="tooltip" title="Add User"></i> Tambah Customer
                            </a>
                        @endif
                        @include('master.customer.create')
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
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Action</th>
                                    </tr>  
                                </thead>  
                                <tbody>  
                                    @foreach($customers as $customer)
                                        <tr class="item{{$customer->id}} ">
                                            <td class="text-center">{{$customer->code}}</td>
                                            <td class="text-center">{{$customer->name}}</td> 
                                            <td class="text-center">{{$customer->city}}, {{$customer->provice}}, {{$customer->country}}</td>
                                            <td class="text-center">{{$customer->phone1}}</td>
                                            <td class="text-center">{{$customer->zipcode}}</td>
                                            <td class="text-center">{{ strtoupper($customer->type) }}</td>
                                            <td class="text-center">
                                                {!! Form::model($customer, ['route' => ['master.customer.destroy', $customer->id], 'method' => 'delete', 'class' => ''] ) !!}
                                                    <button 
                                                       type="button" 
                                                       class="btn btn-success btn-xs" 
                                                       data-toggle="modal" 
                                                       data-target="#showModal{{ $customer->id }}">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </button>

                                                    @if(Auth::user()->role != 'admin2')
                                                        <button 
                                                           type="button" 
                                                           class="btn btn-warning btn-xs" 
                                                           data-toggle="modal" 
                                                           data-target="#editModal{{ $customer->id }}">
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

                                        @include('master.customer.show', [$customer->id])
                                        @include('master.customer.edit', [$customer->id])

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

{{--@include('_master.customer.show')
@include('_master.customer.edit')--}}

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#myTables').dataTable();
        });
    </script>

    {{--@include('_master.customer._script')--}}
@endsection