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