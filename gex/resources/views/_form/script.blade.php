<script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}" charset="UTF-8"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}"></script>
<script src="{{asset('vendor/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{ asset('vendor/cleave.js/cleave.min.js') }}"></script>

    <script>
    $(document).ready(function() { $("#customers").select2(); });
    $(document).ready(function() { $("#poo").select2(); });
    $(document).ready(function() { $("#pod").select2(); });
    $(document).ready(function() { $("#marketing").select2(); });
    $(document).ready(function() { $("#unit_charge").select2(); });
    $(document).ready(function() { $("#unit_charge1").select2(); });
    $(document).ready(function() { $("#unit_charge2").select2(); });
    $(document).ready(function() { $("#vendor").select2(); });
    $(document).ready(function() { $("#unit").select2(); });
    $(document).ready(function() { $("#unit1").select2(); });
    $(document).ready(function() { $("#unit2").select2(); });
    $(document).ready(function() { $("#top").select2(); });
    $(document).ready(function() { $("#top1").select2(); });
    </script>

<script>
var option_doc;
var option_unit;
var option_party;
var term;
var tax = 0;
var qty = 0.0;
var currency;
var ammount = 0;
var subtotal = 0;
var total_idr = 0;
var total_usd = 0;
var rmb_qty = 0.0;
var rmb_currency;
var rmb_ammount = 0;
var rmb_subtotal = 0;
var rmb_total_idr = 0;
var rmb_total_usd = 0;
var rc_qty = 0.0;
var rc_currency;
var rc_ammount = 0;
var rc_subtotal = 0;
var rc_total_idr = 0;
var rc_total_usd = 0;
var index_term = 1;
var index_charges = 0;
var rmb_index_term = 1;
var rmb_index_charges = 0;

