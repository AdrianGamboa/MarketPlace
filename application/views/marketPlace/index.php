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
    <!-- Si es una tienda, se redirecciona al panel de administracion -->
    <?php if (isset($this->session->userdata['logged_in']['logged_in']) && $this->session->userdata['logged_in']['logged_in'] == TRUE && $this->session->userdata['logged_in']['tipo'] == "Tienda") { 

        redirect('marketPlace/tienda/'.$this->session->userdata['logged_in']['users_id']); ?>
  
    <?php } else { ?>
        <h1 style="margin: 0px 20px 20px 20px">Tiendas</h1>
        
        <div class="container-fluid">
            <div class="row product_box">
                <?php foreach ($tiendas as $t) { ?>                      
                    <div class="col">
                        <a href="<?php echo site_url('marketPlace/tienda/' . $t['idUsuarios']); ?>" >
                            <?php 
                                echo "<input class='logo_pt' type='image' src='" . site_url('resources/photos/' . $t['foto_perfil']) . "' alt='Logo' width=200 height=120/>";
                                echo"<br>";
                                echo "<label class='lbl_pt'>" . $t['nombre'] . "</label>";
                            ?>   
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>

    <h1 style="margin: 20px 20px 20px 20px">Productos destacados</h1>
    <div class="container-fluid">
        <div class="row product_box">
            <div class="col">
                <?php 
                    echo "<input class='logo_pt' type='image' src='" . site_url('resources/img/logo.svg') . "' alt='Logo' width=200 height=120/>";
                    echo"<br>";
                    echo "<label class='lbl_pt'>a</label>";
                ?>                
            </div>
        </div>
    </div>
    <?php } ?>
</body>

<footer class="text-center text-lg-start footer">
    <div class="text-center p-4">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="https://github.com/AdrianGamboa/MarketPlace" target="_blank">Mosqueteros</a>
    </div>
</footer>
