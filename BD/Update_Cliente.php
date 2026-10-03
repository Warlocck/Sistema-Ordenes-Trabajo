<?php 
include("codigosw2.php");
include("config.php");
include("session.php");

// Comprobar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores del formulario
    $documento_identidad = $_POST['Documento_Identidad'];
    $tipo_documento = $_POST['Tipo_Documento'];
    $numero_documento = $_POST['Numero_Documento'];
    $nombre = $_POST['Nombre'];
    $nombre_comercial = $_POST['Nombre_Comercial'];
    $correo_electronico = $_POST['Correo_Electronico'];
    $nacionalidad = $_POST['Nacionalidad'];
    $telefono = $_POST['Telefono'];
    $direccion = $_POST['Direccion'];
    $tipo_via = $_POST['Tipo_Via'];
    $numero = $_POST['Numero'];
    $distrito = $_POST['Distrito'];
    $ciudad = $_POST['Ciudad'];
    $dias_credito = $_POST['Dias_Credito'];
    $codigo_interno = $_POST['Codigo_Interno'];
    $tipo_cliente = $_POST['Tipo_Cliente'];
    $codigo_barra = $_POST['Codigo_Barra'];
    $ubigeo = $_POST['Ubigeo'];
    $correos_opcionales = $_POST['Correos_Opcionales'];
    $estado_contribuyente = $_POST['Estado_Contribuyente'];
    $condicion_contribuyente = $_POST['Condicion_Contribuyente'];
    $id_ejecutivo_cuentas = $_POST['ID_Ejecutivo_Cuentas'];

    // Actualizar datos en Ejecutivo_Cuentas y Documento_Ejecutivo
    $query_actualizar = "CALL ModificarCliente(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $mysqli->prepare($query_actualizar)) {
        // Enlazar los parámetros
        $stmt->bind_param(
            "ssssssssssssssssssssss", // Tipos de datos: s = string
            $documento_identidad,
            $tipo_documento,
            $numero_documento,
            $nombre,
            $nombre_comercial,
            $correo_electronico,
            $nacionalidad,
            $telefono,
            $direccion,
            $tipo_via,
            $numero,
            $distrito,
            $ciudad,
            $dias_credito,
            $codigo_interno,
            $tipo_cliente,
            $codigo_barra,
            $ubigeo,
            $correos_opcionales,
            $estado_contribuyente,
            $condicion_contribuyente,
            $id_ejecutivo_cuentas
        );

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo '<script>';
            echo 'Swal.fire({';
            echo '   icon: "success",';
            echo '   title: "Cliente modificado",';
            echo '   showConfirmButton: false,';
            echo '   timer: 1300';
            echo '}).then(function(result) {';
            echo '   window.location="../Fronted/Clientes.php";';
            echo '});';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'Swal.fire({';
            echo '   icon: "error",';
            echo '   title: "Error al modificar el Cliente",';
            echo '   showConfirmButton: true';
            echo '}).then(function(result) {';
            echo '   window.location="../Fronted/Clientes.php";';
            echo '});';
            echo '</script>';
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta de actualización: " . $mysqli->error;
        exit;
    }

    $mysqli->close();
} else {
    echo "Acceso no permitido.";
}
?>
