<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('js/klorofil-common.js') }}"></script>
<script src="{{ asset('select2/dist/js/select2.js') }}"></script>

<script>
$(function(){
    /*sidebar fix collapse*/
    $('.sb-nav-child').click(function(){
        if($(this).hasClass('sb-has-child')){
            $(this).siblings('li').find('.active').trigger('click');
        }
    });

    /*active sidebar when same url*/
    $(".nav a").each(function() {
        if (this.href == window.location.href) {
            var parent = $(this).parents('.sb-has-child');
            if(parent.length > 0){
                parent.find('.collapsed').trigger('click');
            }
            $(this).addClass("active-sb-child");
        }
    });

    /*scroll horizontal with vertical scroll*/
    /*note: perfect di all browser pke mouse, buggie di firefox pke touchpad*/
    $('.nav-tabs-wrapper').on('mousewheel DOMMouseScroll', function(event){
        if($(window).innerWidth() >= 768 ){
            //copas google, ga paham maksudnya -_-
            var delta = Math.max(-1, Math.min(1, (event.originalEvent.wheelDelta || -event.originalEvent.detail)));

            $(this).scrollLeft( $(this).scrollLeft() - ( delta * 40 ) );
            event.preventDefault();
            //event.stopPropagation();
        }
    });
});
</script>
