<?php if (!empty($this->session)) { 
		if($this->session->flashdata('error')){ echo "<div class='msg_box_user error' >" .  $this->session->flashdata('error') . "</div>"; } 
		if($this->session->flashdata('success')){ echo "<div class='msg_box_user success' >" .  $this->session->flashdata('success') . "</div>"; } 
} ?>

<?php if($this->session->userdata['logged_in']['users_id']==$user['idUsuarios'] && $this->session->userdata['logged_in']['logged_in']==TRUE ){ ?>

	<div id="panel_app">
	    <div class="box-header">
	      	<h2 class="box-title lbls_">Editando Usuario</h2>
	      	<?php echo form_open('marketPlace/index');?>
		    	<button type="submit" name="btn_return" id="btn_return" class="boton" title="Regresar">←</button>
		    <?php echo form_close();?>
	    </div>
		<div id="edit_panel">

			<div class="" >
					<?php echo "<img src='" . site_url('resources/photos/' . $this->session->userdata['logged_in']['photo']) 
						. "' alt='Editar Foto' title='Editar Foto' width=70 height=70 id='photo_profile' />"; ?>
					<br>
					<?php echo form_open_multipart('user/upload_photo/' . $user['idUsuarios']);?>
						<input type="file" name="txt_file" size="20" class="btn btn-info" accept="image/jpeg,image/gif,image/png" />
						<br><br>
						<button type="submit" class="boton">Cargar Foto</button>
					<?php echo form_close(); ?>
				</div>

			<?php echo form_open('user/edit/'.$user['idUsuarios']); ?>	  	
		
			<div id = "datos_box">
				<label for="txt_nombre" class="control-label lbls_"><span class="text-danger">* </span>Nombre:</label>
				<div class="form-group">
					<input type="text" name="txt_nombre" value="<?php echo ($this->input->post('txt_nombre') ? $this->input->post('txt_nombre') : $user['nombre']); ?>" class="cajatexto" id="txt_nombre" />
					<span class="text-danger"><?php echo form_error('txt_nombre');?></span>
				</div>

				<label for="txt_cedula" class="control-label lbls_"><span class="text-danger">* </span>Cedula:</label>
				<div class="form-group">
					<input type="text" name="txt_cedula" value="<?php echo ($this->input->post('txt_cedula') ? $this->input->post('txt_cedula') : $user['cedula']); ?>" class="cajatexto" id="txt_cedula" />
					<span class="text-danger"><?php echo form_error('txt_cedula');?></span>
				</div>

				<label for="txt_correo" class="control-label lbls_"><span class="text-danger">* </span>Correo:</label>
				<div class="form-group">
					<input type="text" name="txt_correo" value="<?php echo ($this->input->post('txt_correo') ? $this->input->post('txt_correo') : $user['email']); ?>" class="cajatexto" id="txt_correo" />
					<span class="text-danger"><?php echo form_error('txt_correo');?></span>
				</div>
				
				<label for="txt_telefono" class="control-label lbls_"><span class="text-danger">* </span>Telefono:</label>
				<div class="form-group">
					<input type="text" name="txt_telefono" value="<?php echo ($this->input->post('txt_telefono') ? $this->input->post('txt_telefono') : $user['telefono']); ?>" class="cajatexto" id="txt_telefono" />
					<span class="text-danger"><?php echo form_error('txt_telefono');?></span>
				</div>
				
				<label for="txt_pais" class="control-label lbls_"><span class="text-danger">* </span>Pais:</label>
				<div class="form-group">
					<input type="text" name="txt_pais" value="<?php echo ($this->input->post('txt_pais') ? $this->input->post('txt_pais') : $user['pais']); ?>" class="cajatexto" id="txt_pais" />
					<span class="text-danger"><?php echo form_error('txt_pais');?></span>
				</div>

				<label for="txt_provincia" class="control-label lbls_"><span class="text-danger">* </span>Provincia:</label>
				<div class="form-group">
					<input type="text" name="txt_provincia" value="<?php echo ($this->input->post('txt_provincia') ? $this->input->post('txt_provincia') : $user['provincia']); ?>" class="cajatexto" id="txt_provincia" />
					<span class="text-danger"><?php echo form_error('txt_provincia');?></span>
				</div>

				<label for="txt_clave" class="control-label lbls_"><span class="text-danger">* </span>Contraseña:</label>
				<div class="form-group">
					<input type="password" name="txt_clave" value="<?php echo $this->input->post('txt_clave'); ?>" class="cajatexto" id="txt_clave" />
					<span class="text-danger"><?php echo form_error('txt_clave');?></span>
				</div>
				
			</div>
			
          	<br><br>
		  	<div class="box-footer">
		    	<button type="submit" class="boton">Guardar</button>
		  	</div>
			  
	        <div id="actions">
				<a href="<?php echo site_url('auth/logout'); ?>" id="btn_salir" name="btn_salir" title="Salir">🚪 Cerrar sesión</a>  		
			  	<br>
              	<a href="<?php echo site_url('user/delete/' . $user['idUsuarios']); ?>" id="btn_eliminar" name="btn_eliminar" title="Eliminar">🗙 Eliminar mi cuenta</a>
          	</div>
	    <?php echo form_close(); ?>

		    
		</div>
	</div>

<?php 
    }else {
        header("location: " . base_url());
    } 
?>