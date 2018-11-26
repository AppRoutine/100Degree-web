<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{!! asset('bower_components/jquery/dist/jquery.min.js') !!}"></script>
<script src="{!! asset('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- fullCalendar -->
<script src="{!! asset('bower_components/moment/moment.js') !!}"></script>
<script src="{!! asset('dist/js/modernizr.js') !!}"></script>
<script src="{!! asset('dist/js/main.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/jquery.toast.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/jquery.validate.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/additional-methods.min.js') !!}"></script>

@if (session('success'))
	<script type="text/javascript">
		$.toast({
			heading: 'Success',
			text: '{{ session('success') }}',
			showHideTransition: 'slide',
			position: 'bottom-right',
			stack: 2,
			icon: 'success'
		});
	</script>
	@php
		session()->forget('success');
	@endphp
@endif

@if (session('error'))
	<script type="text/javascript">
		$.toast({
			heading: 'Error',
			text: '{{ session('error') }}',
			position: 'bottom-right',
			stack: 2,
			icon: 'error',
			loader: true,        // Change it to false to disable loader
			loaderBg: '#9EC600'  // To change the background
		})
	</script>
	@php
		session()->forget('error');
	@endphp
@endif
<script>
$(document).ready(function(){
  var pathname = window.location.pathname;
  var pathArray = pathname.split( '/' );
  var slug = pathArray[pathArray.length - 1];
  console.log(pathArray[pathArray.length - 1]);
  var selector = '.sidebar-menu li';
  //$(selector).on('click', function(){
      $(selector).removeClass('active');
      $('#side-'+slug).addClass('active');
  //});
});
</script>
<!-- <script>
  $(document).ready(function(){
    //$(document).on('click','#submit-login',function(){    
    var OneSignal = window.OneSignal || [];
    console.log(OneSignal);
    OneSignal.push(function() {
      OneSignal.getUserId(function(userId) {
      var path={!! json_encode(url('/')) !!}; 
      $.ajax({
        url:path+"/player_id_session",
        method:"POST",
        data:{"_token":"{{ csrf_token() }}","id":userId},
        success:function(data){
        }
      });
    });

    });
    //});
  });
</script>
 -->