(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.parallax').parallax();

  }); // end of document ready
})(jQuery); // end of jQuery name space


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
    $('input.autocomplete').autocomplete({
      data: {"Apple": null, "Microsoft": null, "Google": 'http://placehold.it/250x250'},
    });/*



  $('input.autocomplete').autocomplete({
    data: {
	<?php
		$categorias = $db->rawQuery("select * from comuna where comuna_provincia_id >=130 and comuna_provincia_id < 140");
		if($categorias){
			foreach ($categorias as $p) {
				
				echo "'".addslashes($p['comuna_nombre'])."': null,";
			}
		}  	
	  
		  ?>	    
    },
    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
    onAutocomplete: function(val) {
      // Callback function when value is autcompleted.
    },
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
  });
*/