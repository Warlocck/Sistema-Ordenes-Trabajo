<?php 
include("codigosw2.php");
include("config.php");
include("session.php");

// Comprobar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores del formulario
    $id_ejecutivo_cuentas = $_POST['ID_Ejecutivo_Cuentas'];
    $nombre_completo = $_POST['Nombre_Completo'];
    $apellido_paterno = $_POST['Apellido_Paterno'];
    $apellido_materno = $_POST['Apellido_Materno'];
    $correo_corporativo = $_POST['Correo_Corporativo'];
    $telefono_personal = $_POST['Telefono_Personal'];
    $nombre_usuario = $_POST['Nombre_Usuario'];
    $establecimiento = $_POST['Establecimiento'];
    $contraseña = $_POST['Contraseña'];
    $perfil = $_POST['Perfil'];
    $documento_identidad = $_POST['Documento_Identidad'];
    $tipo_documento = $_POST['Tipo_Documento'];
    $numero_documento = $_POST['Numero_Documento'];
    $fecha_de_nacimiento = $_POST['Fecha_de_Nacimiento'];
    $correo_electronico_personal = $_POST['Correo_Electronico_Personal'];
    $direccion_personal = $_POST['Direccion_Personal'];
    $fecha_de_contratacion = $_POST['Fecha_de_Contratacion'];
    $telefono_corporativo = $_POST['Telefono_Corporativo'];
    $cargo = $_POST['Cargo'];

    // Llamada al procedimiento almacenado
    $query = "CALL ModificarEjecutivo(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    try {
        if ($stmt = $mysqli->prepare($query)) {
            // Enlazar los parámetros
            $stmt->bind_param(
                "sssssssssssssssssss", // Tipos de datos: s = string, d = date
                $id_ejecutivo_cuentas,
                $nombre_completo,
                $apellido_paterno,
                $apellido_materno,
                $correo_corporativo,
                $telefono_personal,
                $nombre_usuario,
                $establecimiento,
                $contraseña,
                $perfil,
                $documento_identidad,
                $tipo_documento,
                $numero_documento,
                $fecha_de_nacimiento,
                $correo_electronico_personal,
                $direccion_personal,
                $fecha_de_contratacion,
                $telefono_corporativo,
                $cargo
            );
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo '<script>';
                echo 'Swal.fire({';
                echo '   icon: "success",';
                echo '   title: "Ejecutivo de Cuentas modificado",';
                echo '   showConfirmButton: false,';
                echo '   timer: 1300';
                echo '}).then(function(result) {';
                echo '   window.location="../Fronted/Ejecutivos.php";';
                echo '});';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'Swal.fire({';
                echo '   icon: "error",';
                echo '   title: "Ejecutivo de Cuentas no modificado",';
                echo '   showConfirmButton: false,';
                echo '   timer: 1300';
                echo '}).then(function(result) {';
                echo '   window.location="../Fronted/Ejecutivos.php";';
                echo '});';
                echo '</script>';
            }
            $stmt->close();
        }
    } catch (mysqli_sql_exception $e) {
        echo '<script>';
        echo 'Swal.fire({';
        echo '   icon: "error",';
        echo '   title: "Error en la modificación",';
        echo '   showConfirmButton: true';
        echo '}).then(function(result) {';
        echo '   window.location="../Fronted/Ejecutivos.php";';
        echo '});';
        echo '</script>';
    }

    $mysqli->close();
} else {
    echo "Acceso no permitido.";
}
