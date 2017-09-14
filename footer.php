	<footer>
		<div class="section">
			<div class="container">
<!--
				<div class="row">
					<div class="col l6 push-l6 content">
						<img src="assets/img/real_rent_a_car_blanco.svg" width="180"/>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas enim lectus, lobortis ac enim ac, faucibus fringilla lacus. Fusce malesuada tincidunt felis, sed mollis magna feugiat ut. Sed sapien nisi, consequat pretium sollicitudin at, tristique feugiat lorem.</p>
					</div>
					<div class="col l6 pull-l6">
						<img src="assets/img/footer_img.jpg" class="responsive-img"/>
					</div>
					
				</div>
-->
				<div class="row">
					<div class="col l6 s12 content">
						<p class="left-align">
						<span>Atención Telefónica <!-- 24/7 --></span><br>
						+52 2 2747 2648<br>
						+56 9 4025 8421<br><br>
						
						<span>Correo Electrónico</span><br>
						contacto@realrentacar.cl<br><br>
						
						Rinconada 8926, Vitacura<br> 
						Santiago, RM<br>
						CHILE
						</p>
					</div><!-- /.col -->
					<div class="col l6 s12">
						<div class="video-container">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3331.4536125936656!2d-70.5524078849823!3d-33.385327980792624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662c94aa08c2fcd%3A0x8376d61f7e33713e!2sRinconada+8926%2C+Vitacura%2C+Regi%C3%B3n+Metropolitana!5e0!3m2!1ses!2scl!4v1502898427034" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					</div><!-- /.col -->
					
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- /.section -->
	</footer>

  <!--  SCRIPTS -->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="assets/js/jquery.easing.min.js"></script>
  <script src="assets/owlcarousel/owl.carousel.js"></script>
<!--   <script src="assets/js/jquery.autocomplete.min.js"></script> -->
	<script src="assets/js/materialize.min.js"></script>
	<script src="assets/js/moment-with-locales.min.js"></script>
	<script src="assets/js/init.js?ver=2.2"></script>

<script>

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
</script>

  </body>
</html>