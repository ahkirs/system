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
            <h1 class="section-title">Registrar suministro</h1>
            <p class="header-text">Permite registrar los suministros y el proveedor con el que fue adquirido</p>
        </header>
               

        <section>
            <form class="form" id="form-suministro">
                <div class="form__content form__content--suministro">
                    <h2 class="form-title">suministro</h2>

                    <div class="form__input w-100">
                        <label for="categoriaSuministro" class="form__input-label">Categoría:</label>
                        <select name="categoriaSuministro" id="categoriaSuministro" name="categoriaSuministro" class="form__input-select">
                        </select>
                    </div>

                    <div class="form__input w-100">
                        <label for="nombreSuministro" class="form__input-label">Nombre del suministro:</label>
                        <input class="form__input-input" id="nombreSuministro" name="nombreSuministro" maxlength="50"  minlength="5" type="text" value='suministro'>
                    </div>

                    <div class="form__input w-100">
                        <label for="descripcionSuministro" class="form__input-label">Descripción:</label>
                        <input class="form__input-input" id="descripcionSuministro" name="descripcionSuministro" maxlength="50" minlength="5" type="text" value='suministro'>
                    </div>

                    <div class="form__input w-100">
                        <p class="form__input-label">Imagen:</p>
                        <label for="imagenSuministro" class="form__input-btnImg">Seleccionar imagen</label>
                        <input class="form__input-input" id="imagenSuministro" name="imagenSuministro" type="file" accept='image/png,image/jpeg'>
                    </div>

                    <div class="form__input w-100">
                        <label for="fechaCompraSuministro" class="form__input-label">Fecha de compra:</label>
                        <input class="form__input-input" id="fechaCompraSuministro" name="fechaCompraSuministro" type="date" value='2024-05-10'>
                    </div>

                    <div class="form__input w-100">
                        <label for="fechaVencimientoSuministro" class="form__input-label">Fecha de vencimiento:</label>
                        <input class="form__input-input" id="fechaVencimientoSuministro" name="fechaVencimientoSuministro" type="date">
                    </div>

                    <div class="form__input w-100">
                        <label for="unidadesAdquiridas" class="form__input-label">Unidades adquiridas:</label>
                        <input class="form__input-input" id="unidadesAdquiridas" name="unidadesAdquiridas" type="number" value='10'>
                    </div>

                    <div class="form__input w-100">
                        <label for="montoDolaresSuministro" class="form__input-label">Monto cancelado ($):</label>
                        <input class="form__input-input" id="montoDolaresSuministro" name="montoDolaresSuministro" type="text" value='10.5'>
                    </div>

                    <div class="form__input w-100">
                        <label for="montoBsSuministro" class="form__input-label">Monto cancelado (Bs):</label>
                        <input class="form__input-input" id="montoBsSuministro" name="montoBsSuministro" type="text" value='10'>
                    </div>

                    <div class="form__input w-100">
                        <label for="condicionPagoSuministro" class="form__input-label">Condición de pago:</label>
                        <select name="condicionPagoSuministro" id="condicionPagoSuministro" name="condicionPagoSuministro" class="form__input-select">
                            <option value="1">Crédito</option>
                            <option value="2">Contado</option>
                        </select>
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

                    <div class="form__suministro__content" id="disable-inputs">
                        <div class="form__input form__input--rif w-100">
                            <label for="rifProveedor" class="form__input-label">RIF:</label>
                            <select name="rifProveedorTipo" id="rifProveedorTipo" name="rifProveedorTipo" class="form__input-select">
                                <option value="J">J -</option>
                                <option value="G">G -</option>
                                <option value="E">E -</option>
                                <option value="C">C -</option>
                                <option value="P">P -</option>
                                <option value="V">V -</option>
                            </select>
                            <input class="form__input-input" type="number" name="rifProveedor" id="rifProveedor" value='1234567'>
                        </div>

                        <div class="form__input w-100">
                            <label for="nombreProveedor" class="form__input-label">Nombre del proveedor:</label>
                            <input class="form__input-input" id="nombreProveedor" maxlength="50" minlength="5" name="nombreProveedor" type="text" value='proveedor'>
                        </div>

                        <div class="form__input form__input--tel w-100">
                            <label for="telProveedor" class="form__input-label">Teléfono:</label>
                            <select name="codAreaProveedor" id="codAreaProveedor" class="form__input-select">
                                <option value="0414">0414</option>
                                <option value="0424">0424</option>
                                <option value="0416">0416</option>
                                <option value="0426">0426</option>
                                <option value="0412">0412</option>
                            </select>
                            <input class="form__input-input" type="number" name="telProveedor" id="telProveedor" value='1234567'>
                        </div>

                        <div class="form__input w-100">
                            <label for="correoProveedor" class="form__input-label">Correo:</label>
                            <input class="form__input-input" id="correoProveedor" name="correoProveedor" type="email" value='algo@algo.algo'>
                        </div>

                        <div class="form__input w-100">
                            <label for="municipio" class="form__input-label">Municipio:</label>
                            <select id="municipio" name="municipioProveedor" class="form__input-select"></select>
                        </div>

                        <div class="form__input w-100">
                            <label for="parroquia" class="form__input-label">Parroquia:</label>
                            <select id="parroquia" name="parroquiaProveedor" class="form__input-select"></select>
                        </div>

                        <div class="form__input w-100">
                            <label for="comunidadProveedor" class="form__input-label">Nombre de la comunidad:</label>
                            <input class="form__input-input" id="comunidadProveedor" name="comunidadProveedor" maxlength="50"  minlength="5" type="text" placeholder="Nombre del sector, avenida, etc..." value='comunidad'>
                        </div>

                        <div class="form__input w-100">
                            <label for="refProveedor" class="form__input-label">Punto de referencia:</label>
                            <input class="form__input-input" id="refProveedor" name="refProveedor" type="text" maxlength="70"  minlength="5" placeholder="Ejm: A 50 metros de..." value='referencia'>
                        </div>
                    </div>
                </div>

                <button type="submit" class="form-submit">
                    registrar
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
    <script src="<?= RUTAJS ?>get-municipios.js"></script>
    <script src="<?= RUTAJS ?>get-category.js"></script>
    <script src="<?= RUTAJS ?>listar-providers.js"></script>
    <script src="<?= RUTAJS ?>suministros-registrar.js"></script>
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
</body>

</html>