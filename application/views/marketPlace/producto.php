
<header>
    <div id="main_header" class="container-fluid">
        <div class="row">
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo1.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            
            <div class=" col busqueda">
                <div class="input-group-prepend">
                    <div class="input-group-text" id="btnGroupAddon">
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option selected>Seleccione una categoría</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>

         
                <input type="text" class="form-control" name="txt_buscar" id="txt_buscar" placeholder="Buscar" title="Buscar">
                
            </div>

            <!-- <div id="sesion" class="col">
                <a href="" class="lbl_links">Iniciar sesión</a>
                <label class="lbl_links">/</label>
                <a href="" class="lbl_links">Registrarse</a>
            </div> -->

            <div id="perfil" class="col">
                
                
                                <?php 
                                    echo "<input type='image' src='" . site_url('../resources/img/icon_bandeja_entrada.svg') . "' alt='Bandeja de entrada' title='Bandeja de entrada' width=50 />";
                                ?> 
                           
                          
                                <?php 
                                    echo "<input type='image' src='" . site_url('../resources/img/icon_reporte.svg') . "' alt='Reportes' title='Reportes' width=50 />";
                                ?>  
                           
                                <?php 
                                    echo "<input type='image' src='" . site_url('../resources/img/carrito.svg') . "' alt='Carrito de compras' title='Carrito de compras'  width=50 />";
                                ?>  
                            <div>
                                    <?php 
                                    echo "<input class='img_perfil' type='image' src='" . site_url('../resources/img/flash.jpg') . "' alt='Foto de perfil' title='Foto de perfil' width=70  />";
                                ?>
                                <br>
                                <label class="label label-primary lbl_user">Pablo Carvajal</label>
                            </div>
                                
                          

            </div>
        </div>
    </div>

</header>

<body>
    <h1>Tiendas</h1>
    
    <div class="container-fluid">
        <div class="row product_box">
            <div class="col">
                <button class='logo' style="  width:40%; height: 100%"></button>
            </div>
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            <div class="col">
                <button style="text-align: center;  width:40%; height: 100%"></button>
            </div>
        </div>
    </div>

    <h1 style="margin: 100px 20px 20px 20px">Productos destacados</h1>
    <div class="container-fluid">
        <div class="row product_box">
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
        </div>
       
        <div class="row">
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            <div class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo.svg') . "' alt='Logo'/>";
                ?>                
            </div>
      
        </div>
    </div>
</body>

<footer class="text-center text-lg-start bg-light text-muted">
    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="https://github.com/AdrianGamboa/MarketPlace" target="_blank">Mosqueteros</a>
    </div>
    <!-- Copyright -->
</footer>
