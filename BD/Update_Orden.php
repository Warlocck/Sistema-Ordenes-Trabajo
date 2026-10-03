<?php
include("config.php"); // Archivo de configuración de la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $ID_Orden_de_Trabajo = $_POST['ID_Orden_de_Trabajo'];
    $Fecha_Emision = $_POST['Fecha_Emision'];
    $Fecha_Vencimiento = $_POST['Fecha_Vencimiento'];
    $Descripcion = $_POST['Descripcion'];
    $Codigo_Cliente = $_POST['Codigo_Cliente'];
    $Codigo_Ejecutivo = $_POST['Codigo_Ejecutivo'];

    // Procedimiento almacenado para actualizar la orden de trabajo
    $query = "CALL ModificarOrdenDeTrabajo(?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($query)) {
        // Vincula los parámetros
        $stmt->bind_param(
            "ssssss",
            $ID_Orden_de_Trabajo,
            $Fecha_Emision,
            $Fecha_Vencimiento,
            $Descripcion,
            $Codigo_Cliente,
            $Codigo_Ejecutivo
        );

        // Ejecuta la consulta
        if ($stmt->execute()) {
            // Redirección al listado de órdenes de trabajo después de actualizar
            header("Location: ../Fronted/Orden.php"); // Asegúrate de que esta ruta sea correcta
            exit;
        } else {
            // Mostrar un error si no se pudo ejecutar el procedimiento almacenado
            echo "Error al actualizar la orden: " . $mysqli->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "Método no permitido.";
}
