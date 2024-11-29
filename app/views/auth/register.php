<?php $title = 'Registro'; ?>
<h2>Registro de Usuario</h2>
<form id="registerForm" action="<?php echo $base_url; ?>auth/handleRegister" method="POST">
    <label for="first_name">Nombre:</label>
    <input type="text" id="first_name" name="first_name" required>

    <label for="last_name">Apellido:</label>
    <input type="text" id="last_name" name="last_name" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>
    <p id="emailMessage"></p>

    <label for="phone">Teléfono:</label>
    <input type="text" id="phone" name="phone" pattern="[0-9]{8}" required>

    <label for="username">Usuario:</label>
    <input type="text" id="username" name="username" required>
    <p id="usernameMessage"></p>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">Confirmar Contraseña:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <button type="submit">Registrar</button>
</form>