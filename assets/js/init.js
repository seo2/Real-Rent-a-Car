
var desde_el 	= localStorage.getItem('desde_el');
var desde_elh 	= localStorage.getItem('desde_elh');
var hasta_el 	= localStorage.getItem('hasta_el');
var hasta_elh 	= localStorage.getItem('hasta_elh');
var dias  		= localStorage.getItem('dias'); 
var direccion   = localStorage.getItem('direccion'); 
var numero   	= localStorage.getItem('numero'); 
var comuna   	= localStorage.getItem('comuna'); 
var auto   		= localStorage.getItem('auto'); 
var opcional 	= new Array();
var supertotal 	= 0;
var opcional2 	= localStorage.getItem('opcional'); 





console.log('opcional: '+ opcional2);
if(opcional2){
	opcional = JSON.parse("[" + opcional2 + "]");
	$('#btn_continuar').attr('href',"resumen_reserva.php?autoID="+auto+"&opcionales="+opcional2);
}

$('.button-collapse').sideNav();
$('.parallax').parallax();
 $(document).ready(function() {
    $('select').material_select();
  });
            

$('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15,
    today: 'Hoy',
    clear: '',
    close: 'OK',
    format: 'dd/mm/yyyy',
    closeOnSelect: true, 
	monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
	weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
});


$('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Clear', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
});
  
  var owl = $('.owl-carousel');
  owl.owlCarousel({
    margin: 30,
    nav: true,
    navText: [ '', '' ],
	    loop:true,
	    autoplay:true,
	    autoplayTimeout:3000,
	    responsiveClass:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        992:{
            items:4
        }
    }
  });
  
$('.tooltipped').tooltip({delay: 50});

// filter items on button click
$('.modelos_autos li a').on( 'click', function() {
  filtro = $(this).data('filter');
	  console.log(filtro);
  if(filtro == "*"){
	  $('.box_car').show();
  }else{
	  $('.box_car').hide();
	  $('.'+filtro).show();
  }
});

$('#test5').change(function () {
    if ($(this).is(':checked')) {
		$('#entrega').show();	
	}else{
		$('#entrega').hide();	
	}
});

/*
    $('input.autocomplete').autocomplete({
      data: {"Apple": null, "Microsoft": null, "Google": 'http://placehold.it/250x250'},
    }); 
*/

if(direccion!=''){
	$('#direccion_entrega').removeClass('hide');	
}

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}

$('.dias').each(function(i, obj) {
    valor = $(this).data('valor');
    total = valor * dias;
    if(dias==1){
	   losdias 	= ' día $';
	   losdias2 = ' día';
    }else{
	   losdias 	= ' días $'
	   losdias2 = ' días';
    }
    frase = dias + losdias + formatNumber(total);
    $(this).html(frase); 
    $('.supertotal1').html(formatNumber(total));   
    $('.los_dias').html(dias + losdias2);
    
    
    
});

$('.dias2').each(function(i, obj) {
    valor = $(this).data('valor');
    total = valor * dias;
    frase =  formatNumber(total);
    $(this).html(frase);
    supertotal = supertotal + total;
    $('.supertotal').html(formatNumber(supertotal));
    
	$("#fecIni").val(desde_el);
	$("#horIni").val(desde_elh);
	$("#fecFin").val(hasta_el);
	$("#horFin").val(hasta_elh);
	$("#dias").val(dias);
	$("#total").val(total);

});

$('.btn-opcional').each(function(i, obj) {
    opcID = $(this).data('id');
    if(opcional2){
	    var index1 = opcional2.indexOf(opcID);
		if (index1 > -1) {
	    	console.log('opciones: '+opcID);
			$(this).html('Quitar').addClass('btn_white');
		}
    }
});

$('.btn-auto').each(function(i, obj) {
    autoID = $(this).data('auto');
    if(auto==autoID){
		$(this).html('Seleccionado').addClass('btn_white');
    }
});

$('#fecha_desde').html(desde_el + ' ' + desde_elh);
$('#fecha_hasta').html(hasta_el + ' ' + hasta_elh);
$('#desde_el').val(desde_el);
$('#desde_elh').val(desde_elh);
$('#hasta_el').val(hasta_el);
$('#hasta_elh').val(hasta_elh);

