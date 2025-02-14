<?php 
ob_start();
?>

<!DOCTYPE html> 
<html lang="es"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title><?php echo $this->titlepage;?></title>
    <link rel="icon" href="<?=RUTA?>/public/assets/img/lunch-system-favicon.ico">
    <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        td, th {
          border: 1px solid #1e146c;
          text-align: center;
          padding: 8px;
        }

        .titulo{
            text-align: center;
        }

        tr:nth-child(even) {
          background-color: #c3d2fb;
        }

        h2{
            top: -5px;
        }


    </style> 
</head> 

<body> 
    <h2>Lunchería La Sazón De La Primera</h2>
    <h3>RIF: J-50509284-7</h3>
    <p>Av. Francisco de Miranda Local N 15<br>
    El Tigre, Estado Anzoátegui<br>
    Teléfono: (0416) 307-8141<br>
    Correo Electrónico: LASAZONDELAPRIMERA@GMAIL.COM</p>

    <h2 class="titulo">Comprobante de Adquisición.</h2>
    <p> <strong>Fecha:</strong> <?php echo $this->fecha;?></p>
    <p> <strong>Proveedor:</strong> <?php echo $this->array[0]['nombreRifProveedor'];?></p>
      
        <table> 
        <tr>
            <th>Nº</th>
            <th>Suministro</th>
            <th>Cantidad</th>
            <th>Bolívares (Bs)</th>
            <th>DÓLAR ($)</th>
        </tr>

        <?php
            $id = 1;
            foreach ($this->array as $row) {
                echo "<tr>";
                echo "<td>" . $id++ . "</td>";
                echo "<td>" . $row['nombreSuministro'] . "</td>";
                echo "<td>" . $row['cantidadAbasto'] . "</td>";
                echo "<td>" . $row['pagadoBs'] . "</td>";
                echo "<td>" . $row['pagadoUsd'] . "</td>";
                echo "</tr>";
            }
        ?>
        </table>

        <br>

        <table>
            <tr>
                <th>Total Cantidad</th>
                <th>Total Bolívares</th>
                <th>Total Dólares</th>
            </tr>
            <tr>
                <td><?php echo $this->total['totalCantidad'];?></td>
                <td><?php echo $this->total['totalPagadoBs'];?></td>
                <td><?php echo $this->total['totalPagadoUsd'];?></td>
            </tr>
        </table>
</body>
</html>
<?php 

$html = ob_get_clean();
// echo $html;

Use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');

$dompdf->render();

$dompdf->stream("$this->titlepage.pdf", array("Attachment" => false));

?>