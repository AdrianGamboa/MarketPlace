<header>
    <div id="main_header" class="container-fluid">
        <div class="row">
            <div class="col">
                <a href="<?php echo site_url('marketPlace/index'); ?>" >
                    <?php
                        echo "<img class='logo' src='" . site_url('resources/img/logo1.svg') . "' alt='Foto de perfil' title='Foto de perfil' />";
                    ?>
                </a>
            </div>
            
            <div class="input-group col busqueda" >
                <div class="input-group-prepend">
                    <div class="input-group-text" id="btnGroupAddon">
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Categorias</option>
                            <?php foreach ($categorias as $c) { 
                                echo "<option value=". $c['nombre'] .">". $c['nombre'] ." </option>";
                             } ?>
                        </select>
                    </div>
                </div>

                <input type="text" class="form-control" name="txt_buscar" id="txt_buscar" placeholder="Buscar" title="Buscar">   
            </div>

            <?php if (isset($this->session->userdata['logged_in']['logged_in']) && $this->session->userdata['logged_in']['logged_in'] == TRUE) { ?>

				<div id="perfil_bar" class="col">
					<?php 
						echo "<input class='perfil' type='image' src='" . site_url('resources/img/icon_bandeja_entrada.svg') . "' alt='Bandeja de entrada' title='Bandeja de entrada' width=50 />";
					?> 

					<?php 
						echo "<input class='perfil' type='image' src='" . site_url('resources/img/icon_reporte.svg') . "' alt='Reportes' title='Reportes' width=50 />";
					?>  

					<?php 
						echo "<input class='perfil' type='image' src='" . site_url('resources/img/carrito.svg') . "' alt='Carrito de compras' title='Carrito de compras'  width=50 />";
					?>  

					<div class="perfil">
                        <a href="<?php echo site_url('user/edit/' . $this->session->userdata['logged_in']['users_id']); ?>" >
                            <?php
                                echo "<img class='img_perfil' src='" . site_url('resources/photos/' . $this->session->userdata['logged_in']['photo']) . "' alt='Foto de perfil' title='Foto de perfil' width=70/>";
                            ?>
                        </a>
						<br>
						<?php echo "<label class='label label-primary lbl_user'>" . $this->session->userdata['logged_in']['realname'] . "</label>"; ?>
					</div>
				</div>

			<?php } else { ?>

				<div id="sesion" class="col">
					<a href="<?php echo site_url('auth/login'); ?>" class="lbl_links">Iniciar sesión</a>
					<label class="lbl_links">/</label>
					<a href="<?php echo site_url('user/add'); ?>" class="lbl_links">Registrarse</a>
				</div>

			<?php } ?>

        </div>
    </div>

</header>