$(function(){
    'use strict';

    //add new doc
    $('.add-doc').click(function(){
        var elem = `<div class="form-group">
            <div class="col-sm-4 form-group-body">

                {!! Form::hidden('reference_id[]', 0) !!}

                <div class="input-group">
                    {!! Form::select(
                        'ref_document_id[]', 
                        [''=>'']+App\MasterDocument::where('type', null)->pluck('name','id')->all(),
                        '', 
                        ['class'=>'form-control input-sm options_doc','id'=>'document_id','required']) 
                    !!}
                    <span class="input-group-btn"><button class="btn btn-sm btn-danger rem-doc" type="button"><i class="fa fa-minus"></i></button></span>
                </div>
            </div>
            <div class="col-sm-8">
                {!! Form::text('ref_no[]','',['class'=>'form-control input-sm text-big','placeholder'=>'References Number', 'required']) !!}
            </div>
        </div>`;

        $('.document-group').append(elem);
        // $(this).addClass('disabled');
    });

    //remove doc
    $('.document-group').on('click', '.empty-doc', function(){

        $(this).parents('.form-group').find('#document_id').val('');
        $(this).parents('.form-group').find('#ref_no').val('');

        // $(this).parents('.form-group').remove();

        // var data = $('.input-doc').map(function(){
        //     return this.value;
        // }).get();

        // //console.log(data)
        // if(data.indexOf('') == -1){
        //     $('.add-doc').removeClass('disabled');
        // }
    });

    $('.document-group').on('click', '.rem-doc', function(){
        $(this).parents('.form-group').remove();

        // var data = $('.input-doc').map(function(){
        //     return this.value;
        // }).get();

        // //console.log(data)
        // if(data.indexOf('') == -1){
        //     $('.add-doc').removeClass('disabled');
        // }
    });

    //documnent group secure
    $('.document-group').on('change', '.options_doc', function(){
        var val = $(this).val();
        var parent = $(this).parents('.form-group');
        
        if(val != ''){
            parent.find('.input-doc').prop('readonly', false);
            if(parent.hasClass('has-error')){
                parent.removeClass('has-error');
                parent.find('.error').remove();
            }
        }
        else{
            parent.find('.input-doc').val('').prop('readonly', true);  
            if(parent.hasClass('has-error')){
                parent.removeClass('has-error');
                parent.find('.error').remove();
            }
        }
    });

    //input document
    $('.document-group').on('keyup', '.input-doc', function(){
        var length = $(this).val().length;
        if(length > 0){
            $('.add-doc').removeClass('disabled');
        }else{
            $('.add-doc').addClass('disabled');
        }
    });

    //add charge
    $('.add-charge').click(function(){
        var elem = $(`<div class="form-group">
            
            @php $doc = App\MasterDocument::where('type','payable')->get(); @endphp

            {!! Form::hidden('payable_id[]', 0) !!}
            <div class="col-sm-3">
                <div class="input-group">
                    {!! Form::select(
                        'document_id[]', 
                        [''=>'']+App\MasterDocument::where('type', 'payable')->pluck('name','id')->all(),
                        "old('document_id')", 
                        ['class'=>'form-control input-sm options_doc','id'=>'','required']) 
                    !!}
                    <span class="input-group-btn"><button class="btn btn-danger btn-sm rem-charge" type="button"><i class="fa fa-minus"></i></button></span>
                </div>
            </div>
            <div class="col-sm-3">
                {!! Form::select(
                    'vendor_id[]', 
                    [''=>'']+App\MasterVendor::pluck('name','id')->all(),
                    "old('vendor_id')", 
                    ['class'=>'form-control input-sm options_doc','id'=>'vendor_id','required']) 
                !!}
            </div>
            <div class="col-sm-1">
                <input type="text" class="form-control input-sm text-big text-number" placeholder="Quantity" name="quantity[]" required>
                <label class="x-mark">X</label>
            </div>
            <div class="col-sm-2">
                {!! Form::select(
                    'unit_id[]', 
                    [''=>'']+App\MasterUnit::pluck('name','id')->all(),
                    "old('unit_id')", 
                    ['class'=>'form-control input-sm options_doc','id'=>'unit_id']) 
                !!}
            </div>
            <div class="col-sm-1">
                {!! Form::select('pay_currency[]', ['1'=>'IDR','2'=>'USD'], '2', ['class'=>'form-control input-sm','disabled'=>'true']) !!}
            </div>
            <div class="col-sm-2">
                {!! Form::text('pay_price[]', '', ['class'=>'form-control input-sm text-right text-money pricing-amount','placeholder'=>'-','disabled'=>'true']) !!}
            </div>   
                </div>`);

        //number format for all new text-money element
        numberFormat(elem.find('.text-number'));

        $('.charge-group').append(elem);
    });

    //remove charge
    $('.charge-group').on('click', '.rem-charge', function(){
        $(this).parents('.form-group').remove();
    });

    $('.charge-group').on('click', '.empty-charge', function(){
        $(this).parents('.form-group').find('#pay_doc').val('');
        $(this).parents('.form-group').find('#vdr').val('');
        $(this).parents('.form-group').find('#qty').val('');
        $(this).parents('.form-group').find('#unt').val('');
    });

    //charge group secure
    /*$('.charge-group').on('keyup', '.charge', function(){
        var length = $(this).val().length;
        console.log($(this).parents('.form-group').find('select'))
        if(length > 0){
            $('.add-charge').removeClass('disabled');
            $(this).parents('.form-group').find('.input-sm').prop('readonly', false);
        }
        else{
            $('.add-charge').addClass('disabled');
        }
    });*/

    //datepicker
    $('.datepicker1').datepicker({
        autoclose: 'true',
        todayHighlight: 'true',
        format: 'dd-mm-yyyy'
    });

    $('.datepicker2').datepicker({
        autoclose: 'true',
        todayHighlight: 'true',
        format: 'dd-mm-yyyy'
    });

    $('.datepicker3').datepicker({
        autoclose: 'true',
        todayHighlight: 'true',
        format: 'dd-mm-yyyy'
    });

    $('.text-number').toArray().forEach((field) => {
        numberFormat(field);
    });

    //document validation
    $.validator.addMethod('documentValidation', function(value, element){
        return value != "";
    }, 'Error bang');

    //jquery validate
    $('#form-jobsheet').validate({
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.appendTo( element.parent('div') );
        },
        highlight: function(element, errorClass) {
            $(element).closest('.form-group').addClass('has-error').removeClass('valid');
        },
        unhighlight: function( element, errorClass, validClass ) {
            $(element).closest('.form-group').removeClass('has-error').addClass('valid');
        },
        rules: {
            freight_type: {required: true},
            //"no_references[]": {required: true}
        }
    });

    //cleave.js number format
    function numberFormat(selector){
        return new Cleave(selector, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    }

    //tutup alert
    (function(){
        var alert = $('.alert');

        if(alert.length > 0){
            setTimeout( () => {
                $('.alert').fadeTo(300, 0, 'linear', function(){
                    $(this).alert('close');
                });
            }, 2000);
        }
    })();
});

