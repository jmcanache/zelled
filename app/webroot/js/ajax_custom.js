$(document).ready(function() { //accion me gusta en product_detail
	$('#heartElement').bind('click', function(){    	
		$.ajax({
			type: "POST",
			url: $(this).attr('href'),
			dataType:"json", 
		    success:function (data) {			    					    
		    		$("#success").html(data.CantLikes + ' me gusta');
		    		$("#countLikes").html(data.CantLikes);	
		    		if(data.Clase == 'likered') {
		    			$('#heart').removeClass('notlike_button').addClass(data.Clase);		    				    			
		    		}
		    		else if(data.Clase == 'notlike_button') {
		    			$('#heart').removeClass('likered').addClass(data.Clase);	    			
		    		}		    
			},
			error: function () {
			     alert('Por favor inicia sesi\u00F3n o reg\u00EDstrate.');	/*agregar estilo*/		     
			}
			});
		return false;   	
	});
});

$(document).ready(function() { //accion me gusta en products o inspiracion cuando hay mas de un producto
	$('[id^=heartElementA]').each(function(){
		$(this).click(function(){ 
		var heartElement = $(this).children('.fa-heart').attr('id');
		var likesElement = $(this).children('.likeCount').attr('id');		  
	          $.ajax({
				type: "GET",
				url: $(this).attr('href'),
				dataType:"json", 
			    success:function (data) { 		    			     
			    	       	if(data.Clase == 'likered') {
			    	       		$('#'+heartElement).addClass('likered');		    				    			
			    	       	}
			    	       	else if(data.Clase == 'notlike_button') {
			    	       		$('#'+heartElement).removeClass('likered');	    			
			    	       	}	    	        	 
		    	       		$('#'+likesElement).html(data.CantLikes); 	
			    },
				error: function () {
				     alert('Por favor inicia sesi\u00F3n o reg\u00EDstrate.');			     
				}		 			    	 
				});
	        	return false;	
	   });
	});  
});

$(document).ready(function() {
    $('#compraForm').submit(function(){
             //serialize form data
            var formData = $(this).serialize();
            //get form action
            var formUrl = $(this).attr('action');
            $.ajax({
                type: 'POST',
                url: formUrl,
                data: formData,
                success: function(data,textStatus,xhr){
                    $('#carrito').html(data);
                    notifyAddtocart("Añadimos el producto a tu cesta");                        
                },
                error: function(xhr,textStatus,error){
                        
                }
            });	               
            return false;
    });
}); 
/* no se esta usando*/
$(document).ready(function() {
	$('[id^=checkoutElement]').each(function(){
		$(this).click(function(){ 
			var chk = $(this).children('.fa-check-square').attr('id');
			$.ajax({
				type: "POST",
				url: $(this).attr('href'),			 
			    success:function (data) {			    					    
			    		$('#'+chk).removeClass('mint').addClass('morado');		    		    
				},
				error: function () {
				    	     
				}
				});
			return false;   
		 });
	});	
}); ////////////////////////////

$(document).ready(function() { //incluye elemento checked a sesion checkout o nombre de sesion que trae $(this).attr('value')
	$('[name^=check]').each(function(){
		$(this).click(function(){ 	
			var chk = $(this).attr('id');		
			var res = chk.replace("check", ""); // de esta manera se obtiene el id del input numerico (checkX - check = X)
			 if(this.checked) {				 
	                $('#'+chk).prop('checked', true);
	                $('#'+res).attr("readonly", true); 
	            	$.ajax({
	    				type: "POST",
	    				url:"../../carritos/checkout_cart/"+$(this).attr('value') ,			 
	    			    success:function (data) {			    					    
	    			    	 $('#'+chk).prop('checked', true);  		    		    
	    				},
	    				error: function () {
	    					 $('#'+chk).prop('checked', false);	     
	    				}
	    			});	          
	          }else{	        	 
	        	   $('#'+chk).prop('checked', false);
	        	   $('#'+res).attr("readonly", false); 
	        	   $.ajax({
	    				type: "POST",
	    				url:"../../carritos/remove/"+$(this).attr('value'),			 
	    			    success:function (data) {			    					    
	    			    	 $('#'+chk).prop('checked', false);  		    		    
	    				},
	    				error: function () {
	    					 $('#'+chk).prop('checked', true);	     
	    				}
	    			});	 
	          }				
		 });
	});	
});

