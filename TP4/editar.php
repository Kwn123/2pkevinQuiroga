<?php
require_once("conexion.php");

$id = $_GET["id"];

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    $nomJug = $_POST["nomJug"];
    $apeJug = $_POST["apeJug"];
    $edadJug = $_POST["edadJug"];
    $clubJug = $_POST["clubJug"];
    $id2 = $_POST["id"];
    $query = "update jugadoras set nombre = '$nomJug', apellido = '$apeJug', edad = $edadJug, club = '$clubJug' where ID = $id2";
    $stmt = $conexion->prepare($query);
    $stmt -> execute();
    echo("<script>alert('Registro actualizado');</script>");

    $query = "select * from jugadoras where id = $id2";  
    $stmt = $conexion->prepare($query);
    $stmt -> execute();
    $jugadora = $stmt->fetch();

    $i = 0;
    foreach($jugadora as $value){
        if ($i < 1){
        echo($jugadora['nombre']);
        echo"<br>";
        echo($jugadora['apellido']);
        echo"<br>";
        echo($jugadora['edad']);
        echo"<br>";
        echo($jugadora['club']);
        $i ++;
    }
    };
};


$query = "select * from jugadoras where id = $id";
$stmt = $conexion->prepare($query);
$stmt -> execute();
$jugadora = $stmt->fetch();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
    <h2>Editar jugadora</h2>
    <form action="editar.php?id=<?php echo $id ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <label>Nombre: <input type="text" name="nomJug" value="<?php echo $jugadora["nombre"] ?>"></label><br>
        <label>Apellido: <input type="text" name="apeJug" value="<?php echo $jugadora["apellido"] ?>"></label><br>
        <label>Edad: <input type="number" name="edadJug" value="<?php echo $jugadora["edad"] ?>"></label><br>
        <label>Club: <input type="text" name="clubJug" value="<?php echo $jugadora["club"] ?>"></label><br><br>
        <button>Editar</button>
    </form>
    <a href="update.php"><button>Volver</button></a>
</body>
</html>
<?php ?>