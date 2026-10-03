<?php
require_once "vistas/parte_superior.php";
?>
<?php
include("../BD/config.php");
$id = $_GET['id']; // Obtiene el ID de la orden de trabajo desde la URL
?>
<!--INICIO del cont principal-->
<div class="container">
    <Center>
        <h1>Modificar Ejecutivo de Cuentas</h1>
    </Center>
    <div class="container">
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <div aria-labelledby="exampleModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <a type="button" class="close" data-dismiss="modal" onclick="history.back()" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                                    </div>
                                    <form action="../BD/Update_Ejecutivo.php" method="POST">
                                    <?php
                                    $result = mysqli_query($mysqli, "SELECT * FROM Ejecutivo_Cuentas WHERE ID_Ejecutivo_Cuentas= '$id'");
                                    if (mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        echo "<input type='hidden' name='id' value='{$row['ID_Ejecutivo_Cuentas']}' required>";
                                        echo "<div class='modal-body'>";
                                        echo "<div class='form-group'>";
                                        echo "       <input hidden type='text' class='form-control' name='ID_Ejecutivo_Cuentas' value='{$row['ID_Ejecutivo_Cuentas']}' required>";
                                        echo "</div>";
                                        echo "<div class='form-group'>";
                                        echo "       <input hidden type='text' class='form-control' name='Documento_Identidad' value='{$row['Documento_Identidad']}' required>";
                                        echo "</div>";
                                        $resultDocumento = mysqli_query($mysqli, "SELECT * FROM Documento_Ejecutivo WHERE Documento_Identidad = '" . mysqli_real_escape_string($mysqli, $row['Documento_Identidad']) . "'");
                                        $rowDocumento = mysqli_fetch_assoc($resultDocumento);
                                        echo "<div class='form-group'>";
                                        echo "       <label for='Tipo_Documento' class='col-form-label'>Tipo de documento:</label>";
                                        echo "       <input type='text' class='form-control' name='Tipo_Documento' value='{$rowDocumento['Tipo_Documento']}' required>";
                                        echo "</div>";
                                        echo "<div class='form-group'>";
                                        echo "       <label for='Numero_Documento' class='col-form-label'>Número de documento:</label>";
                                        echo "       <input type='text' class='form-control' name='Numero_Documento' value='{$rowDocumento['Numero_Documento']}' required>";
                                        echo "</div>";
                                        echo "<div class='form-group'>";
                                        echo "       <label for='Cargo' class='col-form-label'>Cargo:</label>";
                                        echo "       <input type='text' class='form-control' name='Cargo' value='{$row['Cargo']}' required>";
                                        echo "</div>";
                                        echo "   <div class='form-group'>";
                                        echo "       <label for='Nombre_Completo' class='col-form-label'>Nombre:</label>";
                                        echo "       <input type='text' class='form-control' name='Nombre_Completo' value='{$row['Nombre_Completo']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        $resultNombre = mysqli_query($mysqli, "SELECT * FROM Nombre_Ejecutivo WHERE Nombre_Completo = '" . mysqli_real_escape_string($mysqli, $row['Nombre_Completo']) . "'");
                                        $rowNombre = mysqli_fetch_assoc($resultNombre);
                                        echo "        <label for='Apellido_Paterno' class='col-form-label'>Apellido Paterno:</label>";
                                        echo "        <input type='text' class='form-control' name='Apellido_Paterno' value='{$rowNombre['Apellido_Paterno']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Apellido_Materno' class='col-form-label'>Apellido Materno:</label>";
                                        echo "        <input type='text' class='form-control' name='Apellido_Materno' value='{$rowNombre['Apellido_Materno']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Telefono_Personal' class='col-form-label'>Telefono Personal:</label>";
                                        echo "        <input type='text' class='form-control' name='Telefono_Personal' value='{$row['Telefono_Personal']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Telefono_Corporativo' class='col-form-label'>Telefono Corporativo:</label>";
                                        echo "        <input type='text' class='form-control' name='Telefono_Corporativo' value='{$row['Telefono_Corporativo']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Correo_Electronico_Personal' class='col-form-label'>Correo Electronico Personal:</label>";
                                        echo "        <input type='email' class='form-control' name='Correo_Electronico_Personal' value='{$row['Correo_Electronico_Personal']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Correo_Corporativo' class='col-form-label'>Correo Corporativo:</label>";
                                        echo "        <input type='email' class='form-control' name='Correo_Corporativo' value='{$row['Correo_Corporativo']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Establecimiento' class='col-form-label'>Establecimiento:</label>";
                                        echo "        <input type='text' class='form-control' name='Establecimiento' value='{$row['Establecimiento']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Perfil' class='col-form-label'>Perfil:</label>";
                                        echo "        <input type='text' class='form-control' name='Perfil' value='{$row['Perfil']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Fecha_de_Nacimiento' class='col-form-label'>Fecha de Nacimiento:</label>";
                                        echo "        <input type='date' class='form-control' name='Fecha_de_Nacimiento' value='{$row['Fecha_de_Nacimiento']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Direccion_Personal' class='col-form-label'>Dirección Personal:</label>";
                                        echo "        <input type='text' class='form-control' name='Direccion_Personal' value='{$row['Direccion_Personal']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Fecha_de_Contratacion' class='col-form-label'>Fecha de Contratación:</label>";
                                        echo "        <input type='date' class='form-control' name='Fecha_de_Contratacion' value='{$row['Fecha_de_Contratacion']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Nombre_Usuario' class='col-form-label'>Nombre de usuario:</label>";
                                        echo "        <input type='text' class='form-control' name='Nombre_Usuario' value='{$row['Nombre_Usuario']}' required>";
                                        echo "    </div>";
                                        echo "    <div class='form-group'>";
                                        echo "        <label for='Contraseña' class='col-form-label'>Contraseña:</label>";
                                        echo "        <input type='text' class='form-control' name='Contraseña' value='{$row['Contraseña']}' required>";
                                        echo "    </div>";
                                        echo "</div>";
                                        echo "<div class='modal-footer'>";
                                        echo "<a type='button' class='btn btn-light' onclick='history.back()' data-dismiss='modal'>Cancelar</a>";
                                        echo "<button type='submit' class='btn btn-dark'>Guardar</button>";
                                        echo "</div>";
                                    } else {
                                        echo "Ejecutivo no encontrado.";
                                    }
                                    ?>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php" ?>
