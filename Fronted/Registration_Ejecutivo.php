<?php
require_once "vistas/parte_superior.php"
?>
<!--INICIO del cont principal-->
<div class="container">
    <Center>
        <h1>Registrar un nuevo Ejecutivo de Cuentas</h1>
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
                                    <form action="../BD/Register_Ejecutivo.php" method="POST">
                                        <div class="modal-body">
                                            <!-- <div class="form-group">
                                                <select type="select" name="T_Documento" required="" style=" width: 100%;margin-bottom: 15px;padding: 10px 0;padding-left: 4px;border: 0;border-bottom: 1px solid #5cb8ff;font-size: 17px;border-radius: 3px;">
                                                    <option value=""> Seleccione </option>
                                                    <option value="DNI"> DNI </option>
                                                    <option value="RUC"> RUC </option>
                                                    <option value="Pasaporte"> Pasaporte </option>
                                                    <option value="Carnet de Extranjeria"> Carnet de Extranjeria </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="ID_Vendedor" class="col-form-label">N. Documento :</label>
                                                <input type="text" class="form-control" placeholder="" name="ID_Vendedor" required>
                                            </div> -->
                                            <div class="form-group">
                                        
                                        <label class="col-form-label">Tipo de Documento:</label>
                                        <select id="Tipo_Documento" name="Tipo_Documento" required style="width: 100%; margin-bottom: 15px; padding: 10px 0; padding-left: 4px; border: 0; border-bottom: 1px solid #5cb8ff; font-size: 17px; border-radius: 3px;">
                                        <option value="DNI">DNI</option>
                                        <option value="RUC">RUC</option>
                                        <option value="PAS">Pasaporte</option>
                                        <option value="CAREXT">Carnet de Extranjeria</option>
                                        <option value="OTRO">Otros</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Numero_Documento" class="col-form-label">Número de Documento :</label>
                                    <input id="Numero_Documento" type="text" class="form-control" placeholder="" name="Numero_Documento" required>
                                    <div id="mensajeError" style="display: none; color: red; margin-top: 10px;"></div>
                                </div>

                                <script>
                                    const tipoDocumento = document.getElementById("Tipo_Documento");
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
                                                <label for="Cargo" class="col-form-label">Cargo:</label>
                                                <input type="text" class="form-control" placeholder="" name="Cargo"  required>
                                            </div>

                                            <div class="form-group">
                                                <label for="Nombre_Completo" class="col-form-label">Nombre:</label>
                                                <input type="text" class="form-control" placeholder="" name="Nombre_Completo"  required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Apellido_Paterno" class="col-form-label">Apellidos Paterno:</label>
                                                <input type="text" class="form-control" placeholder="" name="Apellido_Paterno"  required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Apellido_Materno" class="col-form-label">Apellidos Materno:</label>
                                                <input type="text" class="form-control" placeholder="" name="Apellido_Materno"  required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Telefono_Personal" class="col-form-label">Telefono Personal:</label>
                                                <input type="text" class="form-control" placeholder="" name="Telefono_Personal" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Telefono_Corporativo" class="col-form-label">Telefono Corporativo:</label>
                                                <input type="text" class="form-control" placeholder="" name="Telefono_Corporativo" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Correo_Electronico_Personal" class="col-form-label">Correo Electronico Personal:</label>
                                                <input type="email" class="form-control" placeholder="" name="Correo_Electronico_Personal" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Correo_Corporativo" class="col-form-label">Correo Electronico Corporativo:</label>
                                                <input type="email" class="form-control" placeholder="" name="Correo_Corporativo" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Establecimiento" class="col-form-label">Establecimiento:</label>
                                                <input type="text" class="form-control" placeholder="" name="Establecimiento" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Perfil" class="col-form-label">Perfil:</label>
                                                <input type="text" class="form-control" placeholder="" name="Perfil" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Fecha_de_Nacimiento class="col-form-label">Fecha de nacimiento:</label>
                                                <input type="date" class="form-control" placeholder="" name="Fecha_de_Nacimiento" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Direccion_Personal" class="col-form-label">Dirección Personal:</label>
                                                <input type="text" class="form-control" placeholder="" name="Direccion_Personal" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Fecha_de_Contratacion" class="col-form-label">Fecha de Contratacion:</label>
                                                <input type="date" class="form-control" placeholder="" name="Fecha_de_Contratacion" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Nombre_Usuario" class="col-form-label">Usuario:</label>
                                                <input type="text" class="form-control" placeholder="" name="Nombre_Usuario" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Contraseña" class="col-form-label">Contraseña:</label>
                                                <input type="password" class="form-control" placeholder="" name="Contraseña" required>
                                            </div>
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