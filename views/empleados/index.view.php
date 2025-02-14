<!DOCTYPE html>
<html>

<head lang="es">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= RUTACSS ?>normalize.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>base.css">
    <link rel="stylesheet" href="<?= RUTA ?>/public/sweetAlert/sweetAlert.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>menu.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>loader.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>empleados.css">
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
            <h1 class="section-title">empleados</h1>

            <a href="<?= RUTA ?>/empleados/registrar" class="header-btn">
                agregar empleado
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path></svg>
            </a>
        </header>

        <section class="stadistics">
            <p class="stadistics-paragraph">
                Total: <span id="total-employees"></span>
                - promedio edad: <span id="average-age"></span>
            </p>

            <div class="stadistics__bar">
                <div class="stadistics__bar__texts">
                    <p class="stadistics-paragraph">Masculinos: <span id="male-employees"></span></p>
                    <p class="stadistics-paragraph">Femeninos: <span  id="female-employees"></span></p>
                </div>
                <span class="stadistics__bar-line stadistics__bar-line--male" id="male-bar"></span>
                <span class="stadistics__bar-line stadistics__bar-line--female" id="female-bar"></span>
            </div>
        </section>


        <section class="cards__section">
            
        </section>

    </main>


    <!-- Loader -->
    <section class="loader__section" id="loader-section">
        <span class="loader"></span>
    </section>




    <script>var RUTA = "<?php echo RUTA; ?>";</script>
    <script>var RUTA_IMG = "<?php echo RUTAIMG; ?>";</script>
    <script src="<?= RUTA ?>/public/jquery/jquery.min.js"></script>
    <script src="<?= RUTA ?>/public/lobibox/lobibox.min.js"></script>
    <script src="<?= RUTAJS ?>loader.js"></script>
    <script src="<?= RUTAJS ?>close-sesion.js"></script>
    <script src="<?= RUTA ?>/public/sweetAlert/sweetAlert.js"></script>
    <script src="<?= RUTAJS ?>empleados.js"></script>
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
</body>

</html>