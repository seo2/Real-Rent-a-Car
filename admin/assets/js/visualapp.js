var url 	= 'http://dev.iscrmktg.com/';
var uploads = url + 'ajax/uploads/';

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}

$('.checkbox-inline input').change(function () {
	temita = $(this).attr('id');
	console.log(temita);
    if ($('#'+temita).is(':checked')) {
	console.log('show');

		$(this).closest('div').find('i').fadeIn();
		$(this).closest('label').removeClass('sombra');
	
	}else{
	console.log('hide');
		$(this).closest('div').find('i').hide();
		$(this).closest('label').addClass('sombra');
		
	}
});

FormValidation.Validator.password = {
    validate: function(validator, $field, options) {
        var value = $field.val();
        if (value === '') {
            return true;
        }

        if (value.length < 8) {
            return false;
        }
        if (value === value.toLowerCase()) {
            return false;
        }
        if (value === value.toUpperCase()) {
            return false;
        }
        if (value.search(/[0-9]/) < 0) {
            return false;
        }

        return true;
    }
};

FormValidation.Validator.securePassword = {
    validate: function(validator, $field, options) {
        var value = $field.val();
        if (value === '') {
            return true;
        }

        // Check the password strength
        if (value.length < 6) {
            return {
                valid: false,
                message: 'Debe tener al menos 6 caracteres.'
            };
        }


        return true;
    }
};

$('#formUsuario')
        .formValidation({
	        framework: 'bootstrap',
	        excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
		        usuPass2: {
		            validators: {
		                identical: {
		                    field: 'usuPass',
		                    message: 'La contraseña no coincide'
		                }
		            }
		        },
                usuMail: {
                    validMessage: 'Con este e-mail entrarás a la plataforma',
                    validators: {
                        notEmpty: {
                            message: 'Debes ingresar un email'
                        },
                        emailAddress: {
	                        message: 'Debes ingresar un email valido'
	                    }
                    }
                }
            },
			locale: 'es_ES'
        })
        .on('success.field.fv', function(e, data) {
            var field  = data.field,        // Get the field name
                $field = data.element;      // Get the field element

            // Show the valid message element
            $field.next('.validMessage[data-field="' + field + '"]').show();
        })
        .on('err.field.fv', function(e, data) {
            var field  = data.field,        // Get the field name
                $field = data.element;      // Get the field element

            $field.next('.validMessage[data-field="' + field + '"]').hide();
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formUsuario');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(data) {
                    console.log(data);
			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado el usuario.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otro",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado  el usuario.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');

 
                }
            });
        });    

$('#formCambiar')
        .formValidation({
	        framework: 'bootstrap',
	        excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
		        usuPass2: {
		            validators: {
		                identical: {
		                    field: 'usuPass',
		                    message: 'La contraseña no coincide'
		                }
		            }
		        }
            },
			locale: 'es_ES'
        })
        .on('success.field.fv', function(e, data) {
            var field  = data.field,        // Get the field name
                $field = data.element;      // Get the field element

            // Show the valid message element
            $field.next('.validMessage[data-field="' + field + '"]').show();
        })
        .on('err.field.fv', function(e, data) {
            var field  = data.field,        // Get the field name
                $field = data.element;      // Get the field element

            $field.next('.validMessage[data-field="' + field + '"]').hide();
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formUsuario');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(data) {
                    console.log(data);
			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha cambiado la contraseña.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();   
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
					}else{
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar'); 
                    
                }
            });
        });    