$('#formReserva').on("submit", function(e) {
  	e.preventDefault();
  
  	desde_el 	= $('#desde_el').val();
  	desde_elh 	= $('#desde_elh').val();
  	hasta_el 	= $('#hasta_el').val();
  	hasta_elh 	= $('#hasta_elh').val();
  	direccion 	= $('#direccion').val();
  	numero 		= $('#numero').val();
  	comuna 		= $('#comuna').val();
  	
  	desde 		= desde_el + " " + desde_elh + ":00";
  	hasta 		= hasta_el + " " + hasta_elh + ":00";
  	
  	var today 	= new Date();

	dias 		= moment(hasta,"DD/MM/YYYY HH:mm:ss").diff(moment(desde,"DD/MM/YYYY HH:mm:ss"),'days');
	milisec		= moment(hasta,"DD/MM/YYYY HH:mm:ss").diff(moment(desde,"DD/MM/YYYY HH:mm:ss"));
	dias2 		= moment(desde,"DD/MM/YYYY HH:mm:ss").diff(moment(today,"DD/MM/YYYY HH:mm:ss"));

	diferenciadias = milisec - (dias * 86400000);
	if(diferenciadias>10800000){
		dias = dias + 1;
	}
	//console.log(diferenciadias);

/*
  	console.log(desde);
  	console.log(hasta);
*/
  	console.log(dias);
   	console.log(dias2);

  	//return;

  	localStorage.setItem('desde_el', desde_el);
  	localStorage.setItem('desde_elh', desde_elh);
  	localStorage.setItem('hasta_el', hasta_el);
  	localStorage.setItem('hasta_elh', hasta_elh);
  	localStorage.setItem('dias', dias); 	
	localStorage.setItem('direccion', direccion);
	localStorage.setItem('numero', numero);
	localStorage.setItem('comuna', comuna);

	if(desde_el!=''){
		if(hasta_el!=''){
			if(dias>0){
				if(dias2<=10800000){
					Materialize.toast('Debe solicitar el arriendo con al menos 3 horas de anticipación', 4000) // 4000 is the duration of the toast
					error = 1;
				  	return;
				}else{
					
				}				
			}else{
				Materialize.toast('La fecha de inicio debe ser menor a la de término', 4000) // 4000 is the duration of the toast
				error = 1;
			  	return;
			}
		}else{
			Materialize.toast('Debe ingresar fecha de término', 4000) // 4000 is the duration of the toast
			error = 1;
		  	return;
		}		
	}else{
		Materialize.toast('Debe ingresar fecha de inicio', 4000) // 4000 is the duration of the toast
		error = 1;
	  	return;
	}

    if ($('#test5').is(':checked')) {
		localStorage.setItem('domicilio', 1);
		if(direccion!=''){
			if(numero!=''){
				if(comuna!=''){
				}else{
					Materialize.toast('Debe ingresar la cómuna', 4000) // 4000 is the duration of the toast
					error = 1;
				  	return;
				}			
			}else{
				Materialize.toast('Debe ingresar número de dirección', 4000) // 4000 is the duration of the toast
				error = 1;
			  	return;
			}			
		}else{
			Materialize.toast('Debe ingresar dirección de entrega', 4000) // 4000 is the duration of the toast
			error = 1;
		  	return;
		}
	}else{
		localStorage.setItem('domicilio', 0);
	}
  
  	error		= 0;
  
  	if(error==0){  
	  	$('#progreso').removeClass('hide');
	  	window.location.href = "reservar.php";
  	}
});

$('.btn-elegir').on('click', function(){
	auto = $(this).data('auto');
	localStorage.setItem('auto', auto);
	window.location.href = "opcionales.php?autoID="+auto;
});

$('.btn-opcional').on('click', function(){
	idopcional = $(this).data('id');
	if($(this).hasClass('btn_white')){
		$(this).html('Agregar').removeClass('btn_white');
		var index = opcional.indexOf(idopcional);
		if (index > -1) {
		    opcional.splice(index, 1);
		}
	}else{
		$(this).html('Quitar').addClass('btn_white');
		opcional.push(idopcional);
	}	
	$('#btn_continuar').attr('href',"resumen_reserva.php?autoID="+auto+"&opcionales="+opcional);
	localStorage.setItem('opcional', opcional);
	console.log(opcional);
});
//localStorage.removeItem('opcional');

$('.btn-cancel').on('click',function(){
	
});

$('#formFinal').on("submit", function(e) {
  	e.preventDefault();


  	nombre 		= $('#nombre').val();
  	apellido 	= $('#apellido').val();
  	mail 		= $('#mail').val();
  	fono 		= $('#fono').val();
  	
  	error 		= 0;

	if(nombre!=''){
		if(apellido!=''){
			if(mail!=''){
				if(fono!=''){
				
				}else{
					Materialize.toast('Debe ingresar su número de teléfono', 4000) // 4000 is the duration of the toast
					error = 1;
				  	return;
				}				
			}else{
				Materialize.toast('Debe ingresar su correo electrónico', 4000) // 4000 is the duration of the toast
				error = 1;
			  	return;
			}
		}else{
			Materialize.toast('Debe ingresar su apellido', 4000) // 4000 is the duration of the toast
			error = 1;
		  	return;
		}		
	}else{
		Materialize.toast('Debe ingresar su nombre', 4000) // 4000 is the duration of the toast
		error = 1;
	  	return;
	}

  	
  	if(error==0){  
	  	$('#btnArrendar').addClass('hide');
	  	$('#progreso').removeClass('hide');

	    $.ajax({
	    	url:  $('#formFinal').attr('action'),
			type: "POST",
            data: $('#formFinal').serialize(),
            success: function(data) {		   
			    console.log(data);  
			    if(data=='error'){
				    Materialize.toast('Ha ocurrido un error, por favor vuelva a intentarlo.', 4000) // 4000 is the duration of the toast
					error = 1;
				  	$('#btnArrendar').removeClass('hide');
				  	$('#progreso').addClass('hide');
				  	return;
			    }else{
				    
					var url = 'http://' + window.location.hostname;
					cola = 'confirmacion.php?resID='+data;
					window.location = cola; // redirect
			    }   
	    	}
	    });
	}
});