$(document).ready(function() { //incluye todos los elementos a sesion checkout o nombre de sesion que trae $(this).attr('value')
    $('#checkoutall').click(function(event) {    	
        if(this.checked) { 
        	$(this).prop('checked', true);
            $('.checkout_check').each(function() { 
            	this.checked = true;
				var res = $(this).attr('id').replace("check", ""); // se obtiene el id del input numerico
            	$.ajax({
    				type: "POST",
    				url:"../../carritos/checkout_cart/"+$(this).attr('value') ,			 
    			    success:function (data) {			    					    
    			    	$(this).checked = true;  
    			    	$('#'+res).attr("readonly", true);      		    		    
    				},
    				error: function () {
    					$(this).checked = false; 
    					$('#'+res).attr("readonly", false); 	     
    				}
    			});
           });
        }else{ 
        	$(this).prop('checked', false);
            $('.checkout_check').each(function() {
            	var res = $(this).attr('id').replace("check", ""); // se obtiene el id del input numerico
     			$('#'+res).attr("readonly", false); 	     
                this.checked = false;                   
            }); 
            removeallCheckout();         
        }
     });
   
});

$(document).ready(function() { //actualizar subtotal en carrito
	$('[name^=quantity]').each(function(){
		$(this).bind("change paste keyup", function(){ 	
					var idElement = $(this).attr('id');				
					var subT = parseFloat($(this).val())* parseFloat($('#precio'+idElement).text());					
					$("#subtotal"+idElement).text(subT.toFixed(2));	
					$("#subtotalH"+idElement).text(subT.toFixed(2));		
					total();	
					$.ajax({ //actualizar la session actual en caso que el usuario cambie la cantidad
	    				type: "POST",
	    				url:"../../carritos/update_cart/"+$('#productId'+idElement).text()+'/'+'cart'+'/'+$(this).val(),			 
	    			    success:function (data) {			    					    
	    			    	    		    
	    				},
	    				error: function () {
	    					 	     
	    				}
	    			});					
		 });		
	});	
});


function total() { //actualizar total en carrito
	var total = 0;
	$('.subtotal').each(function() {
		//alert($(this).text());
		total += parseFloat($(this).text());
	});
	$('#Gtotal').html(total.toFixed(2));	
}

//courier checked all
$(document).ready(function() {
    $('#TiendaCouriers7').click(function(event) {    	
        if(this.checked) {        	
            $('[id^=TiendaCouriers]').each(function() { 
            	this.checked = true; 
            	$(this).attr("disabled", true);
           });
            $('#TiendaCouriers7').removeAttr("disabled"); 
        }else{        	
            $('[id^=TiendaCouriers]').each(function() { 
                this.checked = false;
                $(this).removeAttr("disabled");
            });        
        }
     });
   
});


$(document).ready(function() { //remover elemento de sesion cart o nombre de sesion que trae $(this).attr('href')
	$('[id^=removeElement]').each(function(){
		$(this).click(function(){ 				
			var removElement = $(this).children('.fa-trash-o').attr('id');		
			var url = $(this).attr('href');			
	        	   $.ajax({
	    				type: "POST",
	    				url: url,			 
	    			    success:function (data) {	
	    			    	 $('#carrito').html(data);
	    			    	 $('#'+removElement).closest('tr').remove();
	    			    	 total();
	    			    	 removeCheckout(url);
	    				},
	    				error: function () {
	    						     
	    				}
	    			});
	        	   return false;  			
		 });
	});	
});

/*$(document).ready(function() { //remover todos los elementos a sesion cart
    $('#removeall').click(function(event) {  	   
        	    $.ajax({
    				type: "POST",
    				url: "../../carritos/removeall",			 
    			    success:function (data) {			    					    
    			    	//$('#carrito').html(data);
    			    	//$('.table > tbody > tr').remove();  
    			    	//removeallCheckout();
    				},
    				error: function () {
    					     
    				}
    			});        	   
        	    return false;
     });   
});*/

