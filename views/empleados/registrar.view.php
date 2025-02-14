<!DOCTYPE html>
<html>

<head lang="es">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= RUTACSS ?>normalize.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>base.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>menu.css">
    <link rel="stylesheet" href="<?= RUTA ?>/public/sweetAlert/sweetAlert.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>loader.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>empleados-registrar.css">
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
            <h1 class="section-title">registrar empleado</h1>
        </header>

        <section>
            <form id="form" class="form">

                <div class="form__content form__content--info">
                    <h2 class="form-title">información personal</h2>

                    <div class="form__input form__input--ci">
                        <label for="ci" class="form__input-label">cédula:</label>
                        <select class="form__input-select" name="ciTipo" id="ciTipo">
                            <option value="V">V -</option>
                            <option value="E">E -</option>
                        </select>
                        <input type="number" name="ci" id="ci" class="form__input-input" placeholder="Ejm: 12345678">
                    </div>

                    <div class="form__input">
                        <label for="pn" class="form__input-label">primer nombre:</label>
                        <input type="text" name="pn" id="pn" class="form__input-input" placeholder="Ejm: Pedro">
                    </div>

                    <div class="form__input">
                        <label for="sn" class="form__input-label form__input-label--flex">
                            segundo nombre:
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                            </span>
                        </label>
                        <input type="text" name="sn" id="sn" class="form__input-input" placeholder="Ejm: Pedro">
                    </div>

                    <div class="form__input">
                        <label for="tn" class="form__input-label form__input-label--flex">
                            tercer nombre:
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                            </span>
                        </label>
                        <input type="text" name="tn" id="tn" class="form__input-input" placeholder="Ejm: Pedro">
                    </div>

                    <div class="form__input">
                        <label for="pa" class="form__input-label">primer apellido:</label>
                        <input type="text" name="pa" id="pa" class="form__input-input" placeholder="Ejm: Perez">
                    </div>

                    <div class="form__input">
                        <label for="sa" class="form__input-label form__input-label--flex">
                            segundo apellido:
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                            </span>
                        </label>
                        <input type="text" name="sa" id="sa" class="form__input-input" placeholder="Ejm: Perez">
                    </div>

                    <div class="form__input">
                        <label for="fn" class="form__input-label">fecha de nacimiento:</label>
                        <input type="date" name="fn" id="fn" class="form__input-input">
                    </div>

                    <div class="form__input">
                        <label for="sex" class="form__input-label">sexo:</label>
                        <select class="form__input-select" name="sex" id="sex">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>

                    <div class="form__input">
                        <label for="ec" class="form__input-label">estado civil:</label>
                        <select class="form__input-select" name="ec" id="ec">
                            <option value="S">Soltero</option>
                            <option value="C">Casado</option>
                            <option value="V">Viudo</option>
                        </select>
                    </div>

                    <div class="form__input">
                        <label for="correo" class="form__input-label">correo:</label>
                        <input type="email" name="correo" id="correo" class="form__input-input" placeholder="Ejm: pedro@gmail.com">
                    </div>

                    <div class="form__input form__input--tel">
                        <label for="numTel" class="form__input-label">teléfono:</label>
                        <select class="form__input-select" name="codArea">
                            <option value="0414">0414</option>
                            <option value="0424">0424</option>
                            <option value="0412">0412</option>
                            <option value="0416">0416</option>
                            <option value="0426">0426</option>
                        </select>
                        <input type="number" name="numTel" id="numTel" class="form__input-input" placeholder="Ejm: 1234567">
                    </div>

                    <div class="form__input">
                        <label for="fi" class="form__input-label">fecha de ingreso:</label>
                        <input type="date" name="fi" id="fi" class="form__input-input">
                    </div>

                    <div class="form__input">
                        <label for="cargo" class="form__input-label">cargo:</label>
                        <select class="form__input-select" name="cargo" id="cargo">
                            <option value="administrador">Administrador(a)</option>
                            <option value="cocinero">Cocinero(a)</option>
                            <option value="encargado">Encargado(a)</option>
                        </select>
                    </div>
                </div>

                <div class="form__content form__content--dir">
                    <h2 class="form-title">dirección</h2>

                    <div class="form__input">
                        <label for="municipio" class="form__input-label">municipio:</label>
                        <select class="form__input-select" name="municipio" id="municipio">
                        </select>
                    </div>

                    <div class="form__input">
                        <label for="parroquia" class="form__input-label">parroquia:</label>
                        <select class="form__input-select" name="parroquia" id="parroquia">
                        </select>
                    </div>

                    <div class="form__input">
                        <label for="sector" class="form__input-label">nombre de la comunidad:</label>
                        <input type="text" name="sector" id="sector" class="form__input-input" placeholder="Ejm: Pueblo Nuevo Sur, Urbanizacion...">
                    </div>

                    <div class="form__input">
                        <label for="calle" class="form__input-label">calle:</label>
                        <input type="text" name="calle" id="calle" class="form__input-input" placeholder="Ejm: Calle 10">
                    </div>

                    <div class="form__input">
                        <label for="numCasa" class="form__input-label">número de casa:</label>
                        <input type="text" name="numCasa" id="numCasa" class="form__input-input" placeholder="Ejm: 123">

                    </div>

                    <div class="form__input">
                        <label for="refCasa" class="form__input-label">punto de referencia:</label>
                        <input type="text" name="refCasa" id="refCasa" class="form__input-input" placeholder="Ejm: A 50m del hospital">
                    </div>

                    <h2 class="form-title">usuario</h2>

                    <div class="form__input">
                        <label for="username" class="form__input-label form__input-label--flex">
                            nombre de usuario:
                            <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                            </span>
                        </label>
                        <input type="text" name="username" id="username" class="form__input-input" placeholder="Ejm: pedro_21">
                    </div>
                </div>

                <button type="submit" id="form-submit" class="form-submit">
                    Registrar
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
    <script src="<?= RUTAJS ?>empleados-registrar.js"></script>
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
</body>

</html>