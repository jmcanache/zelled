<div class="container content" style="position: absolute; padding-top: 20px; padding-bottom: 30px">
	<div class="section clearfix">
	    <div class="sixteen columns">
<div class="contenido">
	<div class="notify successbox">
	   <!--   <h1 class="setflash good">Â¡Confirma!</h1>
	   <div class="close"><span class="fa fa-times" style="padding-left: 10px;"></span></div>-->
	    <!--  <span class="alerticon"><img alt="checkmark" src="http://designshack.net/tutorialexamples/css3-notification-boxes/images/check.png"></span>-->
	    <p style="text-align: center;">Â<?php echo $message;?></p>
		<?php	echo $this->Html->link('<p class="btn btn-flat btn-success style="text-align: center;"><span class="fa fa-check"></span>Si</p>', array('controller' => 'carritos', 'action' => 'flash_response',true),
    													 array('escape' => FALSE, 'id'=>'flashElementYes'));?>
	
		
		<?php	echo $this->Html->link('<p class="btn btn-flat btn-default style="text-align: center;"><span class="fa fa-check"></span>No</p>', array('controller' => 'carritos', 'action' => 'flash_response',FALSE),
    													 array('escape' => FALSE, 'id'=>'flashElementNo'));?>
	    </p>
		
	</div>	
</div>

	    </div>
	</div>
</div>