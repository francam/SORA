<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>index</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<script src="https://cdn.dashjs.org/latest/dash.all.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<header>
		<h1>SORA v2</h1>
		<div class = "disconnect_button">
			<h1>DISCONNECT</h1>
		</div>
	</header>
	<main>
		<div class = "status_bar">
		</div>
		<div class="videobox">
			<video data-dashjs-player autoplay src="http://localhost:8080" type="video/webm" codec="vp8.0" controls>
			</video>
		</div>
		<div class="collect_button">
			<h1>COLLECT MODE</h1>
		</div>
		<div class="detect_button">
		  <h1>DETECT MODE</h1>
		</div>
	</main>
	<footer>
	</footer>


	<script>
		$(document).ready(function(){

			var counter = 0;
			var start_switch = 0;

			//Resets the Motors
			$(".disconnect_button").on("click", function(){
				$.ajax({
					type 		: 'POST',
					url 		: 'UDPClient.php',
					data 		: {'name':'d'},
					dataType 	: 'json',
				});
			});

			//Starts Collect Mode
			$(".collect_button").on("click", function() {
				$(this).animate({width: '98%'});

				if (counter<=0){
					$(this).append('<div class="collect_close"><img src="images/x_red.png" height="25" width="25"></div>');
					$(this).append('<div class="start_stop" id="start">START</div>');

					counter++;
				}

				$(".collect_button h1").animate({
					fontSize: '15px',
					paddingTop: '0px'
				});
				$(".detect_button").hide(100);

			});


			// START / STOP Collect Mode
			$(document).on('click', '.start_stop' , function(event) {
				var str = document.getElementById("start").innerHTML;
				if (start_switch == 0){
					var res = str.replace("START", "STOP");
					document.getElementById("start").innerHTML = res;

					$.ajax({
						type 		: 'POST',
						url 		: 'UDPClient.php',
						data 		: {'name':'colon'},
						dataType 	: 'json',
					});

					start_switch = 1;
				} else {
					var res = str.replace("STOP", "START");
					document.getElementById("start").innerHTML = res;

					$.ajax({
						type 		: 'POST',
						url 		: 'UDPClient.php',
						data 		: {'name':'coloff'},
						dataType 	: 'json',
					});

					start_switch = 0;
				}
			});


			// Exits Collect Mode
			$(document).on('click', '.collect_close' , function(event) {
				event.stopPropagation();
				counter = 0;
				$(".collect_button h1").animate({
					fontSize: '40px',
					paddingTop: 'auto'
				});

				//stop the collect mode
				$(".collect_button").animate({width: '48%'} , function(){
					$(".detect_button").show();
					$('.collect_close').remove();
					$('.start_stop').hide(100);
					$('.start_stop').remove();
				});
			});


			// Start Detect Mode
			$(".detect_button").on("click", function() {
				$(this).animate({width: '98%'});

				if (counter<=0){
					$(this).append('<div class="detect_close"><img src="images/x_green.png" height="25" width="25"></div>');
					$(this).append('<div class="dir_up"><i class="fa fa-chevron-circle-up"></i></div>');
					$(this).append('<div class="dir_down"><i class="fa fa-chevron-circle-down"></i></div>');
					$(this).append('<div class="dir_left"><i class="fa fa-chevron-circle-left"></i></div>');
					$(this).append('<div class="dir_right"><i class="fa fa-chevron-circle-right"></i></div>');

					$.ajax({
						type 		: 'POST',
						url 		: 'UDPClient.php',
						data 		: {'name':'deton'},
						dataType 	: 'json',
					});

					counter++;
				}

				$(".detect_button h1").animate({
					fontSize: '15px',
					paddingTop: '0px'
				});
				$(".collect_button").hide(100);
			});

			//Sends commands for the four directional arrows
			$(document).on('click', '.dir_up' , function(event){
				$.ajax({
					type 		: 'POST',
					url 		: 'UDPClient.php',
					data 		: {'name':'y+100'},
					dataType 	: 'json',
				});
			});

			$(document).on('click', '.dir_down' , function(event){
				$.ajax({
					type 		: 'POST',
					url 		: 'UDPClient.php',
					data 		: {'name':'y-100'},
					dataType 	: 'json',
				});
			});

			$(document).on('click', '.dir_left' , function(event){
				$.ajax({
					type 		: 'POST',
					url 		: 'UDPClient.php',
					data 		: {'name':'x-100'},
					dataType 	: 'json',
				});
			});

			$(document).on('click', '.dir_right' , function(event){
				$.ajax({
					type 		: 'POST',
					url 		: 'UDPClient.php',
					data 		: {'name':'x+100'},
					dataType 	: 'json',
				});
			});


			//Stop Detect Mode
			$(document).on('click', '.detect_close' , function(event) {
				event.stopPropagation();
				counter = 0;
				$(".detect_button h1").animate({
					fontSize: '40px',
					paddingTop: 'auto'
				});

				$.ajax({
					type 		: 'POST',
					url 		: 'UDPClient.php',
					data 		: {'name':'detoff'},
					dataType 	: 'json',
				});

				$(".detect_button").animate({width: '48%'} , function(){
					$(".collect_button").show();
					$('.detect_close').remove();
					$('.dir_up').remove();
					$('.dir_down').remove();
					$('.dir_right').remove();
					$('.dir_left').remove();
				});
			});
		});
	</script>

</body>
</html>
