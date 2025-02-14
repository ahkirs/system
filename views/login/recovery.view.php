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
            <?php if (!isset($_SESSION['uservalidated']) && !isset($_SESSION['userrecovery']) && !isset($_SESSION['id_recovery'])){ ?>
            <form method="POST" class="form" id="frmRecovery">
                <figure class="form__img">
                    <img src="<?= RUTAIMG ?>logo-name2.png" alt="Luch System logo" class="form__img-img">
                </figure>

                <h2 class="login__form__title"> Recuperar Contraseña: Paso 1 </h2>
                <div class="form__input">
                    <input type="text" name="usuariorecovery" id="usuariorecovery" class="form__input-input" placeholder="Ejemplo: admin08">
                    <label for="username" class="form__input-label">usuario</label>
                </div>

                
                <button type="submit" class="form-submit">Enviar</button>

            </form>
            <?php 
            }
            ?>

            <?php if (!isset($_SESSION['uservalidated']) && isset($_SESSION['userrecovery'])) { ?>
                <form method="POST" class="form" id="frmRecoveryPassword" style="padding: 15px 0;">
                    <figure class="form__img">
                        <img src="<?= RUTAIMG ?>logo-name2.png" alt="" class="form__img-img">
                    </figure>
                    <h2 class="login__form__title"> Recuperar Contraseña: Paso 2 </h2>

                    <div class="form__input">
                        <input type="text" name="usuario" id="usuario" class="form__input-input" value="<?php echo $_SESSION['userrecovery']?>" placeholder=" " readonly="blocked">
                        <label for="usuario" class="form__input-label">usuario</label>
                    </div>

                    <div class="form__input">
                        <input type="text" name="respuesta1" id="respuesta1" class="form__input-input"  placeholder="Escriba la respuesta">
                        <label for="respuesta1" class="form__input-label">Pregunta 1: ¿<?php echo $_SESSION['p1']?>?</label>
                    </div>

                    <div class="form__input">
                        <input type="text" name="respuesta2" id="respuesta2" class="form__input-input"  placeholder="Escriba la respuesta">
                        <label for="respuesta2" class="form__input-label">Pregunta 2: ¿<?php echo $_SESSION['p2']?>?</label>
                    </div>

                    <div class="form__input">
                        <input type="text" name="respuesta3" id="respuesta3" class="form__input-input"  placeholder="Escriba la respuesta">
                        <label for="respuesta3" class="form__input-label">Pregunta 3: ¿<?php echo $_SESSION['p3']?>?</label>
                    </div>                

                    <button type="submit" class="form-submit">Enviar</button>           
                </form>
             <?php 
            }
            ?>


            <?php if (isset($_SESSION['uservalidated'])) { ?>
            <form method="POST" class="form" id="frmSETPassword">
                <figure class="form__img">
                    <img src="<?= RUTAIMG ?>logo-name2.png" alt="Lunch System logo" class="form__img-img">
                </figure>

                <h2 class="login__form__title"> Recuperar Contraseña: Paso 3 </h2>
                <div class="form__input">
                <input type="text" name="usuario" id="usuario" class="form__input-input" value="<?php echo $_SESSION['uservalidated']?>" placeholder=" " readonly="blocked">
                <label for="username" class="form__input-label">Usuario</label>
                </div>

                <div class="form__input">
                    <input type="password" name="password" id="password" class="form__input-input" placeholder="Ingrese la nueva contraseña">
                    <label for="password" class="form__input-label">Contraseña</label>

                    <button type="button" class="form__input__eye" id="show-pass-btn-1">
                        <img src="<?= RUTAIMG ?>eye.svg" alt="Ver contraseña" class="form__input__eye-img">
                    </button>
                </div>

                <div class="form__input">
                    <input type="password" name="password1" id="password-2" class="form__input-input" placeholder="Repita la nueva contraseña">
                    <label for="password-2" class="form__input-label">Repetir contraseña</label>

                    <button type="button" class="form__input__eye" id="show-pass-btn-2">
                        <img src="<?= RUTAIMG ?>eye.svg" alt="Ver contraseña" class="form__input__eye-img-2">
                    </button>
                </div>

                <button type="submit" class="form-submit">Enviar</button>

            </form>
            <?php 
            }
            ?>         


            <figure class="login__figure">
                <img src="<?= RUTAIMG ?>lunch-login.jpg" alt="Luncheria El Sazón de la Primera" class="login__figure-banner">
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
    <script src="<?= RUTAJS ?>recovery.js"></script>
	<script src="<?= RUTAJS ?>loader.js"></script>

	

</body>

</html>