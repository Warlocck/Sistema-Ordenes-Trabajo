<?php
include("codigosw2.php");
include("config.php");
include("session.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Numero_Documento = $_POST['Numero_Documento'];
    $Nacionalidad = $_POST['Nacionalidad'];
    $Nombre = $_POST['Nombre'];
    $Nombre_Comercial = $_POST['Nombre_Comercial'];
    $Correo_Electronico = $_POST['Correo_Electronico'];
    $Telefono = $_POST['Telefono'];
    $Direccion = $_POST['Direccion'];
    $Numero = $_POST['Numero'];
    $Tipo_Via = $_POST['Tipo_Via'];
    $Distrito = $_POST['Distrito'];
    $Ciudad = $_POST['Ciudad'];
    $Dias_Credito = $_POST['Dias_Credito'];
    $Codigo_Interno = $_POST['Codigo_Interno'];
    $Tipo_Cliente = $_POST['Tipo_Cliente'];
    $Codigo_Barra = $_POST['Codigo_Barra'];
    $Ubigeo = $_POST['Ubigeo'];
    $Correos_Opcionales = $_POST['Correos_Opcionales'];
    $Estado_Contribuyente = $_POST['Estado_Contribuyente'];
    $Condicion_Contribuyente = $_POST['Condicion_Contribuyente'];
    $ID_Ejecutivo_Cuentas = $_POST['ID_Ejecutivo_Cuentas'];

    $query = "CALL InsertarCliente(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        if ($stmt = $mysqli->prepare($query)) {
            // Enlazar parámetros
            $stmt->bind_param(
                "ssssssssssssssssssss",
                $Numero_Documento,
                $Nacionalidad,
                $Nombre,
                $Nombre_Comercial,
                $Correo_Electronico,
                $Telefono,
                $Direccion,
                $Numero,
                $Tipo_Via,
                $Distrito,
                $Ciudad,
                $Dias_Credito,
                $Codigo_Interno,
                $Tipo_Cliente,
                $Codigo_Barra,
                $Ubigeo,
                $Correos_Opcionales,
                $Estado_Contribuyente,
                $Condicion_Contribuyente,
                $ID_Ejecutivo_Cuentas,
            );
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo '<script>';
                echo 'Swal.fire({';
                        echo '   icon: "success",';
                        echo '   title: "Nuevo Cliente agregado",';
                        echo '    showConfirmButton: false,';
                        echo '    timer: 1300';
                echo '}).then(function(result) {';
                    echo 'window.location="../Fronted/Clientes.php";';
                echo '});';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'Swal.fire({';
                        echo '   icon: "error",';
                        echo '   title: "Cliente no creado",';
                        echo '   showConfirmButton: false,';
                        echo '   timer: 1300';
                echo '}).then(function(result) {';
                    echo 'window.location="../Fronted/registration_cliente.php";';
                echo '});';
                echo '</script>';
            }
        }
        $stmt->close();


    } catch (mysqli_sql_exception $e) {
        echo '<script>';
        echo 'Swal.fire({';
            echo '   icon: "error",';
            echo '   title: "Error",';
            echo '   showConfirmButton: true,';
        echo '}).then(function(result) {';
            echo 'window.location="../Fronted/registration_cliente.php";';
        echo '});';
        echo '</script>';
    }

    // Cerrar la conexión
    $mysqli->close();
} else {
    echo "Método no permitido.";
}
?>
