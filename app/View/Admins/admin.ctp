<div class="homepage_content clearfix franja-perfil height-franja-perfil-P">
    <div class="container">     
     <div class="section clearfix" style="padding-left: 70px;">  
     
     <div class="five columns" style="margin: 0 auto; text-align:center;">
      <div id="" class="panel-body mint" style="border: 1px solid #d1dee6; border-radius: 15px;padding-top: 15px;width: 300px;box-shadow: 0 0 8px #a7aaa8;">
					<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-asterisk fa-stack-1x fa-inverse"></i> </span>
					
						<?php echo $this->Html->link('<h2 class="font-human" style="color:#3d4956;">Tienda</h2>', array('controller' => 'tienda', 'action' => 'edit_store_modal'),
    													 array('escape' => FALSE, 'id'=>'editStore', 'data-toggle' =>'modal', 'data-target'=>'#myModalStore'));?>
			
					<!-- <h1 class="font-human" style="color:#3d4956;">Tienda</h1> -->
					<p class="text-small morado" style="font-weight: bold;">
						Configura tu tienda.
					</p>
					<p class="links cl-effect-1">
						<a href="">
							
						</a>
					</p>
		</div>
      </div>    
       <div class="five columns" style="margin: 0 auto; text-align:center;">
       <div id="" class="panel-body mint" style="border: 1px solid #d1dee6; border-radius: 15px;padding-top: 15px;width: 300px;box-shadow: 0 0 8px #a7aaa8;">
					<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-tags fa-stack-1x fa-inverse"></i></i> </span>
					
					<?php echo $this->Html->link('<h2 class="font-human" style="color:#3d4956;">Productos</h2>', array('controller' => 'admins', 'action' => 'admin_productos'),
    													 array('escape' => FALSE, 'id'=>'adminProducts'));?>
					<p class="text-small morado" style="font-weight: bold;">
						Administra tus Productos.
					</p>
					<p class="links cl-effect-1">
						<a href="">
							
						</a>
					</p>
				</div>
      </div>
       <div class="five columns" style="margin: 0 auto; text-align:center;">
      <div class="panel-body mint" style="border: 1px solid #d1dee6; border-radius: 15px;padding-top: 15px;width: 300px;box-shadow: 0 0 8px #a7aaa8;">
					<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
					
					<?php echo $this->Html->link('<h2 class="font-human" style="color:#3d4956;">Pedidos</h2>', array('controller' => 'admins', 'action' => 'admin_orders'),
    													 array('escape' => FALSE, 'id'=>'adminOrders'));?>
				
					<p class="text-small morado" style="font-weight: bold;">
						Gestiona tus Pedidos.
					</p>
					<p class="links cl-effect-1">
						<a href="">
							
						</a>
					</p>
		</div>
      </div>
        </div>    
	    </div>	    
	  </div>
 <div class="homepage_content clearfix">
    <div class="container" style="padding-top: 0px;">
	    <div class="sixteen columns" style="margin: 0 auto;">
        <div class="section clearfix" style="margin-top: 0px;">
			 <div id="collapse-admin">
			 	<?php   ?>
			 </div>
			
	        </div>
	      </div>
	 </div>
</div>

	  <!-- Modal -->
<div class="modal fade" id="myModalStore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: transparent;">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-body" id="myModalBody" >      
      </div>
    </div>
  </div>
</div>