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
    <link rel="stylesheet" href="<?= RUTACSS ?>suministros.css">
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
            <h1 class="section-title">suministros</h1>

            <div class="header__cta">
                <a href="<?= RUTA ?>/suministros/historial" class="header-cta">
                    Historial
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 8v5h5v-2h-3V8z"></path><path d="M21.292 8.497a8.957 8.957 0 0 0-1.928-2.862 9.004 9.004 0 0 0-4.55-2.452 9.09 9.09 0 0 0-3.626 0 8.965 8.965 0 0 0-4.552 2.453 9.048 9.048 0 0 0-1.928 2.86A8.963 8.963 0 0 0 4 12l.001.025H2L5 16l3-3.975H6.001L6 12a6.957 6.957 0 0 1 1.195-3.913 7.066 7.066 0 0 1 1.891-1.892 7.034 7.034 0 0 1 2.503-1.054 7.003 7.003 0 0 1 8.269 5.445 7.117 7.117 0 0 1 0 2.824 6.936 6.936 0 0 1-1.054 2.503c-.25.371-.537.72-.854 1.036a7.058 7.058 0 0 1-2.225 1.501 6.98 6.98 0 0 1-1.313.408 7.117 7.117 0 0 1-2.823 0 6.957 6.957 0 0 1-2.501-1.053 7.066 7.066 0 0 1-1.037-.855l-1.414 1.414A8.985 8.985 0 0 0 13 21a9.05 9.05 0 0 0 3.503-.707 9.009 9.009 0 0 0 3.959-3.26A8.968 8.968 0 0 0 22 12a8.928 8.928 0 0 0-.708-3.503z"></path></svg>
                </a>

                <a href="<?= RUTA ?>/suministros/registrar" class="header-cta">
                    agregar
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path></svg>
                </a>

                <a href="<?= RUTA ?>/suministros/comprobante" class="header-cta">
                    Comprobante
                    <svg id="Layer_1" enable-background="new 0 0 480 480" viewBox="0 0 480 480" xmlns="http://www.w3.org/2000/svg"><path d="m442 322v102c0 26.507-21.479 48-48 48h-308c-26.51 0-48-21.49-48-48v-392c0-13.25 10.75-24 24-24h260c13.25 0 24 10.75 24 24v36.4c-.42.12-.85.73-1.28 1.79.43.11.86.22 1.28.34v227.47h72c13.25 0 24 10.75 24 24z" fill="#d1e7ff"/><path d="m346 32c0 14.098-10.74 25.837-24.774 27.174-130.801 12.466-233.226 122.62-233.226 256.826v108.423c0 32.622-50 34.273-50-.422v-392.001c0-13.255 10.745-24 24-24h260c13.255 0 24 10.745 24 24z" fill="#e8f3ff"/><path d="m346 68.4v2.13c-.42-.12-.85-.23-1.28-.34.43-1.06.86-1.67 1.28-1.79z" fill="#d6f4fc"/><path d="m442 322v102c0 26.507-21.479 48-48 48-26.51 0-48-21.49-48-48v-126h72c13.25 0 24 10.75 24 24z" fill="#b9dcff"/><path d="m417 164c0 53.598-43.461 97-97 97-72.441 0-119.219-76.719-86.47-141 16.062-31.491 48.795-53 86.47-53 53.529 0 97 43.393 97 97z" fill="#d1e7ff"/><path d="m364.121 77.457c14.377 7.263 9.518 29.14-6.584 29.57-51.971 1.39-93.025 42.979-94.503 94.162-.465 16.098-22.203 21.135-29.515 6.786-14.042-27.556-14.03-60.414.011-87.975 25.998-50.972 85.769-65.187 130.591-42.543z" fill="#e8f3ff"/><path d="m215 164c0 57.897 47.103 105 105 105s105-47.103 105-105-47.103-105-105-105-105 47.103-105 105zm194 0c0 49.075-39.925 89-89 89s-89-39.925-89-89 39.925-89 89-89 89 39.925 89 89zm-89-54c4.418 0 8 3.582 8 8v3.376c9.311 3.303 16 12.195 16 22.624 0 4.418-3.582 8-8 8s-8-3.582-8-8c0-4.411-3.589-8-8-8s-8 3.589-8 8v3.237c0 3.518 2.256 6.586 5.614 7.636l9.544 2.982c10.074 3.149 16.842 12.355 16.842 22.908v3.237c0 11.519-8.159 21.166-19 23.473v2.527c0 4.418-3.582 8-8 8s-8-3.582-8-8v-4.68c-7.714-3.996-13-12.05-13-21.32 0-4.418 3.582-8 8-8s8 3.582 8 8c0 4.411 3.589 8 8 8s8-3.589 8-8v-3.237c0-3.518-2.256-6.586-5.614-7.636l-9.544-2.982c-10.074-3.149-16.842-12.355-16.842-22.908v-3.237c0-10.429 6.689-19.321 16-22.624v-3.376c0-4.418 3.582-8 8-8zm130 212v102c0 30.879-25.122 56-56 56h-308c-30.878 0-56-25.121-56-56v-392c0-17.645 14.355-32 32-32h260c17.645 0 32 14.355 32 32 0 4.418-3.582 8-8 8s-8-3.582-8-8c0-8.822-7.178-16-16-16h-260c-8.822 0-16 7.178-16 16v392c0 22.056 17.944 40 40 40h268.862c-10.395-10.172-16.862-24.342-16.862-40v-125c0-4.418 3.582-8 8-8s8 3.582 8 8v125c0 22.056 17.944 40 40 40s40-17.944 40-40v-102c0-8.822-7.178-16-16-16h-34c-4.418 0-8-3.582-8-8s3.582-8 8-8h34c17.645 0 32 14.355 32 32zm-350-107c0-4.418 3.582-8 8-8h68c4.418 0 8 3.582 8 8s-3.582 8-8 8h-68c-4.418 0-8-3.582-8-8zm0-90c0-4.418 3.582-8 8-8h68c4.418 0 8 3.582 8 8s-3.582 8-8 8h-68c-4.418 0-8-3.582-8-8zm184 180c0 4.418-3.582 8-8 8h-168c-4.418 0-8-3.582-8-8s3.582-8 8-8h168c4.418 0 8 3.582 8 8zm0 84c0 4.418-3.582 8-8 8h-168c-4.418 0-8-3.582-8-8s3.582-8 8-8h168c4.418 0 8 3.582 8 8z" fill="#2e58ff"/></svg>
                </a>
            </div>
        </header>

        <section class="stadistics">
            <p class="stadistics-paragraph">
                Suministros totales: <span class="stadistics-span" id="suministros-totales"></span > - Categorías: <span class="stadistics-span" id="categories"></span>
            </p>
        </section>

        <section class="supplies">
        </section>
    </main>


    <!-- Loader -->
    <section class="loader__section" id="loader-section">
        <span class="loader"></span>
    </section>




    <script>var RUTA = "<?php echo RUTA; ?>";</script>
    <script>var RUTA_IMG = "<?php echo RUTAIMG; ?>";</script>
    <script src="<?= RUTA ?>/public/jquery/jquery.min.js"></script>
    <script src="<?= RUTA ?>/public/lobibox/lobibox.min.js"></script>
    <script src="<?= RUTAJS ?>loader.js"></script>
    <script src="<?= RUTAJS ?>close-sesion.js"></script>
    <script src="<?= RUTA ?>/public/sweetAlert/sweetAlert.js"></script>
    <script src="<?= RUTAJS ?>suministros.js"></script>
    <script src="<?= RUTAJS ?>listar-providers.js"></script>
    <script src="<?= RUTAJS ?>suministros-abastecer.js"></script>
    <script src="<?= RUTAJS ?>mobile-menu.js"></script>
</body>

</html>