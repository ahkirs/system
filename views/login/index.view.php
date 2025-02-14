<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?= RUTACSS ?>normalize.css">
    <link rel="stylesheet" href="<?= RUTA ?>/public/lobibox/LobiBox.min.css">
	<link rel="stylesheet" href="<?= RUTACSS ?>login.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>loader.css">
    <link rel="icon" href="<?=RUTA?>/public/assets/img/lunch-system-favicon.ico">
	<title><?php echo $this->titlepage; ?></title>
</head>

<body>

	<main>
        <section class="login">
            <form action="" method= "POST" class="form" id="form">
                <figure class="form__img">
                    <img src="<?= RUTAIMG ?>logo-name2.png" alt="Lunch System logo" class="form__img-img">
                </figure>

                <div class="form__input">
                    <input type="text" name="username" id="username" class="form__input-input" placeholder="Ejemplo: admin08">
                    <label for="username" class="form__input-label">usuario</label>
                </div>

                <div class="form__input">
                    <input type="password" name="password" id="password" class="form__input-input" placeholder="Ingrese la contraseña">
                    <label for="password" class="form__input-label">contraseña</label>

                    <button type="button" class="form__input__eye" id="show-pass-btn">
                        <img src="<?= RUTAIMG ?>eye.svg" alt="Ver contraseña" class="form__input__eye-img">
                    </button>
                </div>

                <button type="submit" class="form-submit">iniciar sesion</button>

                <a href="<?=RUTA; ?>/login/recovery" class="form__recovery">¿Olvidó su <span>contraseña</span>?</a>
            </form>

            <figure class="login__figure">
                <img class="login__figure-banner" src="<?= RUTAIMG ?>lunch-login.jpg" alt="Luncheria El Sazón de la Primera">
            </figure>
        </section>

        <section class="loader__section" id="loader-section">
            <span class="loader"></span>
        </section>
    </main>
	
	<script>var IMG_URL = "<?php echo RUTAIMG; ?>";</script>
    <script>var RUTA = "<?php echo RUTA; ?>";</script>
	<script src="<?= RUTA ?>/public/jquery/jquery.min.js"></script>
    <script src="<?= RUTA ?>/public/lobibox/lobibox.min.js"></script>
	<script src="<?= RUTAJS ?>loader.js"></script>
	<script src="<?= RUTAJS ?>login.js"></script>

</body>

</html>