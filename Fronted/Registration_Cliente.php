<?php
require_once "vistas/parte_superior.php"
?>
<?php
include("../BD/config.php");
?>
<!--INICIO del cont principal-->
<div class="container">
    <Center>
        <h1>Registrar un nuevo Cliente</h1>
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
                                    <form action="../BD/Register_Cliente.php" method="POST">
                                        <div class="modal-body">
                                            
                                            <label class="col-form-label">Tipo de Documento:</label>
                                                <select id="Tipo_de_Documento" name="Tipo_de_Documento" required style="width: 100%; margin-bottom: 15px; padding: 10px 0; padding-left: 4px; border: 0; border-bottom: 1px solid #5cb8ff; font-size: 17px; border-radius: 3px;">
                                                <option value="DNI">DNI</option>
                                                <option value="RUC">RUC</option>
                                                <option value="PAS">Pasaporte</option>
                                                <option value="CAREXT">Carnet de Extranjeria</option>
                                                <option value="OTRO">Otros</option>
                                                </select>

                                            <div class="form-group">
                                                <label for="Numero_Documento" class="col-form-label">Número de Documento: </label>
                                                <input id="Numero_Documento" type="text" class="form-control" placeholder="" name="Numero_Documento" required>
                                                <div id="mensajeError" style="display: none; color: red; margin-top: 10px;"></div>
                                            </div>

                                            <script>
                                                const tipoDocumento = document.getElementById("Tipo_de_Documento");
                                                const campoIDCliente = document.getElementById("Numero_Documento");
                                                const mensajeError = document.getElementById("mensajeError");

                                                campoIDCliente.addEventListener("input", validarIDCliente);

                                                tipoDocumento.addEventListener("change", () => {
                                                    campoIDCliente.value = "";
                                                    mensajeError.style.display = "none";
                                                });
                                                function validarIDCliente() {
                                                    const seleccionado = tipoDocumento.value;
                                                    const valorIDCliente = campoIDCliente.value;

                                                    let longitudEsperada;

                                                    switch (seleccionado) {
                                                        case "DNI":
                                                            longitudEsperada = 8;
                                                            break;
                                                        case "RUC":
                                                            longitudEsperada = 11;
                                                            break;
                                                        case "Pasaporte":
                                                            longitudEsperada = 9;
                                                            break;
                                                        case "Carnet de Extranjeria":
                                                            longitudEsperada = 8;
                                                            break;
                                                        default:
                                                            longitudEsperada = 0;
                                                    }
                                                    if (valorIDCliente.length !== longitudEsperada) {
                                                        mensajeError.innerText = `El número de ${seleccionado} debe tener ${longitudEsperada} dígitos.`;
                                                        mensajeError.style.display = "block";
                                                    } else {
                                                        mensajeError.style.display = "none";
                                                    }
                                                }
                                            </script>

                                            <div class="form-group">
                                                <label for="Nacionalidad" class="col-form-label">Nacionalidad:</label>
                                                <input type="text" class="form-control" placeholder="" name="Nacionalidad" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="Nombre" class="col-form-label">Nombre:</label>
                                                <input type="text" class="form-control" placeholder="" name="Nombre" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="Nombre_Comercial" class="col-form-label">Nombre Comercial:</label>
                                                <input type="text" class="form-control" placeholder="" name="Nombre_Comercial">
                                            </div>
                                            <div class="form-group">
                                                <label for="Correo_Electronico" class="col-form-label">Correo Electronico:</label>
                                                <input type="Email" class="form-control" placeholder="" name="Correo_Electronico" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Telefono" class="col-form-label">Telefono:</label>
                                                <input type="number" class="form-control" placeholder="" name="Telefono" required pattern="[0-9]{9}">
                                            </div>                                               
                                            <div class="form-group">
                                                <label for="Direccion" class="col-form-label">Direccion:</label>
                                                <input type="text" class="form-control" placeholder="" name="Direccion" required>
                                            </div>                                                 
                                            <div class="form-group">
                                                <label for="Numero" class="col-form-label">Numero:</label>
                                                <input type="text" class="form-control" placeholder="" name="Numero" required>
                                            </div>                                    
                                            <div class="form-group">
                                                <label for="Tipo_Via" class="col-form-label">Tipo de Vía:</label>
                                                <input type="text" class="form-control" placeholder="" name="Tipo_Via" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="Distrito" class="col-form-label">Distrito:</label>
                                                <input type="text" class="form-control" placeholder="" name="Distrito" required>
                                            </div>
                                                                                        
                                            <div class="form-group">
                                                <label for="Ciudad" class="col-form-label">Ciudad:</label>
                                                <input type="text" class="form-control" placeholder="" name="Ciudad" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Dias_Credito" class="col-form-label">Dias de crédito:</label>
                                                <input type="text" class="form-control" placeholder="" name="Dias_Credito" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Codigo_Interno" class="col-form-label">Código interno:</label>
                                                <input type="text" class="form-control" placeholder="" name="Codigo_Interno" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Tipo_Cliente" class="col-form-label">Tipo de Cliente:</label>
                                                <input type="text" class="form-control" placeholder="" name="Tipo_Cliente" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Codigo_Barra" class="col-form-label">Código de barra:</label>
                                                <input type="text" class="form-control" placeholder="" name="Codigo_Barra" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Ubigeo" class="col-form-label">Ubigeo:</label>
                                                <input type="text" class="form-control" placeholder="" name="Ubigeo" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Correos_Opcionales" class="col-form-label">Correos Opcionales:</label>
                                                <input type="Email" class="form-control" placeholder="" name="Correos_Opcionales">
                                            </div>
                                            <div class="form-group">
                                                <label for="Estado_Contribuyente" class="col-form-label">Estado del Contribuyente:</label>
                                                <input type="text" class="form-control" placeholder="" name="Estado_Contribuyente" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="Condicion_Contribuyente" class="col-form-label">Condición del Contribuyente:</label>
                                                <input type="text" class="form-control" placeholder="" name="Condicion_Contribuyente" required>
                                            </div>
                                            <?php
                                                // Asegúrate de haber establecido la conexión a la base de datos antes de esto
                                                // $mysql es la variable que representa la conexión a la base de datos
                                                $resultEjecutivo = mysqli_query($mysqli, "SELECT * FROM Ejecutivo_cuentas");

                                                echo "<div class='form-group'>";
                                                echo "<label for='ID_Ejecutivo_Cuentas' class='col-form-label'>Ejecutivo de Cuentas:</label>";
                                                echo "<select id='ID_Ejecutivo_Cuentas' name='ID_Ejecutivo_Cuentas' required style='width: 100%; margin-bottom: 15px; padding: 10px 0; padding-left: 4px; border: 0; border-bottom: 1px solid #5cb8ff; font-size: 17px; border-radius: 3px;'>";

                                                // Verifica si hay resultados
                                                if ($resultEjecutivo) {
                                                    // Itera sobre los resultados de la consulta y crea las opciones del select
                                                    while ($rowEjecutivo = mysqli_fetch_assoc($resultEjecutivo)) {
                                                        echo "<option value='{$rowEjecutivo['ID_Ejecutivo_Cuentas']}'>{$rowEjecutivo['Nombre_Completo']}</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No hay ejecutivos de cuentas disponibles</option>";
                                                }

                                                echo "</select>";
                                                echo "</div>";
                                            ?>

                                        </div>
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-light" onclick="history.back()" data-dismiss="modal">Cancelar</a>
                                            <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                                        </div>
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