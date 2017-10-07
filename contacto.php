<?php include('header.php'); ?>
	<main>
	 	<div class="barra_naranja">
		 	<div class="container">
			 	<h4>CONTACTO</h4>
		 	</div><!-- /.container -->
	 	</div><!-- /.barra_naranja -->
	  
		<div class="container">
			<div class="section">
				
				<div class="row">
					<div class="col s12 l8 offset-l2 features_content">
<!--
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut tempor tellus. Aliquam molestie eu nulla id varius. Sed convallis eget leo a suscipit. Phasellus mollis mollis mauris, tristique auctor ipsum efficitur ac. Praesent sed magna venenatis, commodo quam in, porttitor magna. Pellentesque dignissim ipsum id iaculis scelerisque. Donec egestas tristique risus a vulputate. Aenean in nisl arcu. Duis vehicula porta mi ut aliquet. Nulla ullamcorper diam eget tempor condimentum. Donec nec leo volutpat, pretium tortor in, lacinia dolor. Sed rutrum metus et porttitor malesuada. Integer felis odio, bibendum porta tempor ut, semper a dolor. Donec ac ligula quis odio ultricies pretium eleifend sed augue. Aenean rutrum maximus justo sed mollis.
						</p>
-->
					</div><!-- /.col -->
				</div><!-- /.row -->
				
				<div class="row">
					<form class="col s12 l8 offset-l2" action="ajax/contacto.php" method="post" id="formContacto">
			      <div class="row">
			        <div class="input-field col m6 s12">
			          <input id="nombre" type="text" class="validate" name="nombre" required>
			          <label for="first_name">Nombre</label>
			        </div>
			        <div class="input-field col m6 s12">
			          <input id="apellido" type="text" class="validate" name="apellido" required>
			          <label for="last_name">Apellido</label>
			        </div>
			      </div><!-- /.row -->
			      <div class="row">
			        <div class="input-field col m6 s12">
			          <input id="mail" type="text" class="validate" name="email" required>
			          <label for="email">Email</label>
			        </div>
			        <div class="input-field col m6 s12">
			          <input id="fono" type="text" class="validate" name="telefono" required>
			          <label for="telefono">Teléfono</label>
			        </div>
			      </div><!-- /.row -->
			      <div class="row">
			        <div class="col s12">
			          <div class="row">
					        <div class="input-field col s12">
					          <textarea id="mensaje" class="materialize-textarea" name="mensaje" required ></textarea>
					          <label for="textarea1">Mensaje</label>
					        </div>
					      </div>
			        </div>
			      </div><!-- /.row -->
			      <div class="row">
			        <div class="col s12">
			          <button class="btn" type="submit" name="action" id="btnEnviar">Enviar</button>
			        </div>
			      </div><!-- /.row -->
			    </form>
		    	<div class="progress hide" id="progreso">
			    	<div class="indeterminate"></div>
				</div>
				</div><!-- /.row -->
			</div><!-- /.section -->			
		</div><!-- /.container -->
	</main>
<?php include('footer.php'); ?>