<?php
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_user($users_id)
    {
        return $this->db->query("SELECT usuarios.idUsuarios , usuarios.email, usuarios.password, usuarios.nombre, usuarios.foto_perfil, usuarios.telefono, usuarios.pais, usuarios.provincia, usuarios.cedula from usuarios WHERE usuarios.idUsuarios = " . $users_id)->row_array();
    }

    function add_user($params)
    {
        $this->db->insert('usuarios', $params);
        return $this->db->insert_id();
    }

    function update_user($users_id, $params)
    {
        $this->db->where('idUsuarios', $users_id);
        return $this->db->update('usuarios', $params);
    }

    function delete_user($users_id)
    {
        return $this->db->delete('users', array('users_id' => $users_id));
    }
}
