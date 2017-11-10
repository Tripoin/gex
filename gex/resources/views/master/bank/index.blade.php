@extends('layouts.app')

@section('title', 'Job Sheet')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h2 class="panel-title">Master - Bank</h2>
                    </div>

                    <div class="panel-body">
                        @if(Auth::user()->role != 'admin2')
                            <a  href="#" class="btn btn-success btn-xs add-modal m-b-10" data-target="#createModal" data-toggle="modal" >
                                <i class="fa fa-plus" data-toggle="tooltip" title="Add User"></i> Tambah Bank
                            </a>
                        @endif

                        @include('master.bank.create')
                        
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
                                <thead>  
                                    <tr>  
                                        <th class="text-center" valign="middle">Name</th>
                                        <th class="text-center">Acccount</th>
                                        <th class="text-center">Cabang</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Actions</th>
                                    </tr>  
                                </thead>  
                                <tbody>  
                                    @foreach($banks as $bank)
                                        <tr class="item{{$bank->id}} ">
                                            <td class="text-center">{{$bank->name}}</td> 
                                            <td class="text-center">{{$bank->account}}</td>
                                            <td class="text-center">{{$bank->cabang}}</td>
                                            <td class="text-center">{{$bank->address}}</td>
                                            <td class="text-center">
                                                {!! Form::model($bank, ['route' => ['master.bank.destroy', $bank->id], 'method' => 'delete', 'class' => ''] ) !!}
                                                    <button 
                                                       type="button" 
                                                       class="btn btn-success btn-xs" 
                                                       data-toggle="modal" 
                                                       data-target="#showModal{{ $bank->id }}">
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </button>

                                                    @if(Auth::user()->role != 'admin2')
                                                        <button 
                                                           type="button" 
                                                           class="btn btn-warning btn-xs" 
                                                           data-toggle="modal" 
                                                           data-target="#editModal{{ $bank->id }}">
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

                                       
                                        @include('master.bank.show', [$bank->id])
                                        @include('master.bank.edit', [$bank->id])

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

{{--@include('_master.bank.show')
@include('_master.bank.edit')--}}

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#myTables').dataTable();
        });
    </script>

    {{--@include('_master.bank._script')--}}
@endsection