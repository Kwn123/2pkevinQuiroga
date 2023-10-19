<?php 
$dni = $_GET["dni"];
?>
<script>
    var alerta = confirm('¿Estás seguro de que deseas eliminar este alumno?');
    if (alerta) {
        window.location = 'eliminarConfirmado.php?dni=<?php echo $dni; ?>';
    } else {
        window.location = './lista.php';
    }
</script>