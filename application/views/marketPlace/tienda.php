
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

    <div class="container-fluid">
        <div class="row">
            <div class="col" id="nombre_tienda">
                <h1 style="margin: 20px 20px 20px 20px"><?php echo $tienda['nombre'] ?></h1>        
            </div>
        </div>
        <div class="row" id="datos_principales">
            <div class="col" id="img_pr">
                <?php echo "<img class='logo_pt' style='border-radius: 10px' src='". site_url('resources/photos/' . $tienda['foto_perfil']) ."' alt='Logo' width=200 height=120> ";?>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <label for="" style="font-weight: bold;">Telefono:</label>
                    </div>
                    <div class="col">
                        <label for=""><?php echo $tienda['telefono'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="" style="font-weight: bold;">Pais de origen:</label>
                    </div>
                    <div class="col">
                        <label for=""><?php echo $tienda['pais'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="" style="font-weight: bold;">Provincia:</label>
                    </div>
                    <div class="col">
                        <label for=""><?php echo $tienda['provincia'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="" style="font-weight: bold;">Correo de contacto:</label>
                    </div>
                    <div class="col">
                        <label for=""><?php echo $tienda['email'] ?></label>
                    </div>
                </div>
                <?php foreach ($redes as $r) { ?>      
                    <div class="row">
                        <div class="col">
                            <label for="" style="font-weight: bold;"><?php echo $r['nombre'] ?>:</label>
                        </div>
                        <div class="col">
                            <label for=""><?php echo $r['url'] ?></label>
                        </div>
                    </div>
                <?php } ?>
                
            </div>     
        </div>
    </div>
    <?php if (isset($this->session->userdata['logged_in']['logged_in']) && $this->session->userdata['logged_in']['logged_in'] == TRUE && $this->session->userdata['logged_in']['users_id'] == $tienda['idUsuarios']) { ?>
        <?php echo form_open_multipart('marketPlace/addProduct/' . $tienda['idUsuarios']); ?>
            <div class="container-fluid">
                <div class="row" id="insertar_producto">
                    <div class="col">
                        <label for="txt_nombre" class="control-label "><span class="text-danger">* </span>Nombre:</label>
                        <div class="form-group">
                            <input type="text" name="txt_nombre" value="<?php echo $this->input->post('txt_nombre'); ?>" class="cajatexto" id="txt_nombre" />
                            <span class="text-danger"><?php echo form_error('txt_nombre');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_descripcion" class="control-label "><span class="text-danger">* </span>Descripcion:</label>
                        <div class="form-group">
                            <input type="text" name="txt_descripcion" value="<?php echo $this->input->post('txt_descripcion'); ?>" class="cajatexto" id="txt_descripcion" />
                            <span class="text-danger"><?php echo form_error('txt_descripcion');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_disponibles" class="control-label "><span class="text-danger">* </span>Disponibles:</label>
                        <div class="form-group">                        
                        <input type="number" name="txt_disponibles" value="<?php echo $this->input->post('txt_disponibles'); ?>" class="cajatexto" id="txt_disponibles" />
                            <span class="text-danger"><?php echo form_error('txt_disponibles');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_ubicacion" class="control-label "><span class="text-danger">* </span>Ubicacion:</label>
                        <div class="form-group">                        
                        <input type="text" name="txt_ubicacion" value="<?php echo $this->input->post('txt_ubicacion'); ?>" class="cajatexto" id="txt_ubicacion" />
                            <span class="text-danger"><?php echo form_error('txt_ubicacion');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_precio" class="control-label "><span class="text-danger">* </span>Precio:</label>
                        <div class="form-group">                        
                        <input type="number" name="txt_precio" value="<?php echo $this->input->post('txt_precio'); ?>" class="cajatexto" id="txt_precio" />
                            <span class="text-danger"><?php echo form_error('txt_precio');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_tiempo_envio" class="control-label "><span class="text-danger">* </span>Tiempo de envio (dias):</label>
                        <div class="form-group">                        
                        <input type="number" name="txt_tiempo_envio" value="<?php echo $this->input->post('txt_tiempo_envio'); ?>" class="cajatexto" id="txt_tiempo_envio" />
                            <span class="text-danger"><?php echo form_error('txt_tiempo_envio');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_costo_envio" class="control-label "><span class="text-danger">* </span>Costo del envio:</label>
                        <div class="form-group">                        
                        <input type="number" name="txt_costo_envio" value="<?php echo $this->input->post('txt_tiempo_envio'); ?>" class="cajatexto" id="txt_costo_envio" />
                            <span class="text-danger"><?php echo form_error('txt_costo_envio');?></span>
                        </div>
                    </div>
                    <div class="col">
                        <label for="txt_foto" class="control-label "><span class="text-danger">* </span>Foto del producto:</label>
                        <div class="form-group">                        
                        <input type="file" name="txt_foto" size="20" accept="image/jpeg,image/gif,image/png" value="<?php echo $this->input->post('txt_foto'); ?>" class="cajatexto" id="txt_foto"/>
                            <span class="text-danger"><?php echo form_error('txt_foto');?></span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="box-footer" style="text-align: center;">
                <button type="submit" class="boton">Agregar producto</button>                
            </div>
        <?php echo form_close(); ?>
    <?php } ?>
    
    
    
    <h1 style="margin: 20px 20px 20px 20px">Productos</h1>            
    <div class="container-fluid">
        <div class="row product_box">
            <?php foreach ($productos as $p) { 
                $foto = '';
                foreach ($fotos as $f) { 
                    if($f['Productos_id'] == $p['idProductos']){
                        $foto = $f['nombre'];
                        break;
                    }
                } ?>  
                 
                <div class="col">
                    <a href="<?php echo site_url('marketPlace/producto/'. $p['idProductos']); ?>" >
                        <?php 
                            echo "<input class='logo_pt' style='border-radius: 10px' type='image' src='" . site_url('resources/photos/products/' . $foto) . "' alt='Logo' width=250 height=200/>";
                            echo"<br>";
                            echo "<label class='lbl_pt'>" . $p['nombre'] . "</label>";
                        ?>   
                    </a>
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