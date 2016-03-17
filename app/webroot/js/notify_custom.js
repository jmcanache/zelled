function notifySuccess() { //success
	 $.notify(
		     {
		     	icon: "fa fa-check-circle-o",
		     	title: '<strong>Completado!</strong>',
		     	message: " Los datos han sido actualizados!"
			 },
		     {
			    type: "success",
			    newest_on_top: true,
		     	offset: 100,
		     	delay: 1000,
		    	
		     	placement: {
					from: "top",
					align: "center"
				},
				animate: {
					enter: 'animated fadeInDown',
					exit: 'animated fadeOutUp'
				},
				template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
				'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">'+  '&times;' + '</button>' +
				'<img data-notify="icon" class="img-circle pull-left">' +
				'<h2 style="text-align:center;" data-notify="title">{1}</h2>' +
				'<p style="text-align:center;"><span><img alt="checkmark" src="http://designshack.net/tutorialexamples/css3-notification-boxes/images/check.png"></span></p>' +
				'<p style="text-align:center;" data-notify="message">{2}</p>' +
				'</div>'

		     });
}

function notifySuccessDel() { //success
	 $.notify(
		     {
		     	icon: "fa fa-check-circle-o",
		     	title: '<strong>Completado!</strong>',
		     	message: " El registro ha sido eliminado!"
			 },
		     {
			    type: "success",
			    newest_on_top: true,
		     	offset: 100,
		     	placement: {
					from: "top",
					align: "center"
				},
				animate: {
					enter: 'animated fadeInDown',
					exit: 'animated fadeOutUp'
				},
				template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
				'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">'+  '&times;' + '</button>' +
				'<img data-notify="icon" class="img-circle pull-left">' +
				'<h2 style="text-align:center;" data-notify="title">{1}</h2>' +
				'<p style="text-align:center;"><span><img alt="checkmark" src="http://designshack.net/tutorialexamples/css3-notification-boxes/images/check.png"></span></p>' +
				'<p style="text-align:center;" data-notify="message">{2}</p>' +
				'</div>'

		     });
}

function notifyError() { //error
	 $.notify(
		     {
		     	icon: "fa fa-check-circle-o",
		     	title: '<strong>Atenci\u00F3n!</strong>',
		     	message: " No es posible realizar la operaci\u00F3n en este momento!"
			 },
		     {
			    type: "warning",
			    newest_on_top: true,
		     	offset: 100,
		     	placement: {
					from: "top",
					align: "center"
				},
				animate: {
					enter: 'animated fadeInDown',
					exit: 'animated fadeOutUp'
				},
				template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
				'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">'+  '&times;' + '</button>' +
				'<img data-notify="icon" class="img-circle pull-left">' +
				'<h2 style="text-align:center;" data-notify="title">{1}</h2>' +
				'<p style="text-align:center;"><span><img alt="checkmark" src="http://designshack.net/tutorialexamples/css3-notification-boxes/images/error.png"></span></p>' +
				'<p style="text-align:center;" data-notify="message">{2}</p>' +
				'</div>'

		     });
}

function notifyConfirm() { //confirm
	 $.notify(
		     {
		     	icon: "fa fa-check-circle-o",
		     	title: ' ',
		     	message: "¿Esta seguro desea eliminar el registro?"
			 },
		     {
			    type: 'info',
			    allow_dismiss: false,
			    newest_on_top: true,
		     	offset: 100,
		     	placement: {
					from: "top",
					align: "center"
				},
				animate: {
					enter: 'animated fadeInDown',
					exit: 'animated fadeOutUp'
				},
				template: '<div id="confirm" data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
				'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">'+  '&times;' + '</button>' +
				'<img data-notify="icon" class="img-circle pull-left">' +
				'<h2 style="text-align:center;" data-notify="title">{1}</h2>' +
				'<p style="text-align:center;"><span><img alt="checkmark" src="../../../img/question.png"></span></p>' +
				'<p style="text-align:center;" data-notify="message">{2}</p>' +
				'<p style="text-align:right;"> <button type="button" data-dismiss="modal" class="btn btn-info" data-value="1">Eliminar</button> ' +
				'<button type="button" data-dismiss="modal" class="btn btn-info" data-value="0">Cancelar</button> </p>'+
				'</div>'
	 });
}

function notifyInfo(msg) { //info
	 $.notify(
		     {
		     	icon: "fa fa-check-circle-o",
		     	title: '<strong>Atenci\u00F3n!</strong>',
		     	message: msg
			 },
		     {
			    type: "info",
			    newest_on_top: true,
		     	offset: 100,
		     	placement: {
					from: "top",
					align: "center"
				},
				animate: {
					enter: 'animated fadeInDown',
					exit: 'animated fadeOutUp'
				},
				template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
				'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">'+  '&times;' + '</button>' +
				'<img data-notify="icon" class="img-circle pull-left">' +
				'<h2 style="text-align:center;" data-notify="title">{1}</h2>' +
				'<p style="text-align:center;"><span><img alt="checkmark" src="../../../img/alert.png"></span></p>' +
				'<p style="text-align:center;" data-notify="message">{2}</p>' +
				'</div>'

		     });
}

function notifyAddtocart(msg) { //notifica cuando agregan producto a la cesta
	$.notify(
		     {
		     	icon: "fa fa-check-circle-o",
		     	title: '<strong>¡Genial!</strong>',
		     	message: msg
			 },
		     {
			    type: "info",
			    newest_on_top: true,
		     	offset: 100,
		     	placement: {
					from: "top",
					align: "center"
				},
				animate: {
					enter: 'animated fadeInDown',
					exit: 'animated fadeOutUp'
				},
				template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
				'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">'+  '&times;' + '</button>' +
				'<img data-notify="icon" class="img-circle pull-left">' +
				'<h2 style="text-align:center;" data-notify="title">{1}</h2>' +
				'<p style="text-align:center;"><span><img alt="checkmark" src="http://designshack.net/tutorialexamples/css3-notification-boxes/images/check.png"></span></p>' +
				'<p style="text-align:center;" data-notify="message">{2}</p>' +
				'</div>'

		     });
}

function notifySuccessMsg(msg) { //success
	 $.notify(
		     {
		     	icon: "fa fa-check-circle-o",
		     	title: '<strong>¡Genial!</strong>',
		     	message: msg
			 },
		     {
			    type: "success",
			    newest_on_top: true,
		     	offset: 100,
		     	delay: 1000,
		    	
		     	placement: {
					from: "top",
					align: "center"
				},
				animate: {
					enter: 'animated fadeInDown',
					exit: 'animated fadeOutUp'
				},
				template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
				'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">'+  '&times;' + '</button>' +
				'<img data-notify="icon" class="img-circle pull-left">' +
				'<h2 style="text-align:center;" data-notify="title">{1}</h2>' +
				'<p style="text-align:center;"><span><img alt="checkmark" src="http://designshack.net/tutorialexamples/css3-notification-boxes/images/check.png"></span></p>' +
				'<p style="text-align:center;" data-notify="message">{2}</p>' +
				'</div>'

		     });
}