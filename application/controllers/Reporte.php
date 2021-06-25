<?php 
class Reporte extends CI_Controller{
      function __construct() { 
            parent::__construct();
            $this->load->model('Reporte_model');
            $this->load->library('Pdf');
            $this->load->library('session');
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

      function ReporteSuscripciones($users_id){

            $data['suscripciones'] = $this->Reporte_model->get_suscripciones($users_id);
            $data['_view'] = 'reports/Reporte_suscripciones';
            $this->load->view('layouts/main',$data);
      }

      function ReporteFactura()
      {
            $params = array(                
                  'venta_id' => 1,    
            );
            
            $data['producto'] = $this->Reporte_model->get_facturaProductos(4);
            $data['venta'] = $this->Reporte_model->get_facturaVenta(4);
            $data['_view'] = 'reports/Reporte_factura';
            $this->load->view('layouts/main',$data);
      }

      function ReporteCompras(){

            $params = array(                
                  'users_id' => $this->session->userdata['logged_in']['users_id'],
                  'rangoFecha1' => $this->input->post('txt_rangoFecha1'),
                  'rangoFecha2' => $this->input->post('txt_rangoFecha2'),                
              );
            
            $data['compras'] = $this->Reporte_model->get_productos_comprados($params);
            $data['_view'] = 'reports/Reporte_compras';
            $this->load->view('layouts/main',$data);
      }

      function ReporteVentas(){

            $params = array(                
                  'users_id' => 4,
                  'rangoFecha1' => $this->input->post('txt_rangoFecha1'),
                  'rangoFecha2' => $this->input->post('txt_rangoFecha2'),                
              );
            
            $data['ventas'] = $this->Reporte_model->get_productos_ventas($params);
            $data['_view'] = 'reports/Reporte_ventas';
            $this->load->view('layouts/main',$data);
      }
}
?>