$(function(){

     //unit
    $.get("{{ url('unit/get') }}", function(data, status){
        if(status == "success"){
            for (var i = 0; i < data.length; i++) {
                option_unit += "<option value='"+data[i].id+"'>" + data[i].display + "</option>";
            }
        } else {
            alert("Maaf Sedang Gangguan, unit tidak bisa di tampilkan");
        }
    });
     //document
    $.get("{{ url('document/get') }}", function(data, status){
        if(status == "success"){
            for (var i = 0; i < data.length; i++) {
                option_doc += "<option value='"+data[i].id+"'>" + data[i].display + "</option>";
            }

            $("#document").append(option_doc);
        } else {
            alert("Maaf Sedang Gangguan, unit tidak bisa di tampilkan");
        }
    });
    //term
    $.get("{{ url('term/get') }}", function(data, status){
        if(status == "success"){
            for (var i = 0; i < data.length; i++) {
                term += "<option value='"+data[i].id+"'>" + data[i].name + "</option>";
            }
        } else {
            alert("Maaf Sedang Gangguan, unit tidak bisa di tampilkan");
        }
    });

    var table = $('#myTable').DataTable({
        "serverSide": true,
        "processing": true,
        "ajax":{
            type : "POST",
            url : "{{ url('jobsheet/uncreate') }}",
            data: function (d){
                d.param = 1;
                d.customer = $("#filter_customer_binding").val();
                d.jobsheet = $("#filter_job").val();
                d.vendor = $("#filter_vendor_binding").val();
                d.poo = $("#filter_poo_binding").val();
                d.document = $("#document").val();
                d.pod = $("#filter_pod_binding").val();
                d.date = $("#filter_date").val();
            }
        } ,
        "columnDefs": [
            { 
                targets: 0, 
                data: "DT_Row_Index", 
                name: "DT_Row_Index", 
                orderable: false,
                searchable: false,
                width: "1%"
            },
            {
                targets: 1,
                title: '<span>JOB</span>',
                data: null,
                name: 'code',
                render: function (data) {
                    var actions = '';
                    actions = '<a href="#'+data['id']+'" data-id="'+data['id']+'" class="detailJobSheet" aria-controls="'+data['id']+'" role="tab" data-toggle="tab">'+data['code']+'</a>';
                    return actions.replace();
                },
                sClass: 'td-nowrap',
                width: '10%'
            },
            {
                targets: 2,
                title: '<span>DATE</span>',
                data: 'date',
                defaultContent: "-",
                name: 'date',
                width: '10%'
            },
            {
                targets: 3,
                title: '<span>CUSTOMER</span>',
                data: 'customer[, ].nick_name',
                defaultContent: "-",
                name: 'customer.nick_name',
                orderable: false
            },
            {
                targets: 4,
                title: '<span>MARKETING</span>',
                data: 'marketing.name',
                defaultContent: "-",
                name: 'marketing.name',
                orderable: false
            },
            {
                targets: 5,
                title: '<span>ORIGIN</span>',
                data: 'poo.city',
                defaultContent: "-",
                name: 'poo.city',
                orderable: false
            },
            {
                targets: 6,
                title: '<span>DESTINATION</span>',
                data: 'pod.city',
                defaultContent: "-",
                name: 'pod.city',
                orderable: false
            },
            {
                targets: 7,
                title: '<span>DOCUMENT</span>',
                data: 'document[, ].name',
                defaultContent: "-",
                name: 'document.name',
                width: '15%',
                orderable: false
            },
            {
                targets: 8,
                title: '<span>VENDOR</span>',
                data: 'payable[, ].vendor.nick_name',
                defaultContent: "-",
                name: 'payable.vendor.nick_name',
                width: '15%',
                orderable: false
            },
            {
                targets : [2,3,4,5,6,7,8],
                render: function (data) {
                    //console.log(data);
                    var data = (data != '') ? data : '-';
                    var actions = `<span>${data}</span>`;
                    return actions.replace();
                },
                sClass: 'td-ellipsis'
            }
        ],
    });
    //array tab
    var arrayTabs = [];
    //angka urut untuk value array supaya ga double
    var numCount = 0;

    //buat jobsheet baru
    $('#myTable').on('click', '.detailJobSheet', function(event){
        event.stopPropagation();
        event.preventDefault();

        //title job
        var title = $(this).text();
        var jobId = $(this).data('id');
        //jika job tidak ada dlm array job, maka buat tab baru
        if(arrayTabs.indexOf(jobId) == -1){
            //masukkan unique identifier ke array tab
            arrayTabs.push(jobId);
            //element tab baru
            var elemTab = $(`<li role="presentation" class="tabs-tab" data-job="${jobId}">
                <a href="#${jobId}" aria-controls="${jobId}" role="tab" data-toggle="tab">JOB: ${title}
                    <i class="tabs-close fa fa-times"></i>
                </a>
            </li>`);
            //element panel untuk tab
            var elemPanel = $(`<div role="tabpanel" class="tab-pane" id="${jobId}"></div>`);
            //masukkan tab baru
            //$('.nav-tabs-1').append(elemTab);
            elemTab.insertAfter($('.nav-tabs-1').find('li:eq(0)'));
            //load form pd panel
            $.get(`{{ url('/marketing/jobsheetform/${jobId}') }}`, function(result){
                elemPanel.html(result);
            });
            //masukkan element panel baru
            $('.tab-content-1').append(elemPanel);
            //trigger click tab baru setiap create new tab
            elemTab.find('a').trigger('click');
        }
        else{
            $(`[data-job="${jobId}"]`).find('a').trigger('click');
        }
    });

    //buat close tab jobsheet
    $('.nav-tabs-1').on('click', '.tabs-close', function(event){
        event.stopPropagation();
        event.preventDefault();

        var parent = $(this).parents('.tabs-tab');
        var id = parent.data('job');
        var activeTab = $('.tabs-tab.active').data('job');
        var nextElem = $('.tabs-tab.active').next('.tabs-tab');

        if(id == activeTab){
            if(nextElem.length > 0){
                $(this).parents('.tabs-tab').next().find('a').trigger('click');
            }
            else{
                $(this).parents('.tabs-tab').prev().find('a').trigger('click');
            }
        }

        parent.remove();
        $(`#${id}`).remove();

        var index = arrayTabs.indexOf(id);
        arrayTabs.splice(index, 1);
    });

    //reimbursement radio
    $('.tab-content').on('click', '', function(){
        var jobId = $(this).data('id');
        var val = $(this).val();

        if($(this).is(':checked')){
            $(`#tabreimburse${jobId}`).find('.input-reimburse').attr('disabled', false);
            $(`#tabreimburse${jobId}`).find('.add-terms-reimburse').prop('disabled',false).removeClass('disabled');
            $(`#tabreimburse${jobId}`).find('.add-reimburse').removeClass('disabled');
            $(`#tabreimburse${jobId}`).find('.bpeng').prop('disabled',false).attr('readonly',true);
        }
        else{
            //jika terms-group lebih dr 1, hapus semuanya, buat element dr awal
            //jika false, cuma add class disable
            if($(`#tabreimburse${jobId}`).find('.terms-group').length > 1){
                //hapus semua terms group
                $(`#tabreimburse${jobId}`).find('.terms-group').remove();
                //class untuk button & icon dinamis
                var classButton = {
                    name : "add-terms-reimburse",
                    type : "btn-primary",
                    icon : "fa-plus"
                };

                var selector = $(`#tabreimburse${jobId}`).find('.total-group');
                return addTermsReimburse(selector, classButton, 'reset');
            }
            else{
                $(`#tabreimburse${jobId}`).find('.input-reimburse').attr('disabled', true);
                $(`#tabreimburse${jobId}`).find('.add-terms-reimburse').addClass('disabled');
                $(`#tabreimburse${jobId}`).find('.add-reimburse').addClass('disabled');
            }
        }
    });

    //btn filter search
    $('.btn-filter-search').click(function(){
        $('.filter-search').slideToggle(200);
        $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        $(this).toggleClass('btn-active');
    });

    //hide references
    $('.tab-content').on('click', '.hide-ref', function(){
        $(this).siblings('.ref-detail').slideToggle(200);
        $(this).toggleClass('no-margin-top').toggleClass('show-ref');
    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: 'true',
        todayHighlight: 'true',
        format: 'dd-mm-yyyy'
    });
    //Filter-Proses
    $('#filter_btn').on('click',function(){
        table.ajax.reload();
    });
    //Reset-Filter
    $('#filter_reset_btn').on('click', function(){
        $('.filter-input').val('');
        table.ajax.reload();
    });

    //auto complete vendor
    $('#filter_vendor').autocomplete({
        source: function( request, response ) {
            $.ajax({
            url: "/vendor/search",
            type: 'post',
            data: "param="+request.term,
            success: function( data ) {
                var i = 0;
                var arr =[];
                var length = data['data'].length;
                for ( i=0; i<length; i++) {
                    arr.push({
                        "label":data['data'][i]['nick_name'],
                        "value":data['data'][i]['id']
                        });
                }
                response(arr);
            }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
            event.preventDefault();
            $("#filter_vendor").val(ui.item.label);
            $("#filter_vendor_binding").val(ui.item.value);
        }
    });
    //hitungan charges
    $('.tab-content').on('keyup','.ammount', function(event){
        ammount = $(this).val();
        if (ammount == ""){
            ammount = 1;
        } else {
            var arr = ammount.split(',');
            var length_arr = arr.length;
            if (length_arr > 0){
                var str="";
                for (var i=0; i<length_arr; i++){
                    str += arr[i];
                }
                ammount = str;
            }
        }
        subtotal = parseInt(ammount)*parseFloat(qty);
        currency = $(this).parents('.form-group').find('.currency').val();

        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            ;
        });

        return count(this);
    });

    $('.tab-content').on('change','.currency', function(){
        currency = $(this).val();
        $(this).parents('.form-group').find('.subtotal').attr('param',currency);
        return count(this);
    });

    $('.tab-content').on('keyup','.qty', function(){
        qty = 0;
        qty = $(this).val();
        ammount = $(this).parents('.form-group').find('.ammount').val();
        if (ammount == ""){
            ammount = 1;
        } else {
            var arr = ammount.split(',');
            var length_arr = arr.length;
            if (length_arr > 0){
                var str="";
                for (var i=0; i<length_arr; i++){
                    str += arr[i];
                }
                ammount = str;
            }
        }
        subtotal = parseInt(ammount)*parseFloat(qty);
        currency = $(this).parents('.form-group').find('.currency').val();
       
        return count(this);
    });
    //HITUNGAN REIMBURSEMENT
    $('.tab-content').on('keyup','.rmb_ammount', function(event){
        rmb_ammount = $(this).val();
        if (rmb_ammount == ""){
            rmb_ammount = 1;
        } else {
            var arr = rmb_ammount.split(',');
            var length_arr = arr.length;
            if (length_arr > 0){
                var str="";
                for (var i=0; i<length_arr; i++){
                    str += arr[i];
                }
                rmb_ammount = str;
            }
        }
        rmb_subtotal = parseInt(rmb_ammount)*parseFloat(rmb_qty);
         //
        if(event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            ;
        });
        return rmbCount(this);
    });

    $('.tab-content').on('change','.rmb_currency', function(){
        rmb_currency = $(this).val();
        $(this).parents('.form-group').find('.rmb_subtotal').attr('param',rmb_currency);
        return rmbCount(this);
    });

    $('.tab-content').on('keyup','.rmb_qty', function(){
        rmb_qty = 0;
        rmb_qty = $(this).val();
        rmb_ammount = $(this).parents('.form-group').find('.rmb_ammount').val();
        if (rmb_ammount == ""){
            rmb_ammount = 1;
        } else {
            var arr = rmb_ammount.split(',');
            var length_arr = arr.length;
            if (length_arr > 0){
                var str="";
                for (var i=0; i<length_arr; i++){
                    str += arr[i];
                }
                rmb_ammount = str;
            }
        }
        rmb_subtotal = parseInt(rmb_ammount)*parseFloat(rmb_qty);
        return rmbCount(this);
    });

    //HITUNGAN R/C CUSTOMER

    $('.tab-content').on('keyup','.rc_ammount', function(event){
        rc_ammount = $(this).val();
        if (rc_ammount == ""){
            rc_ammount = 1;
        } else {
            var arr = rc_ammount.split(',');
            var length_arr = arr.length;
            if (length_arr > 0){
                var str="";
                for (var i=0; i<length_arr; i++){
                    str += arr[i];
                }
                rc_ammount = str;
            }
        }
        rc_subtotal = parseInt(rc_ammount)*parseFloat(rc_qty);
         //
        if(event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            ;
        });
        return rcCount(this);
    });

    $('.tab-content').on('change','.rc_currency', function(){
        rc_currency = $(this).val();
        $(this).parents('.form-group').find('.rc_subtotal').attr('param',rc_currency);
        return rcCount(this);
    });

    $('.tab-content').on('keyup','.rc_qty', function(){
        rc_qty = 0;
        rc_qty = $(this).val();
        rc_ammount = $(this).parents('.form-group').find('.rc_ammount').val();
        if (rc_ammount == ""){
            rc_ammount = 1;
        } else {
            var arr = rc_ammount.split(',');
            var length_arr = arr.length;
            if (length_arr > 0){
                var str="";
                for (var i=0; i<length_arr; i++){
                    str += arr[i];
                }
                rc_ammount = str;
            }
        }
        rc_subtotal = parseInt(rc_ammount)*parseFloat(rc_qty);
        return rcCount(this);
    });

});

