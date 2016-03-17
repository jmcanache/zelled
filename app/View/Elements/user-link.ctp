<?php 
          if($user_data['Sexo']['es_mujer'] == true)
          {
            $foto_user = 'shape.jpg';
          }
          else
          {
            $foto_user = 'shape.jpg';
          } 
?>          

   <ul class="menu" style="width: 28px; margin-bottom: 0px; position: relative; top: -26px; left: 20px; display: inline-block;">
          
          <li style="width: 228px; margin-bottom: 0px; height: 40px;">
          
          <a href="#cart" class="morado" style="font-size: 22px">
           <?php echo $this->Html->image($foto_user, array('alt' => 'TiviaStore', 'class'=>'profile-pic-round',  'style' => 'width: 40px;height: 40px;'));?>
      		 <span class="css-truncate">
       		 <span class="css-truncate-target" style="padding-bottom: 10px;"> <p class="morado font-KG-Manhattan" style=""> <?php echo $user_data['Usuario']['nombre']?></p></span>
       		</span>
   
          </a>
          
          </li>

   </ul>
         
      
          
     
      