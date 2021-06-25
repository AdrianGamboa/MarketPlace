<?php
class Reporte_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_productos_baratos($params) // Obtiene los productos filtrados por rango de precio, fecha de publicación y categoría
    {
        return $this->db->query("SELECT productos.nombre, productos.precio, categorias.nombre as categoria, usuarios.nombre as tienda, productos.fecha_publicacion, productos.ubicacion
                                FROM productos 
                                INNER JOIN productos_categorias ON productos_categorias.Productos_id = productos.idProductos
                                INNER JOIN categorias ON categorias.idCategorias = productos_categorias.Categorias_id                       
                                INNER JOIN usuarios ON usuarios.idUsuarios = productos.Usuarios_id  

                                WHERE productos.precio <= " . $params['rangoPrecio'] ." AND productos.fecha_publicacion > '" . $params['rangoFecha1'] ."' AND 
                                productos.fecha_publicacion < '" . $params['rangoFecha2'] ."' AND productos_categorias.Categorias_id = " . $params['categorias_id'] ."
                                ORDER BY productos.precio ASC")->result_array();
    }

    
}