//Auto complete poo
function completePoo(e, f){
     $(e).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "/port/search",
                type: 'post',
                contenType: 'application/json',
                data: {
                    "param" : request.term,
                    "type" : "0"
                },
                success: function( data ) {
                    var i = 0;
                    var arr =[];
                    var length = data['data'].length;
                    for ( i=0; i<length; i++) {
                        arr.push({"label":data['data'][i]['city'],"value":data['data'][i]['id']});
                    }
                    response(arr);
                }
                });
            },
            minLength: 1,
            select: function( event, ui ) {
                event.preventDefault();
                $(e).val(ui.item.label);
                if (f == 'filter') {
                    $("#filter_poo_binding").val(ui.item.value);
                } else {
                    $("#edit_poo_binding").val(ui.item.value);
                }
            }
    });
}
//auto complete pod
function completePod(e, f){
    $(e).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "/port/search",
                type: 'post',
                contenType: 'application/json',
                data: {
                    "param" : request.term,
                    "type" : "1"
                },
                success: function( data ) {
                    var i = 0;
                    var arr =[];
                    var length = data['data'].length;
                    for ( i=0; i<length; i++) {
                        arr.push({"label":data['data'][i]['city'],"value":data['data'][i]['id']});
                    }
                    response(arr);
                }
                });
            },
            minLength: 1,
            select: function( event, ui ) {
                event.preventDefault();
                $(e).val(ui.item.label);
                if (f=='filter') {
                    $("#filter_pod_binding").val(ui.item.value);
                } else {
                    $("#edit_pod_binding").val(ui.item.value);
                }
            }
    });
}
function declineModal(e) {
     var id_job = $(e).data('id');
     $('#decline_id_job').val(id_job);
 }
 //hitungan charges
