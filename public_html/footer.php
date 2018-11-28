<script>
setInterval(function() {
    var currentTime = new Date ( );    
    var currentHours = currentTime.getHours ( );   
    var currentMinutes = currentTime.getMinutes ( );   
    var currentSeconds = currentTime.getSeconds ( );
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;   
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;    
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";    
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;    
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;    
    var currentTimeString = "Time(GMT+7) : " +  currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
    document.getElementById("timer").innerHTML = currentTimeString;
	}, 1000);
	
</script>

<div class="row">
    <div class="text-center col-md-6 col-md-offset-3">
      <h4><img src="img/foot_lan.jpg" /> </h4>
      <h4 id = "timer"> </h4>
      <p>Copyright &copy; 2016 &middot; All Rights Reserved &middot; <a href="https://www.facebook.com/fcodefpt" > Fanpage F-code </a></p>
    </div>
  </div>
  <hr>