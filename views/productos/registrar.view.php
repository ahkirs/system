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
    <link rel="stylesheet" href="<?= RUTACSS ?>productos-registrar.css">
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
            <h1 class="section-title">Registrar Producto</h1>
        </header>

        <section class="section__form">
            <form class="form" id="form">
                <h2 class="form-title">Producto</h2>

                <div class="form__input">
                    <label for="categoriaProducto" class="form__input-label">Categoría:</label>
                    <select name="categoriaProducto" id="categoriaProducto" class="form__input-select">
                        <option value="false">-- NO HAY CATEGORIAS REGISTRADAS --</option>
                    </select>
                </div>

                <div class="form__input">
                    <label for="nombreProducto" class="form__input-label">Nombre:</label>
                    <input type="text" id="nombreProducto" name="nombreProducto" placeholder="Ejm: Empanada de pollo" class="form__input-input">
                </div>

                <div class="form__input">
                    <label for="descripcionProducto" class="form__input-label">Descripción:</label>
                    <input type="text" id="descripcionProducto" name="descripcionProducto" placeholder="Ejm: Empanada de 15cm" class="form__input-input">
                </div>

                <div class="form__input w-100">
                    <p class="form__input-label">Imagen:</p>
                    <label for="imagenProducto" class="form__input-btnImg">Seleccionar imagen</label>
                    <input class="form__input-input" id="imagenProducto" name="imagenProducto" type="file" accept="image/png,image/jpeg">
                </div>

                <div class="form__input">
                    <label for="precioProducto" class="form__input-label">Precio en dólares:</label>
                    <input type="text" id="precioProducto" name="precioProducto" placeholder="Ejm: 1.3" class="form__input-input">
                </div>

                <button class="form-submit header-cta" type="submit">
                    Registrar
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path></svg>
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
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
    <script src="<?= RUTAJS ?>get-category.js"></script>
    <script src="<?= RUTAJS ?>productos-registrar.js"></script>
</body>

</html>