<body>
<?php if (isset($this->session->userdata['logged_in']['logged_in']) && $this->session->userdata['logged_in']['logged_in'] == TRUE && $this->session->userdata['logged_in']['users_id'] == $producto['Usuarios_id']) { ?>
        <?php echo form_open_multipart('marketPlace/editProduct/' . $producto['idProductos']); ?>
            <div class="container-fluid">
                <div class="row" id="insertar_producto">
                    <div class="col" id="">
                        <label for="txt_nombre" class="control-label"><span class="text-danger">* </span>Nombre:</label>
                        <div class="form-group">
                            <input type="text" name="txt_nombre" value="<?php echo ($this->input->post('txt_nombre') ? $this->input->post('txt_nombre') : $producto['nombre']); ?>" class="cajatexto" id="txt_nombre" />
                            <span class="text-danger"><?php echo form_error('txt_nombre');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_descripcion" class="control-label"><span class="text-danger">* </span>Descripcion:</label>
                        <div class="form-group">
                            <input type="text" name="txt_descripcion" value="<?php echo ($this->input->post('txt_descripcion') ? $this->input->post('txt_descripcion') : $producto['descripcion']); ?>" class="cajatexto" id="txt_descripcion" />
                            <span class="text-danger"><?php echo form_error('txt_descripcion');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_disponibles" class="control-label"><span class="text-danger">* </span>Disponibles:</label>
                        <div class="form-group">
                            <input type="number" name="txt_disponibles" value="<?php echo ($this->input->post('txt_disponibles') ? $this->input->post('txt_disponibles') : $producto['disponibles']); ?>" class="cajatexto" id="txt_disponibles" />
                            <span class="text-danger"><?php echo form_error('txt_disponibles');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_ubicacion" class="control-label "><span class="text-danger">* </span>Ubicacion:</label>
                        <div class="form-group">                        
                        <input type="text" name="txt_ubicacion" value="<?php echo ($this->input->post('txt_ubicacion') ? $this->input->post('txt_ubicacion') : $producto['ubicacion']); ?>" class="cajatexto" id="txt_ubicacion" />
                            <span class="text-danger"><?php echo form_error('txt_ubicacion');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_precio" class="control-label "><span class="text-danger">* </span>Precio:</label>
                        <div class="form-group">                        
                        <input type="number" name="txt_precio" value="<?php echo ($this->input->post('txt_precio') ? $this->input->post('txt_precio') : $producto['precio']); ?>" class="cajatexto" id="txt_precio" />
                            <span class="text-danger"><?php echo form_error('txt_precio');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_tiempo_envio" class="control-label "><span class="text-danger">* </span>Tiempo de envio (dias):</label>
                        <div class="form-group">                        
                        <input type="number" name="txt_tiempo_envio" value="<?php echo ($this->input->post('txt_tiempo_envio') ? $this->input->post('txt_tiempo_envio') : $producto['tiempo_envio']); ?>" class="cajatexto" id="txt_tiempo_envio" />
                            <span class="text-danger"><?php echo form_error('txt_tiempo_envio');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_costo_envio" class="control-label "><span class="text-danger">* </span>Costo del envio:</label>
                        <div class="form-group">                        
                        <input type="number" name="txt_costo_envio" value="<?php echo ($this->input->post('txt_tiempo_envio') ? $this->input->post('txt_costo_envio') : $producto['costo_envio']); ?>" class="cajatexto" id="txt_costo_envio" />
                            <span class="text-danger"><?php echo form_error('txt_costo_envio');?></span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="box-footer" style="text-align: center;">
                <button type="submit" class="boton">Editar producto</button>                
            </div>
        <?php echo form_close(); ?>
        <div class="col" id="nombre_tienda">
            <h1 style="margin: 20px 20px 20px 20px">Agregar imagenes del producto</h1>        
        </div>
        <div style="text-align: center; margin-top: 20px; border-bottom:black 4px solid ;">
            <?php echo form_open_multipart('marketPlace/upload_photo/' . $producto['idProductos']);?>
                <input type="file" name="txt_foto" size="20" class="btn btn-info" accept="image/jpeg,image/gif,image/png" />
                <br><br>
                <button type="submit" class="boton">Cargar Foto</button>
            <?php echo form_close(); ?>
        </div>
        
    <?php } else { ?>
        <div class="container-fluid">
        
            <div class="row">
                <div class="col" id="nombre_tienda">
                    <h1 style="margin: 20px 20px 20px 20px"><?php echo $producto['nombre'] ?></h1>        
                </div>
            </div>

            <div class="row" id="datos_principales">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <label for="" style="font-weight: bold;">Descripcion:</label>
                        </div>
                        <div class="col">
                            <label for=""><?php echo $producto['descripcion'] ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" style="font-weight: bold;">Cantidad disponible:</label>
                        </div>
                        <div class="col">
                            <label for=""><?php echo $producto['disponibles'] ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" style="font-weight: bold;">Fecha de publicación:</label>
                        </div>
                        <div class="col">
                            <label for=""><?php echo $producto['fecha_publicacion'] ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" style="font-weight: bold;">Ubicación:</label>
                        </div>
                        <div class="col">
                            <label for=""><?php echo $producto['ubicacion'] ?></label>
                        </div>
                    </div>                               
                    <div class="row">
                        <div class="col">
                            <label for="" style="font-weight: bold;">Tiempo de envio (dias):</label>
                        </div>
                        <div class="col">
                            <label for=""><?php echo $producto['tiempo_envio'] ?></label>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col">
                            <label for="" style="font-weight: bold;">Costo de envio:</label>
                        </div>
                        <div class="col">
                            <label for=""><?php echo $producto['costo_envio'] ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="" style="font-weight: bold;">Precio:</label>
                        </div>
                        <div class="col">
                            <label for=""><?php echo $producto['precio'] ?></label>
                        </div>
                    </div>                       
                </div>     
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <?php echo form_open_multipart('marketPlace/agregar_carrito/' . $producto['idProductos']);?>                   
                    <button type="submit" class="boton">Agregar al carrito</button>
                <?php echo form_close(); ?>
            </div>
        </div>
        
    <?php } ?>
    <h1 style="margin: 20px 20px 20px 20px">Galeria de imagenes del producto</h1>            
        <div class="container-fluid">
            <div class="row product_box">
                <?php foreach ($fotos as $f) {  ?>
                    <div class="col" style="margin-bottom: 20px;"> 
                    <?php
                        echo "<img class='logo_pt' style='border-radius: 10px' src='".site_url('resources/photos/products/' . $f['nombre']) . "' alt='Logo' width=250 height=200> ";                        
                    ?>
                    </div>
                <?php } ?>  
                    
            </div>
        </div>
</body>

<footer class="text-center text-lg-start footer">
    <div class="text-center p-4">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="https://github.com/AdrianGamboa/MarketPlace" target="_blank">Mosqueteros</a>
    </div>
</footer>
