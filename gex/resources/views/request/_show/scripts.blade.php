<script src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}"></script>
<script>
    $(document).ready(function(){
        var body = $('body');
        var requestMenuSidebar = $('#request').parent();
        requestMenuSidebar.find('.collapsed').click();
        requestMenuSidebar.find('.nav li:first a').addClass('active');

        $('.datepicker').datepicker({
            autoclose: 'true',
            setDate: new Date(),
            //todayHighlight: 'true',
            format: 'yyyy-mm-dd'
        });
        function toggleShowBtnCreateRequestPayable(){
            var payableSelectedIds = body.find('.payable_ids:checked');
            var requestBtnCreate = $('#create-request-payable');
            requestBtnCreate.addClass('hidden');
            if( payableSelectedIds.length > 0 ){
                requestBtnCreate.removeClass('hidden');
            }
        }

        body.on('click', '.payable_all_id', function () {
            var $thisChecked = $(this).prop("checked");
            var checkBoxes = $('.payable_ids').not('.requested');
            checkBoxes.prop("checked", $thisChecked);
            toggleShowBtnCreateRequestPayable();
        });

        body.on('click', '.payable_ids', function () {
            toggleShowBtnCreateRequestPayable();
        });

        body.on('click', '#create-request-payable', function (e) {
            //e.preventDefault()
            var payableIds = $('body').find('.payable_ids:checked');
            if( payableIds.length <= 0 ){
                alert('Please select Jobsheet ID\'s to create Request');
                return false;
            }
            return true;
        });
        toggleShowBtnCreateRequestPayable();

        var requestedPayable = body.find('input[type="checkbox"].requested');
        var payable = body.find('.payable_ids');
        if( requestedPayable.length == payable.length){
            $('.payable_all_id').addClass('hidden');
            $('#create-request').addClass('hidden');
        }

        function toggleShowBtnCreateRequestRC(){
            var rcSelectedIds = body.find('.rc_ids:checked');
            var requestBtnCreate = $('#create-request-rc');
            requestBtnCreate.addClass('hidden');
            if( rcSelectedIds.length > 0 ){
                requestBtnCreate.removeClass('hidden');
            }
        }

        body.on('click', '.rc_all_id', function () {
            var $thisChecked = $(this).prop("checked");
            var checkBoxes = $('.rc_ids').not('.requested');
            checkBoxes.prop("checked", $thisChecked);
            toggleShowBtnCreateRequestRC();
        });

        body.on('click', '.rc_ids', function () {
            toggleShowBtnCreateRequestRC();
        });

        body.on('click', '#create-request-rc', function (e) {
            //e.preventDefault()
            var rcIds = $('body').find('.rc_ids:checked');
            if( rcIds.length <= 0 ){
                alert('Please select Jobsheet ID\'s to create Request');
                return false;
            }
            return true;
        });
        toggleShowBtnCreateRequestRC();

        var requestedPayable = body.find('input[type="checkbox"].requested');
        var rc = body.find('.rc_ids');
        if( requestedPayable.length == rc.length){
            $('.rc_all_id').addClass('hidden');
            $('#create-request-rc').addClass('hidden');
        }

    });
</script>