<?php $title = 'Inicio de Sesión'; ?>
<h2>Iniciar Sesión</h2>
<form id="loginForm" action="<?php echo $base_url; ?>auth/handleLogin" method="POST">
    <label for="username">Usuario:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Ingresar</button>
</form>
<p>¿No tienes una cuenta? <a href="<?php echo $base_url; ?>auth/register">Regístrate aquí</a></p>