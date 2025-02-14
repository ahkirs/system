<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= RUTA ?>/public/sweetAlert/sweetAlert.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>swiper.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>normalize.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>loader.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>base.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>menu.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>home.css">
    <link rel="stylesheet" href="<?= RUTACSS ?>tasa-dolar.css">
    <link rel="icon" href="<?=RUTA?>/public/assets/img/lunch-system-favicon.ico">
    <title>
        <?php echo $this->titlepage; ?>
    </title>
</head>

<body class="layout">

    <?php require($this->menu); ?>

    <main>
        <section class="swiper-section">
            <div class="swiper mySwiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <img src="<?= RUTAIMG ?>arepas.jpg" alt="Arepas" class="swiper-img">
                        <span class="swiper-slide-legend">arepas</span>
                    </div>

                    <div class="swiper-slide">
                        <img src="<?= RUTAIMG ?>empanada.webp" alt="Empanadas" class="swiper-img">
                        <span class="swiper-slide-legend">empanadas</span>
                    </div>

                    <div class="swiper-slide">
                        <img src="<?= RUTAIMG ?>pastelitos.jpg" alt="Pastelitos" class="swiper-img">
                        <span class="swiper-slide-legend">pastelitos</span>
                    </div>
                    
                    <div class="swiper-slide">
                        <img src="<?= RUTAIMG ?>pasticho.webp" alt="Pasticho" class="swiper-img">
                        <span class="swiper-slide-legend">pastichos</span>
                    </div>
                    
                    <div class="swiper-slide">
                        <img src="<?= RUTAIMG ?>jugos.jpg" alt="Jugos" class="swiper-img">
                        <span class="swiper-slide-legend">jugos</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="mision">
            <figure class="mision__figure">
                <img src="<?= RUTAIMG ?>mision.jpg" alt="Interior de la Luncheria El Sazon de la Primera" class="mision__figure-img">
            </figure>

            <div class="mision__texts">
                <h2 class="mision__texts-title">Misión</h2>
                <p class="mision__texts-text">Centrarse en ofrecer una experiencia culinaria autentica y deliciosa, destacando la calidad de sus ingredientes y la preparción de platillos tradicionales. La lunchería busca no solo satisfacer el apetitio de sus clientes, sino también crear un ambiente acogedor donde las personas puedan disfrutar de una comida casera que les recuerde a sus raíces.</p>
            </div>
        </section>

        <section class="vision">
            <figure class="vision__figure">
                <img src="<?= RUTAIMG ?>vision.jpg" alt="Mostrador de la Luncheria El Sazon de la Primera" class="vision__figure-img">
            </figure>

            <div class="vision__texts">
                <h2 class="vision__texts-title">Visión</h2>
                <p class="misionvision__texts__texts-text">Centrarse en ofrecer una experiencia culinaria autentica y deliciosa, destacando la calidad de sus ingredientes y la preparción de platillos tradicionales. La lunchería busca no solo satisfacer el apetitio de sus clientes, sino también crear un ambiente acogedor donde las personas puedanConvertirse en un referente en la comunidad por su oferta gastronómica, siendo reconocida no solo por la calidad de sus platillos, sino también por su compromiso con el servicio al cliente y la sotenibilidad. La lunchería aspira expandir su influencia, promoviendo la cocina tradicional y apoyando a productores locales. disfrutar de una comida casera que les recuerde a sus raíces.</p>
            </div>
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
    <script src="<?= RUTA ?>/public/sweetAlert/sweetAlert.js"></script>
    <script src="<?= RUTAJS ?>loader.js"></script>
    <script src="<?= RUTAJS ?>close-sesion.js"></script>
    <script src="<?= RUTAJS ?>swiper-bundle.js"></script>
    <script src="<?= RUTAJS ?>home.js"></script>
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
    <script src="<?= RUTAJS ?>tasa-dolar.js"></script>
</body>

</html>