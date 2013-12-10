
timerRunning = false;
var time = 0;
var hours = 0;
var minutes = 0;
var seconds = 0;


$(document).ready(function()
{
	$("#timer_startstop").click(function(){
		timerRunning = !timerRunning;
		if(timerRunning)
		{
			//czas start
			licznik = setInterval("tick()",1000);
			$("#timer_startstop").val("STOP");
		}
		else
		{
			//czas stop
			clearInterval(licznik);
			$.ajax({
						type: "POST",
						url:"save_time.php",
						data: {_time:time,_date:$('#tomorrows_date').html()},
						success:function(result){
							alert(result);
							$("#hours_div").html("");
							$("#minutes_div").html("");
							$("#seconds_div").html("");
							location.reload();
						}
					});
			$("#timer_startstop").val("START");
		}
	});
});

function tick()
{
	++time;
	seconds = time % 60 ;
	minutes = (Math.floor(time / 60)) % 60;
	hours = Math.floor(time / 3600);
	$("#hours_div").html(hours);
	$("#minutes_div").html(minutes);
	$("#seconds_div").html(seconds);
}
