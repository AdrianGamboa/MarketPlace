<?php 
class Reportes extends CI_Controller{
      function __construct() { 
            parent::__construct();
            $this->load->model('Producto_model');
            $this->load->library('Pdf');
      } 
     function ReporteProductos()
      {
            $data['producto'] = $this->Producto_model->get_all_categorias();
            $data['_view'] = 'reports/Reporte_productos';
            $this->load->view('layouts/main',$data);
      }
}
?>