<script src="{{ asset('vendor/bootstrap/js/bootstrap-datepicker.js') }}"></script>
<script>
    $(document).ready(function(){
        var dateFormat = 'yyyy-mm-dd',
                rangeFrom = $('.datepicker-from')
                        .datepicker({
                            autoclose: 'true',
                            //setDate: new Date(),
                            //todayHighlight: 'true',
                            format: dateFormat
                        }).on( "changeDate", function() {
                            console.log(getDate( $(this) ));
                            rangeTo.datepicker( "setStartDate", getDate( $(this) ) );
                        }),
                rangeTo = $('.datepicker-to')
                        .datepicker({
                            autoclose: 'true',
                            //setDate: new Date(),
                            //todayHighlight: 'true',
                            format: dateFormat
                        }).on( "changeDate", function() {
                            rangeFrom.datepicker( "setEndDate", getDate( $(this) ) );
                        });

        function getDate( element ) {
            var date;
            try {
                date = element.val();
            } catch( error ) {
                date = null;
            }

            return date;
        }
    });
</script>