//hitungan
function count(e) {
    $(e).parents('.form-group').find('.subtotal').val(subtotal);
    //jadiin koma
   $(e).parents('.form-group').find('.subtotal').val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            ;
        });
    return countAll();
}
//hitungan semua
function countAll(){
    var idr = 0;
    $('.subtotal[param="1"]').each(function(){
        var a = $(this).val();
        var b = a.split(',');
        var s="";
        var length_b = b.length;
        if (length_b > 0){
            var str_b = "";
            for (var j=0; j<length_b; j++){
                str_b += b[j];
            }
            s = str_b;
        } else {
            s = $(this).val();
        }
        idr += parseFloat(s);  // Or this.innerHTML, this.innerText
    });
    var usd = 0;
    $('.subtotal[param="2"]').each(function(){
        var a = $(this).val();
        var b = a.split(',');
        var s="";
        var length_b = b.length;
        if (length_b > 0){
            var str_b = "";
            for (var j=0; j<length_b; j++){
                str_b += b[j];
            }
            s = str_b;
        } else {
            s = $(this).val();
        }
        usd += parseFloat(s);  // Or this.innerHTML, this.innerText
    });
    $('.tab-pane').find('#total-usd').text(usd);
    $('.tab-pane').find('#total-idr').text(idr);
    //ubah ke koma
    $('.tab-pane').find('#total-idr').text(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
    });
    //ubah ke koma
    $('.tab-pane').find('#total-usd').text(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
    });

}
//hitungan reimbursement
function rmbCount(e) {
    $(e).parents('.form-group').find('.rmb_subtotal').val(rmb_subtotal);
    $(e).parents('.form-group').find('.rmb_subtotal').val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            ;
        });
    return rmbCountAll();
}
//hitungan semua
function rmbCountAll(){
    var idr = 0;
    $('.rmb_subtotal[param="1"]').each(function(){
        var a = $(this).val();
        var b = a.split(',');
        var s="";
        var length_b = b.length;
        if (length_b > 0){
            var str_b = "";
            for (var j=0; j<length_b; j++){
                str_b += b[j];
            }
            s = str_b;
        } else {
            s = $(this).val();
        }
        idr += parseFloat(s);  // Or this.innerHTML, this.innerText
    });
    var usd = 0;
    $('.rmb_subtotal[param="2"]').each(function(){
        var a = $(this).val();
        var b = a.split(',');
        var s="";
        var length_b = b.length;
        if (length_b > 0){
            var str_b = "";
            for (var j=0; j<length_b; j++){
                str_b += b[j];
            }
            s = str_b;
        } else {
            s = $(this).val();
        }
        usd += parseFloat(s);  // Or this.innerHTML, this.innerText
    });
    $('.tab-pane').find('#rmb_total-usd').text(usd);
    $('.tab-pane').find('#rmb_total-idr').text(idr);
    //ubah ke koma
    $('.tab-pane').find('#rmb_total-idr').text(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
    });
    //ubah ke koma
    $('.tab-pane').find('#rmb_total-usd').text(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
    });

}
//HITUNGAN RC TOTAL
function rcCount(e) {
    $(e).parents('.form-group').find('.rc_subtotal').val(rc_subtotal);
    $(e).parents('.form-group').find('.rc_subtotal').val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            ;
        });
    return rcCountAll();
}
//hitungan semua
function rcCountAll(){
    var idr = 0;
    $('.rc_subtotal[param="1"]').each(function(){
        var a = $(this).val();
        var b = a.split(',');
        var s="";
        var length_b = b.length;
        if (length_b > 0){
            var str_b = "";
            for (var j=0; j<length_b; j++){
                str_b += b[j];
            }
            s = str_b;
        } else {
            s = $(this).val();
        }
        idr += parseFloat(s);  // Or this.innerHTML, this.innerText
    });
    var usd = 0;
    $('.rc_subtotal[param="2"]').each(function(){
        var a = $(this).val();
        var b = a.split(',');
        var s="";
        var length_b = b.length;
        if (length_b > 0){
            var str_b = "";
            for (var j=0; j<length_b; j++){
                str_b += b[j];
            }
            s = str_b;
        } else {
            s = $(this).val();
        }
        usd += parseFloat(s);  // Or this.innerHTML, this.innerText
    });
    $('.tab-pane').find('#rc_total-usd').text(usd);
    $('.tab-pane').find('#rc_total-idr').text(idr);
    //ubah ke koma
    $('.tab-pane').find('#rc_total-idr').text(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
    });
    //ubah ke koma
    $('.tab-pane').find('#rc_total-usd').text(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
    });

}


