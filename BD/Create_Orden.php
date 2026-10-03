<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ID_Orden_de_Trabajo = $_POST['ID_Orden_de_Trabajo'];
    $Fecha_Emision = $_POST['Fecha_Emision'];
    $Fecha_Vencimiento = $_POST['Fecha_Vencimiento'];
    $Descripcion = $_POST['Descripcion'];
    $Codigo_Cliente = $_POST['Codigo_Cliente'];
    $Codigo_Ejecutivo = $_POST['Codigo_Ejecutivo'];

    if (!empty($ID_Orden_de_Trabajo) && !empty($Fecha_Emision) && !empty($Fecha_Vencimiento) && !empty($Descripcion) && !empty($Codigo_Cliente) && !empty($Codigo_Ejecutivo)) {
        $query = "CALL CrearOrdenDeTrabajo(?, ?, ?, ?, ?, ?)";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("ssssss", $ID_Orden_de_Trabajo, $Fecha_Emision, $Fecha_Vencimiento, $Descripcion, $Codigo_Cliente, $Codigo_Ejecutivo);

            if ($stmt->execute()) {
                header("Location: ../Fronted/Orden.php");
                exit(); 
            } else {

                echo "Error al ejecutar la consulta: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $mysqli->error;
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
    $mysqli->close();
} else {
    echo "Método no permitido.";
}
?>
