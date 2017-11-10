@extends('report.pdf-layout')

@section('title', $data['title'])

@section('content')

    <?php
    $jobsheets = $data['jobsheets'];
    $headers = $jobsheets ? array_first($jobsheets) : [];
    if( $headers ){
        $headers = array_keys($headers);
    }
    ?>

    <table class="table table-bordered table-body-condensed table-striped table-hover" id="myTables">
        <thead>
        <tr>
            @foreach($headers as $header)
                <th>{!! $header !!}</th>
            @endforeach
        </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
        @if( $jobsheets )
            @foreach($jobsheets as $jobsheet)
                 <tr>
                     @foreach($jobsheet as $key => $job)
                         <td>{!! $job !!}</td>
                     @endforeach
                </tr>
                <?php $no++; ?>
            @endforeach
        @else
            <tr>
                <td colspan="{!! count($headers) !!}">Data not found</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection