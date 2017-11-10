<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<script>
var id_bank = '';

var id_check = new Array();
$(function(){
    $.get("/account-bank/get", function(data, status){
        if(status == "success"){
            for(var i=0; i<data.length; i++){
                id_bank += `<option value="${data[i]['id']}">${data[i]['bank']}</option>`;
            }
        } else {
            alert("Maaf Sedang Gangguan, unit tidak bisa di tampilkan");
        }
        $("#bank_account").append(id_bank);
    });
    var table = $('#myTable').DataTable({
        "serverSide": true,
        "ajax":{
            type : "POST",
            url : "/invoice/jobsheet/get/uncreate"
        } ,
        "columnDefs": [
            { 
                targets: 0, 
                title: '#',
                data: "DT_Row_Index", 
                name: "DT_Row_Index", 
                orderable: false,
                searchable: false,
                width: "2%"
            },
            {
                targets: 1,
                title: 'JOB',
                data: null,
                name: 'jobSheet.code',
                render: function (data) {
                    var actions = '';
                    actions = `<a href="#${data['id']}" class="detailJobSheet" aria-controls="${data['id']}" role="tab" data-toggle="tab" data-id="${data['id']}">${data['code']}</a>`;
                    return actions.replace();
                },
                sClass: 'td-nowrap',
                orderable: false,
                searchable: false
            },
            {
                targets: 2,
                title: '<span>DATE</span>',
                data: 'date',
                defaultContent: "-",
                name: 'date'
            },
            {
                targets: 3,
                title: '<span>CUSTOMER</span>',
                data: 'customer[, ].nick_name',
                defaultContent: "-",
                name: 'customer.nick_name'
            },
            {
                targets: 4,
                title: '<span>ORIGIN</span>',
                data: 'poo.city',
                defaultContent: "-",
                name: 'poo.city'
            },
            {
                targets: 5,
                title: '<span>DESTINATION</span>',
                data: 'pod.city',
                defaultContent: "-",
                name: 'pod.city'
            },
            {
                targets: 6,
                title: '<span>MARKETING</span>',
                data: 'marketing.name',
                defaultContent: "-",
                name: 'marketing.name'
            },
            {
                targets : [2,3,4,5,6],
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
    $('#myTable').on('click','.detailJobSheet',function(event){
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
            //$('.nav-tabs').append(elemTab);
            elemTab.insertAfter($('.nav-tabs').find('li:eq(0)'));
            //load form pd panel
            $.get(`{{ url('/invoice/invoiceform') }}`, {id: jobId}, function(result){
                elemPanel.html(result);
            });
            //masukkan element panel baru
            $('.tab-content').append(elemPanel);
            //trigger click tab baru setiap create new tab
            elemTab.find('a').trigger('click');
        }
        else{
            $(`[data-job="${jobId}"]`).find('a').trigger('click');
        }
    });

    //buat close tab jobsheet
    $('.nav-tabs').on('click', '.tabs-close', function(event){
        event.stopPropagation();
        event.preventDefault();
        id_check=[];
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

    //add new doc
    $('.add-doc').click(function(){
        var elem = `<div class="form-group">
            <div class="col-md-4 col-md-offset-2 no-padding-right">
                <div class="input-group">
                    <select name="document[]" id="" class="form-control input-sm" required="required">
                        <option value="">DOCUMENT</option>
                        <option value="1">MB/L</option>
                        <option value="2">HB/L</option>
                    </select>
                    <span class="input-group-btn"><button class="btn btn-danger btn-sm rem-doc" type="button"><i class="fa fa-minus"></i></button></span>
                </div>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control input-sm" id="email" placeholder="No. Reference" readonly>
            </div>
        </div>`;

        $('.document-group').append(elem);
    });

    //remove doc
    $('.document-group').on('click', '.rem-doc', function(){
        $(this).parents('.form-group').remove();
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

    $('.tab-content').on('click','.btn-modal-invoice', function(e){
        var id = $(this).closest("form").find('.hidden-id-receivable').val();
      
        if(id==""){
            alert ('Anda Belum Memilih Charges Yang Akan di Buat Invoicenya!');
            return e.stopPropagation();
        }
        $.post("/invoice/check/receivable",{"id": id}, function(data, status){
                if(status == "success"){
                    var errorlist = '';
                    if(data['param_bill'] == 'gax') errorlist += "Bill To Harus Sama, ";
                    if(data['param_tax'] == 'gax') errorlist += "Tax Harus Sama, ";
                    if(data['param_term'] == 'gax') errorlist += "Term Harus Sama, ";
                    if(data['param_currency'] == 'gax') errorlist += "Currency Harus Sama, ";
                    if(errorlist != ''){
                        alert (errorlist);
                        return e.stopPropagation();
                    } else {
                        var doc_modal ='';
                        var id_receivable = new Array;
                        for(var i=0; i<data['receivable'].length; i++){
                            id_receivable.push(data['receivable'][i]['id']);
                        }
                        $("#id_receivable_modal").val(id_receivable);
                        for(var i=0; i<data['document'].length; i++){
                            doc_modal += `<label class="fancy-checkbox"><input class="check-req" name="document[]" type="checkbox" value="${data['document'][i]['id']}"><span></span>${data['document'][i]['name']} - ${data['document'][i]['pivot']['no_reference']}</label>` 
                        }
                        $("#references_modal").empty().append(doc_modal);
                        $("#customer_name_modal").val(data['customer_name']);
                        $("#label_customer_modal").text(data['customer_name']);
                        $("#customer_address_modal").val(data['customer_address']);
                        $("#billto_name_modal").val(data['billTo_name']);
                        $("#id_job_modal").val(data['id_job']);
                        var tax ='';
                        if(data['tax'] == 1) {
                            tax = 'PPN 1';
                        } else if(data['tax'] == 2) {
                            tax = 'PPN 2';
                        } else {
                            tax = 'NON PPN';
                        }
                        $("#tax_modal").text(tax);
                        $("#term_modal").text(data['term_name']);
                        $("#label_billto_modal").text(data['billTo_name']);
                        $("#billto_address_modal").val(data['billTo_address']);
                        var receivable = '';
                        var value = 0;
                        for(var i=0; i<data['receivable'].length; i++){
                            var currency = (data['receivable'][i]['currency'] == 1) ? "IDR":"USD";
                            var total = data['receivable'][i]['price']*data['receivable'][i]['qty'];
                            total = total.toFixed(2);
                            var price = data['receivable'][i]['price'];
                            price = price.toFixed(2);
                            receivable += `<tr class="list_receivable">
                                    <td>${i+1}</td>
                                    <td>${data['receivable'][i]['charge']['name']}</td>
                                    <td class="text-center">${data['receivable'][i]['qty']} x ${data['receivable'][i]['unit']['name']}</td>
                                    <td class="text-center">${currency}</td>
                                    <td class="text-right">${price}</td>
                                    <td class="text-right">${total}</td>
                                </tr>`;
                            value += data['receivable'][i]['price']*data['receivable'][i]['qty'];
                        }
                        $("#tbody_modal").find('.list_receivable').remove()
                        $("#tbody_modal").prepend(receivable);
                        $("#net_value_modal").text(value.toFixed(2));
                    
                        //PERHITUNGAN PAJAK
                        var vat =0;
                        if(data['tax'] == 1){
                            vat = value * 1/100;
                            vat = vat.toFixed(2);
                            $("#ammount_due_modal").text((parseFloat(value)+parseFloat(vat)).toFixed(2));
                        } else {
                            vat = value/1.01*1/100;
                            vat = vat.toFixed(2);
                            $("#ammount_due_modal").text(parseFloat(value)-parseFloat(vat));
                        }
                        $("#vat_modal").text(vat);


                        $('#modal-invoice').modal('show');
                    }
                } else {
                    alert("Maaf Sedang Gangguan, unit tidak bisa di tampilkan");
                }
            });
    });

    $('.tab-content').on('change','.check-req', function() {
        if(this.checked){
            id_check.push($(this).val()); 
        } else {
            for (var i = 0; i < id_check.length; i++)
                if (id_check[i] == $(this).val()) { 
                    id_check.splice(i, 1);
                    break;
                }
        }
        $(this).closest("tbody").find('.hidden-id-receivable').val(id_check);
    });
});
</script>