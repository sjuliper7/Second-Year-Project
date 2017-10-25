<!-- Custom-JavaScript-File-Links -->

<!-- Default-JavaScript -->

<script type="text/javascript" src="{{asset('js/lightbox-plus-jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>
<!-- Bootstrap-JavaScript -->
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Sweealert-JavaScript -->
<script type="text/javascript" src="{{asset('js/sweet-alert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/sweet-alert.js')}}"></script>

<!-- Animate.CSS-JavaScript -->
<script src="{{asset('js/wow.min.js')}}"></script>
<script>
new WOW().init();
</script>
<!-- //Animate.CSS-JavaScript -->

<script type="text/javascript">
$(document).ready(function() {
$('.thumbnail').click(function(){
		$('.modal-body').empty();
	var title = $(this).parent('a').attr("title");
	$('.modal-title').html(title);
	$($(this).parents('div').html()).appendTo('.modal-body');
	$('#myModal').modal({show:true});
});
});
</script>

<!-- Slider-JavaScript -->
<script src="{{asset('js/responsiveslides.min.js')}}"></script>
<script>
$(function () {
	$("#slider1, #slider2, #slider3, #slider4").responsiveSlides({
		auto: true,
		nav: true,
		speed: 1500,
		namespace: "callbacks",
		pager: true,
	});
});
</script>
<!-- //Slider-JavaScript -->

<!-- Slide-To-Top JavaScript (No-Need-To-Change) -->


<!-- //Slide-To-Top JavaScript -->

<!-- Smooth-Scrolling-JavaScript -->
<script type="text/javascript" src="{{asset('js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('js/easing.js')}}"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$(".scroll, .navbar li a, .footer li a").click(function(event){
		$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
	});
});
</script>
<!-- //Smooth-Scrolling-JavaScript -->

<!-- Booking-Popup-Box-JavaScript -->
<script src="{{asset('js/jquery.magnific-popup.js')}}" type="text/javascript"></script>
<script>
$(document).ready(function() {
	$('.popup-with-zoom-anim').magnificPopup({
		type: 'inline',
		fixedContentPos: false,
		fixedBgPos: true,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
	});
});
</script>
<!-- //Booking-Popup-Box-JavaScript -->

<!-- Date-Picker-JavaScript -->
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script>
$('#datepicker2').datepicker({
	dateFormat: "yy-mm-dd"
});

$("#datepicker1").datepicker({
	dateFormat: "yy-mm-dd",
	minDate:  0,
	onSelect: function(date){
		var date1 = $('#datepicker1').datepicker('getDate');
		var date = new Date( Date.parse( date1 ) );
		date.setDate( date.getDate() + 1 );
		var newDate = date.toDateString();
		newDate = new Date( Date.parse( newDate ) );
		$('#datepicker2').datepicker("option","minDate",newDate);
	}
});
</script>



<!-- //Custom-JavaScript-File-Links -->
