<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= RUTACSS ?>normalize.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>base.css">
    <link rel="stylesheet" href="<?= RUTA ?>/public/sweetAlert/sweetAlert.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>menu.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>loader.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>users.css">
    <link rel="icon" href="<?=RUTA?>/public/assets/img/lunch-system-favicon.ico">
    <title>
        <?php echo $this->titlepage; ?>
    </title>
</head>

<body class="layout">

    <!-- Menu -->
    <?php require($this->menu); ?>


    <main>
        <header>
            <h1 class="section-title">Usuarios</h1>
            <p class="header-text" for="add-user">Visualiza todos los usuarios que han sido creados</p>
        </header>

        <p class="users-stadistics">
            Usuarios totales: <span id="total-users">2</span>
            - Administrador: <span id="admin-users">2</span>
            - Asistentes <span id="asist-users">0</span>
         </p>

        <section class="users">

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
    <script src="<?= RUTAJS ?>users.js"></script>
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
</body>

</html>