$('#formLogin')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    validMessage: 'OK',
                    validators: {
                        notEmpty: {
                            message: 'Debes ingresar un nombre de usuario'
                        }
                    }
                },
                password: {
                    validMessage: 'OK!',
                    validators: {
                        notEmpty: {
                            message: 'Debes ingresar una contraseña'
                        }
                    }
                }
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');

            // Do whatever you want here ...
			
			$('#btnLogin').html('Conectando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(result) { 
                    console.log(result);
                    if(result=='ok'){
                    	window.location.href='home.php';
                    }else{
	                    $('#error').show();
	                    $('#formLogin')[0].reset();
						$('#btnLogin').html('Ingresar <i class="fa fa fa-chevron-right"></i>');
                    }
                }
            });


            // Then submit the form as usual
            //fv.defaultSubmit();
        });    
        

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#fotoperfil').attr('src', e.target.result);
            $('#nofoto').hide();
            $('#fotito').fadeIn();
        }

        reader.readAsDataURL(input.files[0]);
    }
}

	
$("#uploadFoto").change(function(){
    readURL(this);
});
         
  
function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#fotoperfil3').attr('src', e.target.result);
            $('#fotito2').fadeIn();
        }

        reader.readAsDataURL(input.files[0]);
    }
}

	
$("#uploadFoto2").change(function(){
    readURL2(this);
});
         


// LEVANTAR MODAL DE ITEM:

$('a.subefoto').click(function(){
	$('#myModal').modal('show');
	
	itemID 		= $(this).data('itemid');
	itemrow     = '#item-'+itemID;
	
	ptdItem 	= $(this).data('ptditem');
	itemNom 	= $(itemrow).data('nom');
	itemFoto    = $(itemrow).data('foto');
	itemCom		= $(itemrow).data('com');
	
	console.log('Item: '+ptdItem);
	
	$('#myModal h3').html(itemNom);
	$('#ptdItem').val(ptdItem);
	$('#argTxt').val(itemCom);
	
	if(itemFoto){
		$('#fotito img').attr('src',uploads+itemFoto);
		$('#fotito').show();
		$('#subefoto').html('<i class="fa fa-camera"></i> Cambiar');
	}else{
		$('#fotito img').attr('src','');
		$('#fotito').hide();
		$('#subefoto').html('<i class="fa fa-camera"></i> Subir');
	}
	
});

$('a#logoutBtn').on('click', function() {
	swal({   title: "¿Seguro?",   text: "Cerrará la sesión.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#bc1c1c",   confirmButtonText: "Salir",    cancelButtonText: "Cancelar",  closeOnConfirm: false }, 
		function(){  	
		$('#logoutBtn').html(' <i class="fa fa fa-spinner fa-spin"></i> Saliendo');
		var url = "logout.php";
		$.ajax({
	       type: "POST",
	       url: url,
	        success: function(data) {
				console.log(data);
				if(data == "logout") {
					window.location.replace('index.php');
				}else{
					swal('Ha ocurrido un error, por favor vuelva a intentarlo.');
				}
	        }
	    });
    });
});

$(".opcID").bind("change", function() {
	sumaLosDias();
});	

$("#catID2").bind("change", function() {
	catID   = $(this).val();
	fecIni  = $('#fecIni').val();
	horIni  = $('#horIni').val();
	fecFin  = $('#fecFin').val();
	horFin  = $('#horFin').val();
    GetOpciones(catID,fecIni,horIni,fecFin,horFin);
});	

function GetOpciones(catID,fecIni,horIni,fecFin,horFin) {
  if (catID > 0) {
        $("#resAuto").get(0).options.length = 0;
        $("#resAuto").get(0).options[0] = new Option("Cargando Opciones...", "-1"); 
		
 	    $.ajax({
            type: "POST",
            url: "ajax/autos.php",
            data: { "catID": catID ,"fecIni":fecIni,"horIni":horIni,"fecFin":fecFin,"horFin":horFin},
			success: function(msg) {
	            console.log(msg);
				if(msg.opciones){
					total = msg.opciones.length;
					console.log('Total: '+total);
	                $("#resAuto").get(0).options.length = 0;
	                
                	$("#resAuto").get(0).options[0] = new Option("-- Seleccione Auto --", ""); 
	 				$("#autos").show();
	                $.each(msg.opciones, function(index, item) {
	                    $("#resAuto").get(0).options[$("#resAuto").get(0).options.length] = new Option(item.Display, item.Value);
						$('#precioUnit').val(item.precio);
//						$('#precioUnit1').val('$'+formatNumber(item.precio));
						$('#precioUnit1').val(item.precio);
	                });
	                sumaLosDias();
				}
            },
            error: function(xhr, status, error) {
				alert(status);
        	}
        });
    }else{
        $("#resAuto").get(0).options.length = 0;
    }
}




