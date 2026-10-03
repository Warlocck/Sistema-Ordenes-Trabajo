<?php
// Conexión a la base de datos
include("../BD/config.php");

// Verificar si se proporcionó un ID
if (isset($_GET['id'])) {
    $idOrden = $_GET['id'];

    // Preparar la llamada al procedimiento almacenado
    $stmt = $mysqli->prepare("CALL ObtenerOrdenCompleta(?)");
    $stmt->bind_param("s", $idOrden);
    $stmt->execute();

    // Obtener el resultado
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Calcular el total (puedes cambiarlo según tu lógica)
        $total = 1000; // Cambia esto a un cálculo real si tienes tabla de detalles
    } else {
        die("No se encontró la orden de trabajo con el ID proporcionado.");
    }

    // Cerrar el statement y la conexión
    $stmt->close();
} else {
    die("No se proporcionó un ID de orden.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Orden de Trabajo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header img {
            height: 200px;
        }
        .header .company-info {
            text-align: right;
        }
        .details {
            margin-top: 20px;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .details th, .details td {
            padding: 8px;
            border: 1px solid #000;
            text-align: left;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <div class="company-info">
                <h3>Estudios Creativos del Perú</h3>
                <p>Sociedad Anónima Cerrada</p>
                <p>Dirección: Arequipa, Perú</p>
                <p>Teléfono: 123-456-789</p>
                <p>Email: contacto@estudioscreativos.pe</p>
            </div>
        </div>
        <hr>

        <!-- Detalles de la orden -->
        <div class="details">
            <h4>Orden de Trabajo: <?php echo $data['ID_Orden_de_Trabajo']; ?></h4>
            <table>
                <tr>
                    <th>Fecha de Emisión</th>
                    <td><?php echo $data['Fecha_Emision']; ?></td>
                    <th>Fecha de Vencimiento</th>
                    <td><?php echo $data['Fecha_Vencimiento']; ?></td>
                </tr>
                <tr>
                    <th>Cliente</th>
                    <td><?php echo $data['Cliente_Nombre']; ?></td>
                    <th>Dirección</th>
                    <td><?php echo $data['Cliente_Direccion']; ?></td>
                </tr>
                <tr>
                    <th>RUC</th>
                    <td colspan="3"><?php echo $data['Cliente_Numero_Documento']; ?></td>
                </tr>
                <tr>
                    <th>Ejecutivo</th>
                    <td><?php echo $data['Ejecutivo_Nombre']; ?></td>
                    <th>Total</th>
                    <td>S/ <?php echo number_format($total, 2); ?></td>
                </tr>
            </table>
        </div>

        <!-- Tabla de detalle -->
        <div class="details">
            <h4>Detalle de la Orden</h4>
            <table>
                <thead>
                    <tr>
                        <th>Cant.</th>
                        <th>Descripción</th>
                        <th>P. Unit</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><?php echo $data['Descripcion']; ?></td>
                        <td>S/ <?php echo number_format($total * 0.85, 2); ?></td>
                        <td>S/ <?php echo number_format($total, 2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Resumen de totales -->
        <div class="details">
            <table>
                <tr>
                    <th>Op. Gravadas</th>
                    <td>S/ <?php echo number_format($total * 0.85, 2); ?></td>
                </tr>
                <tr>
                    <th>IGV (18%)</th>
                    <td>S/ <?php echo number_format($total * 0.15, 2); ?></td>
                </tr>
                <tr>
                    <th>Total a Pagar</th>
                    <td>S/ <?php echo number_format($total, 2); ?></td>
                </tr>
            </table>
        </div>

        <!-- Pie de página -->
        <div class="footer">
            <p>Gracias por confiar en nosotros.</p>
        </div>
    </div>
</body>
</html>
