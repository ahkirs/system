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
    <link rel="stylesheet" href="<?= RUTACSS ?>suministros-registrar.css">
    <link rel="icon" href="<?=RUTA?>/public/assets/img/lunch-system-favicon.ico">
    <title>
        <?php echo $this->titlepage; ?>
    </title>
</head>

<body>

    <!-- Menu -->
    <?php require($this->menu); ?>


    <main>
        <header>
            <h1 class="section-title">Emitir Comprobante</h1>
            <p class="header-text">Permite emitir un comprobante en formato PDF de los suministros y el proveedor con el que fue adquirido</p>
        </header>
               

        <section>
            <form action="<?=RUTA?>/suministros/comprobantesuppliess" method="POST" target="_blank" class="form" id="form-suministro">
                <div class="form__content form__content--suministro">
                    <h2 class="form-title">suministro</h2>

                    <div class="form__input w-100">
                        <label for="fechaCompraSuministro" class="form__input-label">Fecha de compra:</label>
                        <input class="form__input-input" id="fechaCompraSuministro" name="fechaCompraSuministro" type="date" value='2024-05-10'>
                    </div>                   
                </div>

                <div class="form__content form__content--proveedor">
                    <h2 class="form-title">proveedor</h2>

                    <div class="form__input w-100">
                        <label for="proveedorSelect" class="form__input-label">Seleccionar proveedor:</label>
                        <select name="proveedorSelect" id="proveedorSelect" class="form__input-select">
                            <!-- <option value="false">-- Seleccione un proveedor registrado --</option>
                            <option value="1">Rolando Palma</option> -->
                        </select>
                    </div>
                </div>

                <button type="submit" class="form-submit">
                    Emitir
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path></svg>
                </button>
            </form>
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
    <script src="<?= RUTAJS ?>listar-providers.js"></script>
    <script src="<?= RUTAJS ?>comprobante-suministros.js"></script>
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
</body>

</html>