// function getUnit(e){
//     $(e).empty();
//     $(e).append(option_unit);
//  }

 function getTerm(e){
    $(e).empty();
    $(e).append(term);
 }
 //MODAL DECLINE
function completeCustomer(e, f){
    $(e).autocomplete({
        source: function( request, response ) {
            $.ajax({
            url: "/customer/search",
            type: 'post',
            data: "param="+request.term,
            success: function( data ) {
                var i = 0;
                var arr =[];
                var length = data['data'].length;
                for ( i=0; i<length; i++) {
                    arr.push({"label":data['data'][i]['name'],"value":data['data'][i]['id']});
                }
                response(arr);
            }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
            event.preventDefault();
            $(e).val(ui.item.label);
            if (f=='filter') {
                $("#filter_customer_binding").val(ui.item.value);
            } else {
                $(e).nextAll('.bill_to_binding').val("").val(ui.item.value);
            }
        }
    });
}
//auto complete vendor
function completeVendor(e){
    $(e).autocomplete({
        source: function( request, response ) {
        $.ajax({
        url: "/vendor/search",
        type: 'post',
        data: "param="+request.term,
        success: function( data ) {
            var i = 0;
            var arr =[];
            var length = data['data'].length;
            for ( i=0; i<length; i++) {
                arr.push({
                    "label":data['data'][i]['nick_name'],
                    "value":data['data'][i]['id']
                    });
            }
            response(arr);
        }
        });
    },
    minLength: 1,
    select: function( event, ui ) {
        event.preventDefault();
        $(e).val(ui.item.label);
        $(e).nextAll('.hidden-vendor').remove();
        $(e).after( "<input type='hidden' name='vendor[]' value='"+ui.item.value+"' class='hidden-vendor'>" );
    }
    })
}
//charges
function completeCharge(e){
    $(e).autocomplete({
        source: function( request, response ) {
        $.ajax({
        url: "/doc/receivable/search",
        type: 'post',
        data: "param="+request.term,
        success: function( data ) {
            var i = 0;
            var arr =[];
            var length = data['data'].length;
            for ( i=0; i<length; i++) {
                arr.push({
                    "label":data['data'][i]['name'],
                    "value":data['data'][i]['id']
                    });
            }
            response(arr);
        }
        });
    },
    minLength: 1,
    select: function( event, ui ) {
        event.preventDefault();
        $(e).val(ui.item.label);
        $(e).nextAll('.binding_charge').val("").val(ui.item.value);
    }
    });
}

function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }

</script>