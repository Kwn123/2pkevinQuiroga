
<script>
    var alerta = confirm('¿Estás seguro de que deseas eliminar a TODOS LOS ALUMNOS?');
    if (alerta) {
        window.location = '../ABM/lista.php?eliminar=true>';
    } else {
        window.location = '../index.php';
    }
</script>