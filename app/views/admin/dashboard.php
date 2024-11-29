<?php $title = 'Dashboard de Administración'; ?>
<div class="admin-dashboard">
    <h2>Dashboard de Administración</h2>
    <input type="text" id="search" placeholder="Buscar usuarios por nombre o correo">
    <div id="search-results">
        <!-- Resultados de búsqueda aparecerán aquí -->
    </div>
    <form action="<?php echo $base_url; ?>auth/logout" method="POST">
        <button type="submit" class="logout-button">Cerrar Sesión</button>
    </form>
</div>