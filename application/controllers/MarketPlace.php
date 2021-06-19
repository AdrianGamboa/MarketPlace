<?php
class MarketPlace extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MarketPlace_model');
        $this->load->library('session');
    }
    function index($tiendas_data = array())
    {
        if($tiendas_data == null){ 
            $data['tiendas'] = $this->MarketPlace_model->get_all_tiendas(); 
        } else { 
            $data['tiendas'] = $tiendas_data; 
        }

        $data['categorias'] = $this->MarketPlace_model->get_all_categorias();

        $data['_view'] = 'marketPlace/index';

        $this->load->view('layouts/main', $data);
    }

    function tienda($users_id)
    {   
        //Se envian datos al view de tienda.
        $data['categorias'] = $this->MarketPlace_model->get_all_categorias(); 
        $data['productos'] = $this->MarketPlace_model->get_productos_tienda($users_id); 
        $data['tienda'] = $this->MarketPlace_model->get_datos_tienda($users_id); 
        $data['redes'] = $this->MarketPlace_model->get_redes_tienda($users_id); 
        $data['fotos'] = $this->MarketPlace_model->get_all_fotos_productos(); 


        $data['_view'] = 'marketPlace/tienda';
        $this->load->view('layouts/main',$data);
    }
    function producto($producto_id)
    {   
        //Se envian datos al view de producto.
        $data['producto'] = $this->MarketPlace_model->get_datos_producto($producto_id); 
        $data['categorias'] = $this->MarketPlace_model->get_all_categorias(); 
        $data['fotos'] = $this->MarketPlace_model->get_fotos_producto($producto_id);


        $data['_view'] = 'marketPlace/producto';
        $this->load->view('layouts/main',$data);
    }
    function addProduct($tienda_id){
        
        $this->load->library('form_validation');
        $this->load->helper('date');

        $this->form_validation->set_rules('txt_nombre','Nombre','required|max_length[128]');
        $this->form_validation->set_rules('txt_descripcion','Descripcion','required|max_length[128]');
        $this->form_validation->set_rules('txt_disponibles','Disponibles','required');
        $this->form_validation->set_rules('txt_ubicacion','Ubicacion','required|max_length[128]');
        $this->form_validation->set_rules('txt_precio','Precio','required');
        $this->form_validation->set_rules('txt_tiempo_envio','Tiempo de envio','required');
        $this->form_validation->set_rules('txt_costo_envio','Costo de envio','required');
                
        if (empty($_FILES['txt_foto']['name']))
        {
            $this->form_validation->set_rules('txt_foto', 'Foto del producto', 'required');
        }

        $format = "%Y-%m-%d";

        if($this->form_validation->run())     
        {               
            $params = array(
				'nombre' => $this->input->post('txt_nombre'),				
				'descripcion' => $this->input->post('txt_descripcion'),
                'disponibles' => $this->input->post('txt_disponibles'),
                'ubicacion' => $this->input->post('txt_ubicacion'),
                'fecha_publicacion' =>  mdate($format),
                'precio' => $this->input->post('txt_precio'),
                'tiempo_envio' => $this->input->post('txt_tiempo_envio'),
                'costo_envio' => $this->input->post('txt_costo_envio'),
                'Usuarios_id' => $tienda_id,
            );
            
            $product_id = $this->MarketPlace_model->add_producto($params);
            $this->upload_photo($product_id);

            $data['message_display'] = 'Producto agregado exitosamente.';
            redirect('marketPlace/tienda/'.$tienda_id, 'refresh'); 
        }
        else
        {
            $this->tienda($tienda_id);
        }
    }

    function upload_photo($product_id)
    {
        $num_foto = count($this->MarketPlace_model->get_fotos_producto($product_id)) + 1;

        $config['upload_path']          = './resources/photos/products/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2000; //2MB
        $config['file_name']           = $product_id.$num_foto;
        $config['overwrite']            = true;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('txt_foto'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);

        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $params = array(
                'nombre' => $this->upload->data('file_name'),
                'Productos_id' => $product_id,
            );

            $this->MarketPlace_model->add_foto($params);

            $this->session->set_flashdata('success', "Archivo cargado al sistema exitosamente.");
        }

        redirect('marketPlace/index/');
        // redirect('marketPlace/tienda/'. $producto['']);
    }
}

