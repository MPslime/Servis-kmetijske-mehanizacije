<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="sl">

<head>
    <title>AgroServis</title>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
    <?php include 'Header.php'; ?>
    <!--HERO-->
    <section class="hero-section">
        <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
            <h1>Strokovni servis kmetijske mehanizacije</h1>
            <h2>Naročite servis le v nekaj minutah</h2>
            <a href="kontakt.php" class="button-narociSV">Naroči Servis</a>
            <a href="tel:+38670468410" class="button-klic">Pokliči za nujno pomoč</a>
        </div>
    </section>
    <!--hero konec-->

    <!--PONUDBA-->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">

                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <div class="icon-box mb-4">
                            <i class="bi bi-wrench"></i>
                        </div>
                        <h5 class="fw-bold">Strokovne popravila</h5>
                        <p class="text-muted">Certificirani tehniki z dolgoletnimi izkušnjami pri kmetijski mehanizaciji
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <div class="icon-box mb-4">
                            <i class="bi bi-clock"></i>
                        </div>
                        <h5 class="fw-bold">Hiter servis</h5>
                        <p class="text-muted">Servis še isti dan za nujne popravila, da se lahko čimprej vrnete nazaj na
                            delo</p>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <div class="icon-box mb-4">
                            <i class="bi bi-patch-check"></i>
                        </div>
                        <h5 class="fw-bold">Kakovostni deli</h5>
                        <p class="text-muted">Originalni in kakovostni nadomestni deli za vse večje blagovne znamke</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--PONUDBA KONEC-->

    <!--STORITVE-->
    <section class="storitve py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Naše storitve</h2>
                <p class="text-muted">Celovite servisne rešitve za vse vaše potrebe</p>
            </div>
            <div class="row g-4">

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border rounded-4 p-4 h-100">
                        <h5 class="fw-bold">Redno vzdrževanje</h5>
                        <p class="text-muted">Ohranite vašo opremo v vrhunskem stanju z rednim servisiranjem</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border rounded-4 p-4 h-100">
                        <h5 class="fw-bold">Nujna popravile</h5>
                        <p class="text-muted">Nujna pomoč, da vas čim prej vrnemo na delo</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border rounded-4 p-4 h-100">
                        <h5 class="fw-bold">Deli in dodatki</h5>
                        <p class="text-muted">Široka izbira rezervnih delov in dodatkov na zalogi</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card border rounded-4 p-4 h-100">
                        <h5 class="fw-bold">Diagnostika opreme</h5>
                        <p class="text-muted">Napredna diagnostična orodja za hitro identifikacijo in odpravo težav</p>
                    </div>
                </div>

            </div>
            <div class="text-center mt-5">
                <a href="storitve.php" class="button-narociSV">Preglej vse storitve &rarr;</a>
            </div>
        </div>
    </section>
    <!--STORITVE KONEC-->

    <!--GUMB-->
    <section class="cta py-5">
        <div class="container text-center">
            <h2 class="fw-bold text-white">Potrebujete servis danes?</h2>
            <p class="text-white mt-2 mb-4">Naročite svoj termin preko spleta ali nas pokličite za nujno pomoč</p>
            <a href="kontakt.php" class="button-cta">Naroči servis &rarr;</a>
        </div>
    </section>
    <!--GUMB konec-->


    <?php include 'Footer.php'; ?>

    <!-- JAVASCRIPT-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

        
</body>

</html>