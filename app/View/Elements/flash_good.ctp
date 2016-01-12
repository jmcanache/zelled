<div class="container content" style="position: absolute; padding-top: 20px; padding-bottom: 30px">
	<div class="section clearfix">
	    <div class="sixteen columns">
<div class="contenido">
	<div class="notify successbox">
	    <h1 class="setflash good">¡Genial!</h1>
	    <span class="alerticon"><img alt="checkmark" src="http://designshack.net/tutorialexamples/css3-notification-boxes/images/check.png"></span>
	    <p style="text-align: center;"><?php echo $message;?></p>
	</div>
</div>

	    </div>
	</div>
</div>



<script type="text/javascript">
$(document).ready(function(){

	function notify($item)
	{
		$(".contenido").hide();
	}

	$( ".contenido" ).on( "click", notify );

});
</script>