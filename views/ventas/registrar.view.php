<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= RUTACSS ?>normalize.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>base.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>tasa-dolar.css">
    <link rel="stylesheet" href="<?= RUTA ?>/public/sweetAlert/sweetAlert.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>menu.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>loader.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>ventas-registrar.css">
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
            <h1 class="section-title">Regitrar venta</h1>

            <button class="header-cta" id="buscar-cliente">
                Buscar cliente
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path></svg>
            </button>
        </header>


        <section>
            <form class="form">
                <div class="form__cliente">
                    <h2 class="form-title">Datos del cliente</h2>

                    <div class="form__input form__input--ci">
                        <label for="ciCliente" class="form__input-label">cédula:</label>
                        <select class="form__input-select" name="ciTipoCliente" id="ciTipoCliente">
                            <option value="V">V -</option>
                            <option value="E">E -</option>
                        </select>
                        <input type="number" name="ciCliente" id="ciCliente" class="form__input-input" placeholder="Ejm: 12345678">
                    </div>

                    <div class="form__input">
                        <label for="pnCliente" class="form__input-label">primer nombre:</label>
                        <input type="text" name="pnCliente" id="pnCliente" class="form__input-input">
                    </div>

                    <div class="form__input">
                        <label for="snCliente" class="form__input-label form__input-label--flex">
                            segundo nombre:
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                            </span>
                        </label>
                        <input type="text" name="snCliente" id="snCliente" class="form__input-input">
                    </div>

                    <div class="form__input">
                        <label for="tnCliente" class="form__input-label form__input-label--flex">
                            tercer nombre:
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                            </span>
                        </label>
                        <input type="text" name="tnCliente" id="tnCliente" class="form__input-input" placeholder="Ejm: Pedro">
                    </div>

                    <div class="form__input">
                        <label for="paCliente" class="form__input-label">primer apellido:</label>
                        <input type="text" name="paCliente" id="paCliente" class="form__input-input" placeholder="Ejm: Perez">
                    </div>

                    <div class="form__input">
                        <label for="saCliente" class="form__input-label form__input-label--flex">
                            segundo apellido:
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                            </span>
                        </label>
                        <input type="text" name="saCliente" id="saCliente" class="form__input-input" placeholder="Ejm: Perez">
                    </div>

                    <div class="form__input">
                        <label for="sexoCliente" class="form__input-label">sexo:</label>
                        <select class="form__input-select" name="sexoCliente" id="sexoCliente">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>

                    <div class="form__input form__input--tel">
                        <label for="numTelCliente" class="form__input-label">teléfono:</label>
                        <select class="form__input-select" name="codAreaCliente">
                            <option value="0414">0414</option>
                            <option value="0424">0424</option>
                            <option value="0412">0412</option>
                            <option value="0416">0416</option>
                            <option value="0426">0426</option>
                        </select>
                        <input type="number" name="numTelCliente" id="numTelCliente" class="form__input-input" placeholder="Ejm: 1234567">
                    </div>
                </div>
            </form>
        </section>


        <!-- BOTON PARA MOSTRAR LA TASA DEL DOLAR -->
        <button class="tasa-dolar" id="tasa-dolar-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"></path><path d="M12 11c-2 0-2-.63-2-1s.7-1 2-1 1.39.64 1.4 1h2A3 3 0 0 0 13 7.12V6h-2v1.09C9 7.42 8 8.71 8 10c0 1.12.52 3 4 3 2 0 2 .68 2 1s-.62 1-2 1c-1.84 0-2-.86-2-1H8c0 .92.66 2.55 3 2.92V18h2v-1.08c2-.34 3-1.63 3-2.92 0-1.12-.52-3-4-3z"></path></svg>
        </button>
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
    <script src="<?= RUTAJS ?>tasa-dolar.js"></script>
    <script src="<?= RUTAJS ?>ventas-registrar.js"></script>
</body>

</html>