<!DOCTYPE html>
<html>

<head lang="es">
    <meta charset="UTF-8" lang="es">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= RUTACSS ?>normalize.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>base.css">
    <link rel="stylesheet" href="<?= RUTA ?>/public/sweetAlert/sweetAlert.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>menu.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>loader.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>proveedores.css">
    <link rel="icon" href="<?=RUTA?>/public/assets/img/lunch-system-favicon.ico">
    <title>
        <?php echo $this->titlepage; ?>
    </title>
</head>

<body>

    <!-- Menu -->
    <?php require($this->menu); ?> 


    <main>
        <header class="header">
            <h1 class="section-title">Proveedores</h1>
        </header>

        <section class="stadistics">
            <p class="stadistics-paragraph">
                Proveedores totales: <span class="stadistics-span" id="total-proveedores"></span>
            </p>
        </section>

        <section class="suppliers">
        </section>
    </main>


    <!-- Loader -->
    <section class="loader__section" id="loader-section">
        <span class="loader"></span>
    </section>




    <script>var RUTA = "<?php echo RUTA; ?>";</script>
    <script src="<?= RUTA ?>/public/jquery/jquery.min.js"></script>
    <script src="<?= RUTA ?>/public/lobibox/lobibox.min.js"></script>
    <script src="<?= RUTAJS ?>loader.js"></script>
    <script src="<?= RUTAJS ?>close-sesion.js"></script>
    <script src="<?= RUTA ?>/public/sweetAlert/sweetAlert.js"></script>
    <script src="<?= RUTAJS ?>proveedores.js"></script>
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
</body>

</html>