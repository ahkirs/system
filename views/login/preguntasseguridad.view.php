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
    <style>
    .lobibox-notify.lobibox-success {
       background-color: ##2ebf18;
      border-color: #d6e9c6;
    }
    </style>
</head>

<body>

	<main>
        <section class="login" style="padding-bottom: 20px;">
            <form method= "POST" class="form" id="frmSETPS" style="padding: 10px 0;">
                <figure class="form__img">
                    <img src="<?= RUTAIMG ?>logo-name2.png" alt="" class="form__img-img">
                </figure>
                <h2 class="login__form__title"> Crear Preguntas de Seguridad </h2>

                <div class="form__input">
                    <input type="text" name="username" id="username" class="form__input-input" value="<?php echo $this->usuario; ?>" disabled="disabled">
                    <label for="username" class="form__input-label">usuario</label>
                </div>

                <div class="form__input">
                    <input type="text" name="PSpregunta1" id="PSpregunta1" class="form__input-input" placeholder="Ingrese pregunta 1">
                    <label for="username" class="form__input-label form__input-label--tooltip">
                        Pregunta 1
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                        </span>
                    </label>
                </div>
                
                <div class="form__input">
                    <input type="text" name="PSrespuesta1" id="PSrespuesta1" class="form__input-input" placeholder="Ingrese respuesta 1">
                    <label for="username" class="form__input-label form__input-label--tooltip">
                        Respuesta 1
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                        </span>
                    </label>
                </div>


                <div class="form__input">
                    <input type="text" name="PSpregunta2" id="PSpregunta2" class="form__input-input" placeholder="Ingrese pregunta 2">
                    <label for="username" class="form__input-label form__input-label--tooltip">
                        Pregunta 2
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                        </span>
                    </label>
                </div>
                
                <div class="form__input">
                    <input type="text" name="PSrespuesta2" id="PSrespuesta2" class="form__input-input" placeholder="Ingrese respuesta 2">
                    <label for="username" class="form__input-label form__input-label--tooltip">
                        Respuesta 2
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                        </span>
                    </label>
                </div>

                <div class="form__input">
                    <input type="text" name="PSpregunta3" id="PSpregunta3" class="form__input-input" placeholder="Ingrese pregunta 3">
                    <label for="username" class="form__input-label form__input-label--tooltip">
                        Pregunta 3
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                        </span>
                    </label>
                </div>
                
                <div class="form__input">
                    <input type="text" name="PSrespuesta3" id="PSrespuesta3" class="form__input-input" placeholder="Ingrese respuesta 3">
                    <label for="username" class="form__input-label form__input-label--tooltip">
                        Respuesta 3
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="transform: ;msFilter:;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM13 17h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                        </span>
                    </label>
                </div>

                <button type="submit" class="form-submit">Enviar</button>

            </form>

            <figure class="login__figure">
                <img class="login__figure-banner" src="<?= RUTAIMG ?>lunch-login.jpg" alt="Luncheria El Sazón de la Primera">
                <!-- <img src="<?= RUTAIMG ?>logo1.png" alt="" class="login__figure-logo"> -->
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
    <script src="<?= RUTAJS ?>recovery.js"></script>
	

</body>

</html>