<div class="homepage_content clearfix banner-store animatedParent">
    <div class="container">
      <div class="sixteen columns">
        <div class="section clearfix">
          <h1 class="grey featured_text animated fadeIn">Gestiona tu tienda</h1><br>
          <h2 class="animated fadeIn">¡Edita, configura y administra desde acá!</h2>
        </div>
      </div>
    </div>
</div>

<div class="homepage_content clearfix height-franja-perfil-P">
    <div class="container">     
     <div class="section clearfix" style="padding-left: 70px;"> 
     <div class="five columns" style="margin: 0 auto; text-align:center;">
     <input type="checkbox" id="adminTienda" role="button" class="checkbutton" style="position: absolute;">
      <label for="adminTienda" onclick="">
      <div id="" class="panel-body mint" style="border: 1px solid #d1dee6; border-radius: 15px;padding-top: 15px;width: 300px;box-shadow: 0 0 8px #a7aaa8;color: #109998;">
					<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary" style="color: #109998;"></i> <i class="fa fa-asterisk fa-stack-1x fa-inverse"></i> </span>
					<br>					
    				<!-- <h2 class="font-human" style="font-weight: bold;color: #69388d;">Tienda</h2>  --> 
    					<?php echo $this->Html->link('<h2 class="font-human" style="font-weight: bold;color: #69388d;">Tienda</h2>', array('controller' => 'tiendas', 'action' => 'edit_store_modal', $storeId),
    													 array('escape' => FALSE, 'id'=>'editStorelink', 'data-toggle' =>'modal', 'data-target'=>'#myModalStore', 'style' => 'text-decoration: none;'));?>
						
					<h2 class="text-small font-human" style="font-weight: bold;color:#3d4956;font-size: 18px;">	Configura tu tienda.</h2>				
		</div></label>
      </div>    
       <div class="five columns" style="margin: 0 auto; text-align:center;">
       <input type="checkbox" id="adminProducts" role="button" class="checkbutton" style="position: absolute;">
        <label for="adminProducts" onclick="">
       <div id="" class="panel-body mint" style="border: 1px solid #d1dee6; border-radius: 15px;padding-top: 15px;width: 300px;box-shadow: 0 0 8px #a7aaa8;color: #109998;">
					<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary" style="color: #109998;"></i> <i class="fa fa-tags fa-stack-1x fa-inverse"></i></i> </span>
					<br>
					<!-- <input type="checkbox" id="adminProducts" role="button" class="checkbutton"> -->
    				<!-- <label for="adminProducts" onclick=""> --> <h2 class="font-human" style="font-weight: bold;color: #69388d; cursor: pointer;">Productos</h2><!-- </label> -->  
					<h2 class="text-small font-human" style="font-weight: bold;color:#3d4956;font-size: 18px; cursor: pointer;">	Administra tus Productos.</h2>				
		</div></label>
      </div>
     <div class="five columns" style="margin: 0 auto; text-align:center;">
     <input type="checkbox" id="adminOrders" role="button" class="checkbutton" style="position: absolute;">
     <label for="adminOrders" onclick="">
      <div class="panel-body mint" style="border: 1px solid #d1dee6; border-radius: 15px;padding-top: 15px;width: 300px;box-shadow: 0 0 8px #a7aaa8;color: #109998;">
					<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary" style="color: #109998;"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
	   				<br>
					<?php  
						if(empty($datosbancarios))
				 		{
							echo $this->Html->link('<h2 class="font-human" style="font-weight: bold;color: #69388d;">Datos Bancarios</h2>', array('controller' => 'usuarios', 'action' => 'datos_bancarios_modal'),
	    													 array('escape' => FALSE, 'id'=>'editdatosBancoslink', 'data-toggle' =>'modal', 'data-target'=>'#ModalUsuarioBanco', 'style' => 'text-decoration: none;'));
				 		}
				 		else{
				 			 echo '<h2 class="font-human" style="font-weight: bold;color: #69388d;cursor: pointer;">Datos Bancarios</h2>';
				 		}
						?>
						
					<h2 class="text-small font-human" style="font-weight: bold;color:#3d4956;font-size: 18px;cursor: pointer;">	Gestiona tus Datos.</h2>	
	
		</div></label>
      </div>
    </div>    
  </div>
</div>
 <div class="homepage_content clearfix ">
    <div class="container" style="padding-top: 0px;">
	    <div class="sixteen columns" style="margin: 0 auto;">
        	<div class="section clearfix" style="margin-top: 0px;">
			 <div id="collapse-admin">
			 	<div id="collapse-products" class="hidepanel">
			 		<p id="respuestaUpdate"> </p>
			 		<div id="pagination-container">
			 			<?php echo $this->element('admin_productos', array('data' => $admin_productos));?>
			 		</div>
			 	</div>
			 	<div id="collapse-orders" class="hidepanel">
			 		<?php 
			 		if(!empty($datosbancarios))
			 		{
			 			echo $this->element('admin_datosbancarios', array('data' => $datosbancarios));
			 			//echo $this->element('carga_datos');
			 		}
			 		/*else
					{			 		
			 			echo $this->element('admin_datosbancarios', array('data' => $datosbancarios));
					}*/
			 		?>
			 	</div>			 	
			 </div>			
	        </div>
	      </div>
	 </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalStore" tabindex="-1" role="dialog" aria-labelledby="myModalLabelS" aria-hidden="true" style="background-color: transparent;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" id="myModalBodyS" >
      		
      </div>
     </div>
  </div>
</div>
<div class="modal fade" id="ModalUsuarioBanco" tabindex="-1" role="dialog" aria-labelledby="MyModLabel" aria-hidden="true" style="background-color: transparent;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" id="myModBody" >
      		
      </div>
     </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$(document).on('click', '.ng-scope', function () {	
		var pagHref = $(this).attr('href');
		if (!pagHref) {
			return false;
		}	
		$('#pagination-container').load(pagHref);
		return false;
	});
});
</script>