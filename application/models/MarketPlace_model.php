<?php
class MarketPlace_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_tiendas()
    {
        return $this->db->query("SELECT usuarios.idUsuarios, usuarios.nombre, usuarios.foto_perfil
                                FROM usuarios
                                WHERE usuarios.tipo = 'Tienda'
                                ORDER BY usuarios.idUsuarios DESC")->result_array();
    }
    function get_all_categorias()
    {
        return $this->db->query("SELECT categorias.idCategorias, categorias.nombre
                                FROM categorias                                
                                ORDER BY categorias.idCategorias DESC")->result_array();
    }
    function get_productos_tienda($users_id)
    {
        return $this->db->query("SELECT productos.idProductos, productos.nombre, productos.descripcion, productos.disponibles, productos.fecha_publicacion, productos.ubicacion, productos.precio, productos.tiempo_envio, productos.costo_envio
                                FROM productos
                                INNER JOIN usuarios ON usuarios.idUsuarios = productos.Usuarios_id
                                WHERE productos.Usuarios_id = $users_id
                                ORDER BY usuarios.idUsuarios DESC")->result_array();
    }
    function get_all_fotos_productos() //Obtiene todas las fotos de los productos
    {
        return $this->db->query("SELECT fotografias.idFotografias, fotografias.nombre, fotografias.descripcion, fotografias.Productos_id
                                FROM fotografias
                                ORDER BY fotografias.idFotografias ASC")->result_array();
    }
    function get_fotos_producto($producto_id) //Obtiene las fotos de un unico producto
    {
        return $this->db->query("SELECT fotografias.idFotografias, fotografias.nombre, fotografias.descripcion, fotografias.Productos_id
                                FROM fotografias
                                WHERE fotografias.Productos_id = $producto_id
                                ORDER BY fotografias.idFotografias ASC")->result_array();
    }
    function get_datos_tienda($users_id)
    {
        return $this->db->query("SELECT usuarios.idUsuarios , usuarios.email, usuarios.password, usuarios.nombre, usuarios.foto_perfil, usuarios.telefono, usuarios.pais, usuarios.provincia, usuarios.cedula from usuarios WHERE usuarios.idUsuarios = " . $users_id)->row_array();
    }
    function get_datos_producto($product_id)
    {
        return $this->db->query("SELECT productos.idProductos, productos.nombre, productos.descripcion, productos.disponibles, productos.fecha_publicacion, productos.ubicacion, productos.precio, productos.tiempo_envio, productos.costo_envio, productos.Usuarios_id
                                FROM productos
                                WHERE productos.idProductos = $product_id
                                ORDER BY productos.idProductos DESC")->row_array();
    }
    function get_redes_tienda($users_id)
    {
        return $this->db->query("SELECT redes_sociales.nombre, redes_sociales_usuarios.url
                                FROM redes_sociales_usuarios 
                                INNER JOIN redes_sociales ON redes_sociales.idRedes_Sociales = redes_sociales_usuarios.Redes_Sociales_id
                                WHERE redes_sociales_usuarios.Usuarios_id = " . $users_id)->result_array();
    }
    function add_producto($params)
    {
        $this->db->insert('productos', $params);
        return $this->db->insert_id();
    }
    function add_foto($params)
    {
        $this->db->insert('fotografias', $params);
        return $this->db->insert_id();
    }
}
