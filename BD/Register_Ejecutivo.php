<?php
include("codigosw2.php");
include("config.php");
include("session.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nombre_Completo = $_POST['Nombre_Completo'];
    $Apellido_Paterno = $_POST['Apellido_Paterno'];
    $Apellido_Materno = $_POST['Apellido_Materno'];
    $Correo_Corporativo = $_POST['Correo_Corporativo'];
    $Telefono_Personal = $_POST['Telefono_Personal'];
    $Nombre_Usuario = $_POST['Nombre_Usuario'];
    $Establecimiento = $_POST['Establecimiento'];
    $Contraseña = $_POST['Contraseña'];
    $Perfil = $_POST['Perfil'];
    $Tipo_Documento = $_POST['Tipo_Documento'];
    $Numero_Documento = $_POST['Numero_Documento'];
    $Fecha_de_Nacimiento = $_POST['Fecha_de_Nacimiento'];
    $Correo_Electronico_Personal = $_POST['Correo_Electronico_Personal'];
    $Direccion_Personal = $_POST['Direccion_Personal'];
    $Fecha_de_Contratacion = $_POST['Fecha_de_Contratacion'];
    $Telefono_Corporativo = $_POST['Telefono_Corporativo'];
    $Cargo = $_POST['Cargo'];

    $query = "CALL InsertarEjecutivo(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        if ($stmt = $mysqli->prepare($query)) {
            // Enlazar parámetros
            $stmt->bind_param(
                "sssssssssssssssss",
                $Nombre_Completo,
                $Apellido_Paterno,
                $Apellido_Materno,
                $Correo_Corporativo,
                $Telefono_Personal,
                $Nombre_Usuario,
                $Establecimiento,
                $Contraseña,
                $Perfil,
                $Tipo_Documento,
                $Numero_Documento,
                $Fecha_de_Nacimiento,
                $Correo_Electronico_Personal,
                $Direccion_Personal,
                $Fecha_de_Contratacion,
                $Telefono_Corporativo,
                $Cargo,
            );
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo '<script>';
                echo 'Swal.fire({';
                    echo '   icon: "success",';
                    echo '   title: "Ejecutivo de Cuentas agregado",';
                    echo '    showConfirmButton: false,';
                    echo '    timer: 1300';
                echo '}).then(function(result) {';
                    echo 'window.location="../Fronted/Ejecutivos.php";';
                echo '});';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'Swal.fire({';
                    echo '   icon: "error",';
                    echo '   title: "Ejecutivo de Cuentas no creado",';
                    echo '   showConfirmButton: false,';
                    echo '   timer: 1300';
                echo '}).then(function(result) {';
                    echo 'window.location="../Fronted/Ejecutivos.php";';
                echo '});';
                echo '</script>';
            }
    
            $stmt->close();
        }
    } catch (mysqli_sql_exception $e) {
        echo '<script>';
        echo 'Swal.fire({';
            echo '   icon: "error",';
            echo '   title: "Ejecutivo de Cuentas no creado",';
            echo '   showConfirmButton: true,';
        echo '}).then(function(result) {';
            echo 'window.location="../Fronted/Registration_Ejecutivo.php";';
        echo '});';
        echo '</script>';
    }
    

    // Cerrar la conexión
    $mysqli->close();
} else {
    echo "ERROR";
}
?>
