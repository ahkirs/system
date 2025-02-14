<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?=RUTA?>/public/assets/img/lunch-system-favicon.ico">
    <link rel="stylesheet" href="<?= RUTACSS ?>normalize.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>base.css">
    <link rel="stylesheet" href="<?= RUTA ?>/public/sweetAlert/sweetAlert.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>menu.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>loader.css">
    <link rel="stylesheet" href="<?= RUTA ?>/public/assets/dataTables/datatables.min.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>historial-compras.css">
    <title>
        <?php echo $this->titlepage; ?>
    </title>
</head>
<body>

    
    <!-- Menu -->
    <?php require($this->menu); ?>

    <main>
        <header class="header">
            <h1 class="section-title">Historial de Compras</h1>
        </header>

        <section class="table__section">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Suministro</th>
                        <th>Proveedor</th>
                        <th id="sort-column">Fecha compra</th>
                        <th>Cantidad</th>
                        <th>Monto dolares</th>
                        <th>Monto bolivares</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- <tr>
                        <td>Harina de trigo</td>
                        <td>LOS LLANOS X</td>
                        <td>22 de diciembre de 2024</td>
                        <td>10</td>
                        <td>12.00</td>
                        <td>600.00</td>
                    </tr> -->

                </tbody>
            </table>
        </section>
    </main>

    <!-- Loader -->
    <section class="loader__section" id="loader-section">
        <span class="loader"></span>
    </section>






    <script>var RUTA = "<?php echo RUTA; ?>";</script>
    <script src="<?= RUTA ?>/public/jquery/jquery.min.js"></script>
    <script src="<?= RUTA ?>/public/lobibox/lobibox.min.js"></script>
    <!-- <script src="<?= RUTA ?>/public/assets/dataTables/datatables.button.min.js"></script> -->
    <script src="<?= RUTA ?>/public/assets/dataTables/datatables.min.js"></script>
    <script src="<?= RUTAJS ?>loader.js"></script>
    <script src="<?= RUTAJS ?>close-sesion.js"></script>
    <script src="<?= RUTA ?>/public/sweetAlert/sweetAlert.js"></script>    
    <script src="<?= RUTAJS ?>historial-compras.js"></script>
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
    
</body>
</html>