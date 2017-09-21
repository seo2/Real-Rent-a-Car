
var desde_el 	= localStorage.getItem('desde_el');
var hasta_el 	= localStorage.getItem('hasta_el');
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
console.log(opcional);
$('.button-collapse').sideNav();
$('.parallax').parallax();


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

console.log(dias);

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}

$('.dias').each(function(i, obj) {
    valor = $(this).data('valor');
    total = valor * dias;
    if(dias==1){
	   losdias = ' día $';
	   losdias2 = ' día';
    }else{
	   losdias = ' días $'
	   losdias2 = ' días';
    }
    frase = dias + losdias + formatNumber(total);
    $(this).html(frase);  
    $('.los_dias').html(dias + losdias2);
});

$('.dias2').each(function(i, obj) {
    valor = $(this).data('valor');
    total = valor * dias;
    frase =  formatNumber(total);
    $(this).html(frase);
    supertotal = supertotal + total;
    $('.supertotal').html(formatNumber(supertotal));
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




$('#fecha_desde').html(desde_el);
$('#fecha_hasta').html(hasta_el);
$('#desde_el').val(desde_el);
$('#hasta_el').val(hasta_el);

$('#formReserva').on("submit", function(e) {
  	e.preventDefault();
  
  	desde_el 	= $('#desde_el').val();
  	hasta_el 	= $('#hasta_el').val();
  	direccion 	= $('#direccion').val();
  	numero 		= $('#numero').val();
  	comuna 		= $('#comuna').val();

	dias = moment(hasta_el,"DD/MM/YYYY").diff(moment(desde_el,"DD/MM/YYYY"),'days');

  	localStorage.setItem('desde_el', desde_el);
  	localStorage.setItem('hasta_el', hasta_el);
  	localStorage.setItem('dias', dias); 	
	localStorage.setItem('direccion', direccion);
	localStorage.setItem('numero', numero);
	localStorage.setItem('comuna', comuna);

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
  	
/*
  	if(error==0){  
	  	$('#sbmtbtn').addClass('hide');
	  	$('#progreso').removeClass('hide');
	    var formData = new FormData($('#formOrder')[0]);
	    formData.append("fileselect", cosa);
	    if(traID>0){
	    	formData.append("traID", traID);
	    }

	    $.ajax({
	      url: "wordDensity/result.php",
	      type: "POST",
	      data: formData,
	      contentType: false,
	      dataType: "json",
	      cache: false,
	      processData: false,
	      success: function(data) {		   
		    
		    console.log(data);  
		    if(data.error=='error'){
			    
		    }else{
			    traID 		= data.traId;
			    traWords 	= data.traWords;
			    filename 	= data.traOrFile;
			    traName 	= data.traName;
			    traEmail 	= data.traEmail;
			    traValor	= data.traValor;
			    traFecEnt	= data.traFecEnt;
			    token		= data.token;
			    sessionStorage.setItem("token", token);
			    returnurl 	= 'http://seo2.cl/clientes/wordber/index.php?thanks=1&token='+token;
			    $('#traID').val(traID);
			    $('#price').html('<strong>'+traWords+' words:</strong> US$'+traValor);
			    $('#item_number').val(traID);
			    $('#amount').val(traValor);
			    $('#return').val(returnurl);
			    $('#valorfinal').html(traValor);
			    $('.fecEnt').html(traFecEnt);
			    $('#filename').html(filename);
			    destroydropjs();
			    if(data.traFrom==1){
				    traFrom = 'Spanish';
			    }else if(data.traFrom==2){
				    traFrom = 'French';
			    }else{
				    traFrom = 'English';
			    }
			    $('#from').html(traFrom);
			    if(data.traTo==1){
				    traTo = 'Spanish';
			    }else if(data.traTo==2){
				    traTo = 'French';
			    }else{
				    traTo = 'English';
			    }
			    $('#to').html(traTo);
			    $('#user').html(traName);
			    $('#usermail').html(traEmail);	    
				$('#order').addClass('hide');
				$('#instructions').removeClass('hide');
				$('#progreso').addClass('hide');
				$('#sbmtbtn').removeClass('hide');
		    }

		    
	     }
	    });
	}
*/
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

