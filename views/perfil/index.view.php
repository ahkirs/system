<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= RUTACSS ?>normalize.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>base.css">
    <link rel="stylesheet" href="<?= RUTA ?>/public/sweetAlert/sweetAlert.css">
    <link rel="icon" href="<?=RUTA?>/public/assets/img/lunch-system-favicon.ico">
    <link rel="stylesheet" href="<?= RUTACSS ?>menu.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>loader.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>perfil.css">
    <title>
        <?php echo $this->titlepage; ?>
    </title>
</head>

<body>

    <!-- Menu -->
    <?php require($this->menu); ?>


    <main>
        <header class="header">
            <h1 class="header-title">Perfil de <span id="rol"></span></h1>

            <div class="header__perfil">
                <figure class="header__perfil__figure">
                    <button class="header__perfil__figure-btn" id="update-avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                    </button>
                    <img alt="Avatar perfil" id="avatar" class="header__perfil__figure-avatar">
                </figure>

                <h2 class="header__perfil-title"></h2>

                <p class="header__perfil-cargo"></p>
            </div>

            <div class="header__info">
                <p class="header__info__text">
                    <span class="header__info__text-subtitle">
                        <button class="header__info__text-edit" id="edit-email" data-id data-after="Editar correo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                        </button>
                        Correo:
                    </span>

                    <span class="header__info__text-text" id="email"></span>
                </p>

                <p class="header__info__text">
                    <span class="header__info__text-subtitle">
                        <button class="header__info__text-edit" id="edit-phone" data-id data-after="Editar teléfono">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                        </button>
                        Teléfono:
                    </span>

                    <span class="header__info__text-text" id="phone"></span>
                </p>

                <p class="header__info__text">
                    <span class="header__info__text-subtitle">
                        <button class="header__info__text-edit" id="edit-username" data-id data-after="Editar usuario">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>
                        </button>
                        Usuario:
                    </span>

                    <span class="header__info__text-text" id="username"></span>
                </p>

                <p class="header__info__text">
                    <span class="header__info__text-subtitle">Edad:</span>
                    <span class="header__info__text-text" id="edad"></span>
                </p>
            </div>
        </header>

        <section class="update">
            <div class="update__buttons">
                <button class="update__buttons-btn active" id="show-form-password">Contraseña</button>
                <button class="update__buttons-btn" id="show-form-direction">Dirección</button>
            </div>

            <div class="update__container">
                <form class="update__form update__form--password active" id="form-password" autocomplete="off">
                    <h2 class="update__form-title">Actualizar contraseña</h2>

                    <div class="update__form__input">
                        <label for="currentPassword" class="update__form__input-label">Contraseña actual:</label>
                        <input class="update__form__input-input" type="password" name="currentPass" id="currentPassword">

                        <button type="button" class="update__form__input__eye" data-eye="eye">
                            <img src="<?= RUTAIMG ?>eye.svg" alt="Ver contraseña" class="update__form__input__eye-img">
                        </button>
                    </div>

                    <div class="update__form__input">
                        <label for="newPassword" class="update__form__input-label">Nueva contraseña:</label>
                        <input class="update__form__input-input" type="password" name="newPass" id="newPassword">
                        
                        <button type="button" class="update__form__input__eye" data-eye="eye">
                            <img src="<?= RUTAIMG ?>eye.svg" alt="Ver contraseña" class="update__form__input__eye-img">
                        </button>
                    </div>

                    <div class="update__form__input">
                        <label for="newPasswordConfirm" class="update__form__input-label">Confirmar contraseña</label>
                        <input class="update__form__input-input" type="password" id="newPasswordConfirm">

                        <button type="button" class="update__form__input__eye" data-eye="eye">
                            <img src="<?= RUTAIMG ?>eye.svg" alt="Ver contraseña" class="update__form__input__eye-img">
                        </button>
                    </div>

                    <button class="update__form-submit" type="submit">
                        Actualizar
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M10 11H7.101l.001-.009a4.956 4.956 0 0 1 .752-1.787 5.054 5.054 0 0 1 2.2-1.811c.302-.128.617-.226.938-.291a5.078 5.078 0 0 1 2.018 0 4.978 4.978 0 0 1 2.525 1.361l1.416-1.412a7.036 7.036 0 0 0-2.224-1.501 6.921 6.921 0 0 0-1.315-.408 7.079 7.079 0 0 0-2.819 0 6.94 6.94 0 0 0-1.316.409 7.04 7.04 0 0 0-3.08 2.534 6.978 6.978 0 0 0-1.054 2.505c-.028.135-.043.273-.063.41H2l4 4 4-4zm4 2h2.899l-.001.008a4.976 4.976 0 0 1-2.103 3.138 4.943 4.943 0 0 1-1.787.752 5.073 5.073 0 0 1-2.017 0 4.956 4.956 0 0 1-1.787-.752 5.072 5.072 0 0 1-.74-.61L7.05 16.95a7.032 7.032 0 0 0 2.225 1.5c.424.18.867.317 1.315.408a7.07 7.07 0 0 0 2.818 0 7.031 7.031 0 0 0 4.395-2.945 6.974 6.974 0 0 0 1.053-2.503c.027-.135.043-.273.063-.41H22l-4-4-4 4z"></path></svg>
                    </button>
                </form>

                <form class="update__form" id="form-direction" autocomplete="off">
                    <p class="update__form-dir">
                        Dirección actual:
                        <span id="direction"></span>
                    </p>

                    <h2 class="update__form-title">Actualizar dirección</h2>

                    <div class="update__form__input">
                        <label for="municipio" class="update__form__input-label">Municipio:</label>
                        <select class="update__form__input-select" name="municipio" id="municipio"></select>
                    </div>

                    <div class="update__form__input">
                        <label for="parroquia" class="update__form__input-label">Parroquia:</label>
                        <select class="update__form__input-select" name="parroquia" id="parroquia"></select>
                    </div>
                    
                    <div class="update__form__input">
                        <label for="sector" class="update__form__input-label">Nombre de la comunidad:</label>
                        <input type="text"name="sector" id="sector" class="update__form__input-input" placeholder="Nombre del sector, urbanizació, edificio, etc...">
                    </div>
                    
                    <div class="update__form__input">
                        <label for="calle" class="update__form__input-label">Calle:</label>
                        <input type="text"name="calle" id="calle" class="update__form__input-input" placeholder="Ejm: Calle 10">
                    </div>
                    
                    <div class="update__form__input">
                        <label for="numCasa" class="update__form__input-label">Número de casa:</label>
                        <input type="text"name="numCasa" id="numCasa" class="update__form__input-input" placeholder="Ejm: 20, s/n">
                    </div>
                    
                    <div class="update__form__input">
                        <label for="refCasa" class="update__form__input-label">Punto de referencia:</label>
                        <input type="text"name="refCasa" id="refCasa" class="update__form__input-input" placeholder="Ejm: A 100 metros de Luncheria ChiliVen">
                    </div>

                    <button class="update__form-submit" type="submit">
                        Actualizar
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M10 11H7.101l.001-.009a4.956 4.956 0 0 1 .752-1.787 5.054 5.054 0 0 1 2.2-1.811c.302-.128.617-.226.938-.291a5.078 5.078 0 0 1 2.018 0 4.978 4.978 0 0 1 2.525 1.361l1.416-1.412a7.036 7.036 0 0 0-2.224-1.501 6.921 6.921 0 0 0-1.315-.408 7.079 7.079 0 0 0-2.819 0 6.94 6.94 0 0 0-1.316.409 7.04 7.04 0 0 0-3.08 2.534 6.978 6.978 0 0 0-1.054 2.505c-.028.135-.043.273-.063.41H2l4 4 4-4zm4 2h2.899l-.001.008a4.976 4.976 0 0 1-2.103 3.138 4.943 4.943 0 0 1-1.787.752 5.073 5.073 0 0 1-2.017 0 4.956 4.956 0 0 1-1.787-.752 5.072 5.072 0 0 1-.74-.61L7.05 16.95a7.032 7.032 0 0 0 2.225 1.5c.424.18.867.317 1.315.408a7.07 7.07 0 0 0 2.818 0 7.031 7.031 0 0 0 4.395-2.945 6.974 6.974 0 0 0 1.053-2.503c.027-.135.043-.273.063-.41H22l-4-4-4 4z"></path></svg>
                    </button>
                </form>
            </div>
        </section>
    </main>


    <!-- Loader -->
    <section class="loader__section" id="loader-section">
        <span class="loader"></span>
    </section>




    <script>var RUTA = "<?php echo RUTA; ?>";</script>
    <script>var IMG_URL = "<?php echo RUTAIMG; ?>";</script>
    <script src="<?= RUTA ?>/public/jquery/jquery.min.js"></script>
    <script src="<?= RUTA ?>/public/lobibox/lobibox.min.js"></script>
    <script src="<?= RUTAJS ?>loader.js"></script>
    <script src="<?= RUTAJS ?>close-sesion.js"></script>
    <script src="<?= RUTA ?>/public/sweetAlert/sweetAlert.js"></script>
    <script src="<?= RUTAJS ?>get-municipios.js"></script>
    <script src="<?= RUTAJS ?>perfil.js"></script>
    <script src="<?= RUTAJS ?>perfil-update.js"></script>
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
</body>

</html>