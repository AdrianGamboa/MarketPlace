<?php 
class Reporte extends CI_Controller{
      function __construct() { 
            parent::__construct();
            $this->load->model('Reporte_model');
            $this->load->library('Pdf');
      } 
     function ReporteProductos()
      {
            $params = array(                
                  'categorias_id' => $this->input->post('txt_categorias_id'),
                  'rangoPrecio' => $this->input->post('txt_rangoPrecio'),
                  'rangoFecha1' => $this->input->post('txt_rangoFecha1'),
                  'rangoFecha2' => $this->input->post('txt_rangoFecha2'),                
              );
            
            $data['producto'] = $this->Reporte_model->get_productos_baratos($params);
            $data['_view'] = 'reports/Reporte_productos';
            $this->load->view('layouts/main',$data);
      }
}
?>