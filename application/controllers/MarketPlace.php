<?php
class MarketPlace extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MarketPlace_model');
        $this->load->model('User_model');
        $this->load->library('session');
    }
    function index($tiendas_data = array(),$productos_data = array())
    {
        if($tiendas_data == null){ 
            $data['tiendas'] = $this->MarketPlace_model->get_all_tiendas(); 

            $data['productos'] = $this->MarketPlace_model->get_productos_destacados();
        } else { 
            $data['tiendas'] = $tiendas_data; 
            $data['productos'] = $productos_data;             
        }

        $data['fotos'] = $this->MarketPlace_model->get_all_fotos_productos(); 
        $data['categorias'] = $this->MarketPlace_model->get_all_categorias();

        $data['_view'] = 'marketPlace/index';
        $this->load->view('layouts/main', $data);
    }
    
    function carrito($usuario_id)
    {   
        //Se envian datos al view de carritp.
        $data['productos_carrito'] = $this->MarketPlace_model->get_carrito($usuario_id); 
        $data['productos_deseos'] = $this->MarketPlace_model->get_deseos($usuario_id); 
        $data['categorias'] = $this->MarketPlace_model->get_all_categorias(); 
        $data['fotos'] = $this->MarketPlace_model->get_all_fotos_productos();
        $data['metodos_pago'] = $this->User_model->get_metodos_pago_usuario($this->session->userdata['logged_in']['users_id']);


        $precio_total = 0;
        foreach($data['productos_carrito'] as $p){        
            $precio_total += ($p['precio'] * $p['cantidad']) + $p['costo_envio'];
        }
        
        $data['precio_total'] = $precio_total;

        $data['_view'] = 'marketPlace/carrito';
        $this->load->view('layouts/main',$data);
    }
    //Realiza la busqueda en la pagina principal, tomando en cuenta el tipo(producto, tienda), las diferentes categorías que existen y el parametro de busqueda que proporciona el usuario
    function buscar(){        

        if($this->input->post('txt_tipo') != null && $this->input->post('txt_tipo') == "Tiendas") { //Si quiere buscar tienda
            if($this->input->post('txt_categoria') != '0') //Si quiere buscar una tienda por categoria
            {
                $categoria = $this->MarketPlace_model->get_categoria($this->input->post('txt_categoria')); 

                $tiendas = $this->MarketPlace_model->buscar_tiendas_categoria($this->input->post('txt_buscar'), $categoria);
                if($tiendas != null) {
                    $productos = array();

                    foreach($tiendas as $r){
                        $productos = array_merge($productos,$this->MarketPlace_model->buscar_productos_tienda_categoria($r,$categoria));
                    }

                    $productos = array_unique($productos,SORT_REGULAR);
                    $this->index($tiendas,$productos);  
                }
                else {
                    $this->session->set_flashdata('error', "No se encontraron tiendas.");
                    redirect('marketPlace/buscar','refresh');
                    $this->index();    
                }               
            }
            else {
                if($this->input->post('txt_buscar') != null) {
                    $tiendas = $this->MarketPlace_model->buscar_tiendas($this->input->post('txt_buscar'));
                    if($tiendas != null){
                        $productos = array();

                        foreach($tiendas as $r){
                            $productos =  array_merge($productos,$this->MarketPlace_model->buscar_productos_tienda($r));
                        }
                        $this->index($tiendas,$productos);
                        
                    }
                    else{
                        $this->session->set_flashdata('error', "No se encontraron tiendas.");
                        redirect('marketPlace/buscar','refresh');
                        $this->index();    
                        
                    }
                }
                else {
                    $this->session->set_flashdata('error', "Digite parámetros de búsqueda.");
                    redirect('marketPlace/buscar','refresh');
                    $this->index();    
                } 
            }            
        }
        else if ($this->input->post('txt_tipo') != null && $this->input->post('txt_tipo') == "Productos") { //Si quiere buscar productos
            if($this->input->post('txt_categoria') != '0') //Si quiere buscar productos por categoria
            {
                $categoria = $this->MarketPlace_model->get_categoria($this->input->post('txt_categoria'));

                $productos = $this->MarketPlace_model->buscar_productos_categoria($this->input->post('txt_buscar'), $categoria);
                
                if($productos != null) {
                    $tiendas = array();

                    foreach($productos as $r){
                        $tiendas = array_merge($tiendas,$this->MarketPlace_model->buscar_tienda_producto_categoria($r,$categoria));
                    }

                    $tiendas = array_unique($tiendas,SORT_REGULAR);
                    $this->index($tiendas,$productos);  
                }
                else {
                    $this->session->set_flashdata('error', "No se encontraron productos.");
                    redirect('marketPlace/buscar','refresh');
                    $this->index();    
                }  
            }
            else {
                if($this->input->post('txt_buscar') != null) {
                    $productos = $this->MarketPlace_model->buscar_productos($this->input->post('txt_buscar'));
                    if($productos != null){
                        $tiendas = array(); //Se guardan las tiendas que venden esos productos

                        foreach($productos as $r){
                            $tiendas = array_merge($tiendas,$this->MarketPlace_model->buscar_tienda_producto($r));
                        }
                                        
                        $tiendas = array_unique($tiendas,SORT_REGULAR);

                        $this->index($tiendas,$productos);
                    }
                    else{                        
                        $this->session->set_flashdata('error', "No se encontraron productos.");
                        redirect('marketPlace/buscar','refresh');
                        $this->index();    
                    }                    
                }
                else{
                    $this->session->set_flashdata('error', "Digite parámetros de búsqueda.");
                    redirect('marketPlace/buscar','refresh');
                    $this->index();    
                }
            }
        }
        else{
            $this->index();   
        }  
        
    }
    //Permite agregar productos al carrito del usuario
    function agregar_carrito($product_id)
    {        
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('txt_cantidad','Cantidad','required');

        $cant_producto = $this->MarketPlace_model->cantidad_producto($product_id);

        if($cant_producto > 0) {
            if(isset($this->session->userdata['logged_in'])) {
            
                $params = array(                
                    'Productos_id' => $product_id,
                    'Usuarios_id' => $this->session->userdata['logged_in']['users_id'],
                    'cantidad' => $this->input->post('txt_cantidad'),
                );
                
                $producto_existente = $this->MarketPlace_model->verificar_producto_carrito($params);

                if(isset($producto_existente)){
                    $params2 = array(                
                        'cantidad' => $producto_existente['cantidad'] + 1,                        
                    );
                    $this->MarketPlace_model->update_carrito($producto_existente['idCarritos'] , $params2);
                } else {
                    $this->MarketPlace_model->add_carrito($params);
                }
                
                $this->session->set_flashdata('success', "Producto agregado al carrito correctamente.");
            }
        }
        else{
            $this->session->set_flashdata('success', "No hay productos disponibles para la venta.");
        }

        redirect('producto/index/' . $product_id);
    }
    function eliminar_carrito($product_id)
    {                  
        if(isset($this->session->userdata['logged_in'])) {
        
            $params = array(                
                'Productos_id' => $product_id,
                'Usuarios_id' => $this->session->userdata['logged_in']['users_id'],
            );
            
            $producto_existente = $this->MarketPlace_model->verificar_producto_carrito($params);

            if(isset($producto_existente)){
                $this->MarketPlace_model->eliminar_carrito($params);
            }
            
            $this->session->set_flashdata('success', "Producto eliminado del carrito correctamente.");
        }

        redirect('marketPlace/carrito/' . $this->session->userdata['logged_in']['users_id']);
    }
    function agregar_deseo($product_id)
    {       
        if(isset($this->session->userdata['logged_in'])) {
        
            $params = array(                
                'Productos_id' => $product_id,
                'Usuarios_id' => $this->session->userdata['logged_in']['users_id'],
                'alerta' => 'N',
            );
            
            $producto_existente = $this->MarketPlace_model->verificar_producto_deseo($params);

            if(!isset($producto_existente)){
                $this->MarketPlace_model->add_deseo($params);
            } 
            
            $this->session->set_flashdata('success', "Producto agregado a la lista de deseos correctamente.");
        }


        redirect('producto/index/' . $product_id);
    }
    function eliminar_deseo($product_id)
    {                  
        if(isset($this->session->userdata['logged_in'])) {
        
            $params = array(                
                'Productos_id' => $product_id,
                'Usuarios_id' => $this->session->userdata['logged_in']['users_id'],
            );
            
            $producto_existente = $this->MarketPlace_model->verificar_producto_deseo($params);

            if(isset($producto_existente)){
                $this->MarketPlace_model->eliminar_deseo($params);
            }
            
            $this->session->set_flashdata('success', "Producto eliminado del carrito correctamente.");
        }

        redirect('marketPlace/carrito/' . $this->session->userdata['logged_in']['users_id']);
    }

    function comprar_carrito(){

        $this->load->library('form_validation');
        $this->load->helper('date');

        $this->form_validation->set_rules('txt_num_tarjeta','Numero de tarjeta','required|max_length[128]');
        $this->form_validation->set_rules('txt_codigo_cvv_pago','Codigo CVV','required|max_length[128]');
        
        $format = "%Y-%m-%d";

        if($this->form_validation->run())     
        {  
            $data = array(
				'numero_tarjeta' => $this->input->post('txt_num_tarjeta'),
				'codigo_cvv' => $this->input->post('txt_codigo_cvv_pago')
			);
            
            $result = $this->MarketPlace_model->verificar_tarjeta($data);
            
            if ($result == TRUE) { //Si el codigo cvv es correcto

                $productos_carrito = $this->MarketPlace_model->get_carrito($this->session->userdata['logged_in']['users_id']); 
                if ($productos_carrito != null) {
                
                    $tienda_inhabilitada = FALSE;
                    $precio_total = 0;
                    foreach($productos_carrito as $p){        
                        $precio_total += ($p['precio'] * $p['cantidad']) + $p['costo_envio'];

                        $tienda = $this->MarketPlace_model->get_tienda($p['Usuarios_id']); 
                        if ($tienda['estado'] == 'Inactivo') {
                            $tienda_inhabilitada = $tienda;
                            break;
                        }
                    }

                    if ($tienda_inhabilitada == FALSE) {

                        $tarjeta = $this->MarketPlace_model->get_numero_tarjeta($this->input->post('txt_num_tarjeta'));                     

                        if ( $tarjeta['saldo'] >= $precio_total) {     
                            
                            $cantidad_suficiente = TRUE; //Si hay suficientes productos en inventario para realizar la venta
                            foreach($productos_carrito as $p) {  
                                if ($p['disponibles'] < $p['cantidad']){
                                    $cantidad_suficiente = FALSE;
                                }
                            }    
                            
                            if ($cantidad_suficiente == TRUE) {
                                
                                $data_venta = array(
                                    'fecha' => mdate($format),
                                    'venta_total' => $precio_total,
                                    'Formas_Pago_id' => $tarjeta['idFormas_Pago'],
                                );
            
                                $venta_id = $this->MarketPlace_model->add_venta($data_venta); 
            
                                foreach($productos_carrito as $p) {      
            
                                    $data_producto = array(
                                        'disponibles' => $p['disponibles'] - $p['cantidad'],
                                    ); 
            
                                    $this->MarketPlace_model->update_producto($p['idProductos'],$data_producto);
            
                                    $data_venta_producto = array(
                                        'cantidad' => $p['cantidad'],
                                        'Ventas_id' => $venta_id,
                                        'Productos_id' => $p['idProductos'],
                                    );  
            
                                    $this->MarketPlace_model->add_venta_producto($data_venta_producto);
            
                                    $data_metodo_pago = array(
                                        'saldo' => $tarjeta['saldo'] - $precio_total,                            
                                    ); 
            
                                    $this->MarketPlace_model->update_metodo_pago($tarjeta['idFormas_Pago'], $data_metodo_pago);
                                    
                                    $data_carrito = array(
                                        'idCarritos' => $p['idCarritos'],                            
                                    ); 
            
                                    $this->MarketPlace_model->eliminar_carrito($data_carrito);
                                }
                                $this->session->set_flashdata('success', "Compra del producto realizada con exito.");    
                            }
                            else {
                                $this->session->set_flashdata('error', "No hay suficientes productos a la venta."); 
                            }                                            
                        }
                        else{
                            $this->session->set_flashdata('error', "No cuenta con saldo suficiente en la tarjeta para realizar la transacción.");     
                        }
                    }
                    else {
                        $this->session->set_flashdata('error', "La tienda: " . $tienda_inhabilitada['nombre'] . " no tiene permitido vender productos.");     
                    }
                }
                else {
                    $this->session->set_flashdata('error', "No hay productos en el carrito para comprar."); 
                }
            }
            else{
                $this->session->set_flashdata('error', "El codigo CVV ingresado no concuerda con el numero de tarjeta."); 
            }
        }
        else
        {
            $this->session->set_flashdata('error', "Proporcione los parametros necesarios para ingresar el metodo de pago."); 
        }

        redirect('marketPlace/carrito/'.$this->session->userdata['logged_in']['users_id'],'refresh');
    }
}

