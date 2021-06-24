<?php
class MarketPlace extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MarketPlace_model');
        $this->load->library('session');
    }
    function index($tiendas_data = array(),$productos_data = array())
    {
        if($tiendas_data == null){ 
            $data['tiendas'] = $this->MarketPlace_model->get_all_tiendas(); 

            $params = array(     //*           
                'idUsuarios' => 1,//*
            );//*

            $data['productos'] = $this->MarketPlace_model->buscar_productos_tienda($params); //get productos destacados            
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
}

