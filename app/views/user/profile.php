<?php $title = 'Perfil de Usuario'; ?>
<h2>Perfil de Usuario</h2>
<form id="profileForm" action="<?php echo $base_url; ?>/user/updateProfile" method="POST">
    <label for="first_name">Nombre:</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo $data['user']['first_name']; ?>" required>

    <label for="last_name">Apellido:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo $data['user']['last_name']; ?>" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" value="<?php echo $data['user']['email']; ?>" required>

    <label for="phone">Teléfono:</label>
    <input type="text" id="phone" name="phone" value="<?php echo $data['user']['phone']; ?>" pattern="[0-9]{8}"
        required>

    <label for="username">Usuario (no editable):</label>
    <input type="text" id="username" name="username" value="<?php echo $data['user']['username']; ?>" readonly>

    <button type="submit">Actualizar Perfil</button>
</form>
<a href="<?php echo $base_url; ?>/user/dashboard">Volver al Dashboard</a>
<a href="<?php echo $base_url; ?>/auth/logout">Cerrar Sesión</a>