function removeallCheckout() { //funcion que borra sesion checkout
	 $.ajax({
			type: "POST",
			url: "../../carritos/removeall/checkout",			 
		    success:function (data) {			    					    
		    	      		    		    
			},
			error: function () {
				     
			}
		});
}

function removeCheckout(url) { //funcion que borra elemento sesion checkout
		$.ajax({
			type: "POST",
			url: url.replace('checkout', 'cart'),			 
		    success:function (data) {			    					    
		    	$('#carrito').html(data);	      		    		    
			},
			error: function () {
				     
			}
		}); 
   }

$(document).ready(function() { //accion me gusta en product_detail
	$('[id^=flashElement]').bind('click', function(){    	
		//alert("h");
		$.ajax({
			type: "POST",
			url: $(this).attr('href'),
			dataType:"json", 
		    success:function (data) {			    					    
		    	$('.contenido').hide();	 
		    	window.location.replace("../../carritos/seguir_comprando");
			},
			error: function () {
				$('.contenido').hide();	     
			}
		});
		return false;   	
	});
});

$(document).ready(function() { //admin panel productos
	$('[id^=adminProducts]').bind('click', function(){		
		 if(this.checked) {	
			 if($('#collapse-admin').is(':hidden')) {
				 $('#collapse-admin').show();				
			 }	
			 if($('#collapse-orders').is(':visible')) {
				 $('#collapse-orders').hide();
				 $('#adminOrders').prop('checked', false);
			 }			
			 $('#collapse-products').show();
			 $('#collapse-products').removeClass('hidepanel').addClass('showpanel');
		 }else{
			 $('#collapse-products').hide();
		 }
		  	
	});
});

$(document).ready(function() { //admin panel pedidos
	$('[id^=adminOrders]').bind('click', function(){  	
		 if(this.checked) {	
			 if($('#collapse-admin').is(':hidden')) {
				 $('#collapse-admin').show();				
			 }	
			 if($('#collapse-products').is(':visible')) {
				 $('#collapse-products').hide();
				 $('#adminProducts').prop('checked', false);
			 }				
			 $('#collapse-orders').show();
			 $('#collapse-orders').removeClass('hidepanel').addClass('showpanel');
		 }else{
			 $('#collapse-orders').hide();
		 }
	});
});

$(document).ready(function() { //admin panel tienda
	$('[id^=adminTienda]').bind('click', function(){ 	
			 $('#collapse-admin').hide();
			 $('#adminProducts').prop('checked', false);
			 $('#adminOrders').prop('checked', false);	
			 				
	});
});

/*$(document).ready(function() { //cargar datos del producto en modal para modificar
	$('#myModalBody').modal('remote');
});*/
$(document).ready(function() { //eliminar producto admin panel
	$('[id^=deleteProduct]').bind('click', function(){ 	 
		var dir = $(this).attr('href');
		notifyConfirm();
		 $('#confirm').one('click', '[data-value]', function (e) {
		         if($(this).data('value')) { //si respuesta en dialogo es eliminar
		        	 $('#confirm').hide();
		        	 $.ajax({
		     			type: "POST",
		     			url: dir,			
		     		    success:function (data) {	
		     		    	$('#productosTienda').html(data);
		     		    	notifySuccessDel();
		     			},
		     			error: function () {
		     				notifyError();		     
		     			}
		     			});
		         } else {
		        	 $('#confirm').hide();   
		         }
		});
		
		return false;   
	 });   
});

$(document).ready(function() { //eliminar producto admin panel
	$('[id^=deleteDatosBancoslink]').bind('click', function(){ 	 
		var dir = $(this).attr('href');
		notifyConfirm();
		 $('#confirm').one('click', '[data-value]', function (e) {
		         if($(this).data('value')) { //si respuesta en dialogo es eliminar
		        	 $('#confirm').hide();
		        	 $.ajax({
		     			type: "POST",
		     			url: dir,			
		     		    success:function (data) {	
		     		    	var datosbancarios = data; 	 	     	  	 	 	     	
		     	     		$('#InfoBancaria').html(datosbancarios); 		     		    	
		     		    	notifySuccessDel();
		     			},
		     			error: function () {
		     				notifyError();		     
		     			}
		     			});
		         } else {
		        	 $('#confirm').hide();   
		         }
		});
		
		return false;   
	 });   
});