$('#formFlota')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			// obtengo el archivo a subir
			var inputFileImage 	= document.getElementById("uploadFoto");
			var file 			= inputFileImage.files[0];
			var data 			= new FormData();
			data.append('foto',file);
			var other_data = $('#formFlota').serializeArray();
			$.each(other_data,function(key,input){
				data.append(input.name,input.value);
			});

 			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            contentType:false,
	            data: data,
	            processData:false,
	            cache:false
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado el vehículo.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otro",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado el vehículo.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });  
   
        
 
$('#formStd')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='2'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado el registro.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});
					}else if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado el registro",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otro",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
						
					}else{
						swal("Ha ocurrido un error", 'Mensaje: '+data , "error");
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });  
 
   



$("#catID").bind("change", function() {
	catID = $(this).val();
	if(catID>0){
		window.location =  window.location.protocol + "//" + window.location.host + window.location.pathname + '?catID='+catID;
	}else{
		window.location =  window.location.protocol + "//" + window.location.host + window.location.pathname + '?catID='+0;
	}
});	



sumaLosDias();

$('#resFecIni, #resHorIni, #resFecFin, #resHorFin').on('change',function(){
	sumaLosDias();
});      

$('#resDesc,#precioUnit1').on('keyup',function(){
	sumaLosDias();
});      

$("#resDevol, #resDesCom").bind("change", function() {
	sumaLosDias();
});	 
 
    
function sumaLosDias(){
	precioTotal = 0;
	desde_el 	= $('#resFecIni').val();
	desde_elh 	= $('#resHorIni').val();
	hasta_el 	= $('#resFecFin').val();
	hasta_elh 	= $('#resHorFin').val();
	
	desde 		= desde_el + " " + desde_elh + ":00";
	hasta 		= hasta_el + " " + hasta_elh + ":00";
	
	var today 	= new Date();
	
	dias 		= moment(hasta,"DD/MM/YYYY HH:mm:ss").diff(moment(desde,"DD/MM/YYYY HH:mm:ss"),'days');
	milisec		= moment(hasta,"DD/MM/YYYY HH:mm:ss").diff(moment(desde,"DD/MM/YYYY HH:mm:ss"));
	
	diferenciadias = milisec - (dias * 86400000);
	if(diferenciadias>10800000){
		dias = dias + 1;
	}
    console.log('dias: '+dias);
	
	$('#resDias').val(dias);
	
    preciounit 	= $('#precioUnit1').val();
    console.log('preciounit: '+preciounit);
    losDias 	= $('#resDias').val();
    console.log('losDias: '+losDias);
    if(losDias){
    	precioTotal = preciounit * losDias;
	}else{
		precioTotal = preciounit * dias;
	}
	
    console.log('precioTotal: '+precioTotal);
	$('.opcID').each(function(i, obj) {
		if($(this).is(':checked')){
	    	valor = $(this).data('precio');
	    	total = valor * dias;
	    	precioTotal = precioTotal + total;
		}	    

	});    
	
	resDesc = $('#resDesc').val();
	if(resDesc){
		if(resDesc>0){
			precioTotal = Math.round(precioTotal-((precioTotal * resDesc)/100));
		}
	}
	
	if($('#resDesCom').val()>0){
		despacho = $('#resDesCom').find(':selected').data('precio');
		precioTotal = precioTotal + despacho;
	}

	if($('#resDevol').val()==2){
		precioTotal = precioTotal + despacho;
	}	
    
    $('#resValTot1').val('$'+formatNumber(precioTotal) ); // este es el que se ve
    $('#resValTot').val(precioTotal);
}

$(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });