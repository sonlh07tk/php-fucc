<script src='snow_js/snowfall.jquery.min.js'>

</script>
<script type='text/javascript'>     

	/* snow-fall for winter
$(document).ready(function(){


			$(document).snowfall({image :"img/snow.png", minSize: 10, maxSize:32});
           
        });*/
</script>
 
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="#"></a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <ul class="nav navbar-nav ">
        <li class="active"><a href="http://fucc16.esy.es">
<img src="http://fucc16.esy.es/img/FCode_NewYear_PNG.png" width = "200px" />

<span class="sr-only">(current)</span></a></li>
        
      </ul>
      
      
      <?php if ($_tmpLogin != 'NO') { ?>
      <ul class="nav navbar-nav">
        <li style="padding-top:15px"><a href="problemset"><strong> <font size="3" style="font-family: 'Cuprum', sans-serif !important;"> PROBLEMSET </font> </strong><span class="sr-only">(current)</span></a></li>
        
      </ul>
      <?php } ?>
      
      <ul class="nav navbar-nav navbar-right">
      	
        <?php if ($_tmpLogin != "NO") { ?>
        	<li style="padding-top:15px"> <a href="submission"> <strong> <font size="3" style="font-family: 'Cuprum', sans-serif !important;"> SUBMISSIONS </font> </strong> </a> </li>
        <?php 
		}
		?>
        
        <?php if ($_tmpLogin != 'NO') { ?>
        <li style="padding-top:15px"><a href="status"> <strong> <font size="3" style="font-family: 'Cuprum', sans-serif !important;"> STATUS </font> </strong> </a></li>
        <?php } ?>
        
		<?php if ($_tmpAdmin == "YES") { ?>
        <li style="padding-top:15px"><a href="addproblem"> <strong> <font size="3" style="font-family: 'Cuprum', sans-serif !important;"> ADD <font color="red"> (ADMIN) </font> </font> </strong> </a></li>
        <?php } ?>
        
        <?php if ($_tmpAdmin == "YES") { ?>
        <li style="padding-top:15px"><a href="judgement"><strong> <font size="3" style="font-family: 'Cuprum', sans-serif !important;"> JUDGE <font color="red"> (ADMIN) </font> </font> </strong> </a></li>
        <?php } ?>
        
        <li style="padding-top:15px"><a href="ranking"><img src="img/hall.PNG" width="20" height="20"/> <strong> <font size="3" style="font-family: 'Cuprum', sans-serif !important;"> HALL OF FAME </font> </strong></a></li>
        
      	  <?php if ($_tmpLogin == "NO") {?>
          		<li style="padding-top:15px"> <a href="http://fucc16.esy.es"> <strong> <font size="3" style="font-family: 'Cuprum', sans-serif !important;"> LOGIN </font> </strong> </a> </li>
          <?php }
		  	else {
		  ?>
        <li style="padding-top:15px" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <font size="4" style="font-family: 'Cuprum', sans-serif !important;"> ACCOUNT </font> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          	<li><a href="profile">Profile</a></li>
            <li class="divider"></li>
            <li><a href="logout">Logout</a></li>
           </ul>
        </li>
        
      	<?php
			}
		?>
      
      </ul>
    </div>
  </div>
 </nav>			