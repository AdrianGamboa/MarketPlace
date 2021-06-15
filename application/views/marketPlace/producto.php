
<header>
    <div id="main_header" class="container-fluid">
        <div class="row">
            <div id="logo_box" class="col">
                <?php 
                    echo "<input class='logo' type='image' src='" . site_url('../resources/img/logo1.svg') . "' alt='Logo'/>";
                ?>                
            </div>
            
            <div class="input-group col busqueda">
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
                
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="" id="navbarNav">
                        <ul class="navbar-nav">

                            <li class="nav-item active nv_item">
                                <?php 
                                    echo "<input type='image' src='" . site_url('../resources/img/icon_bandeja_entrada.svg') . "' alt='Bandeja de entrada' title='Bandeja de entrada' width=50 />";
                                ?> 
                            </li>
                            <li class="nav-item nv_item">
                                <?php 
                                    echo "<input type='image' src='" . site_url('../resources/img/icon_reporte.svg') . "' alt='Reportes' title='Reportes' width=50 />";
                                ?>  
                            </li>
                            <li class="nav-item nv_item">
                                <?php 
                                    echo "<input type='image' src='" . site_url('../resources/img/carrito.svg') . "' alt='Carrito de compras' title='Carrito de compras'  width=50 />";
                                ?>  
                            </li>
                            <li class="nav-item ">
                                <?php 
                                    echo "<input class='img_perfil' type='image' src='" . site_url('../resources/img/flash.jpg') . "' alt='Foto de perfil' title='Foto de perfil' width=70  />";
                                ?>
                                <br>
                                <label class="label label-primary lbl_user">Pablo Carvajal</label>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</header>

<body>
    <h1>Tiendas</h1>
    
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
    </div>

    <h1>Productos destacados</h1>
    <br>
</body>

<footer class="text-center text-lg-start bg-light text-muted">
    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2021 Copyright:
        <a class="text-reset fw-bold" href="https://github.com/AdrianGamboa/MarketPlace" target="_blank">Mosqueteros</a>
    </div>
    <!-- Copyright -->
</footer>
