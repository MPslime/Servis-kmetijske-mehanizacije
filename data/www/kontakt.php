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
            <a href="#" class="button-narociSV">Naroči Servis</a>
            <a href="tel:+38670468410" class="button-klic">Pokliči za nujno pomoč</a>
        </div>
    </section>
    <!--hero konec-->

<article>
                <div class="top-box">
                    <h1>Naročite se na servis!</h1>
                     <p>Načrtujte servis vaše kmetijske mehanizacije preko spleta.</p>
                    <p>Termin bomo potrdili v 2 urah.</p>
                </div>
                <form>
                <div class="form-row">
                    <div class="form-group">
                        <label for="ime">Ime</label>
                        <input type="text" id="ime" name="ime" required>
                    </div>

                    <div class="form-group">
                        <label for="priimek">Priimek</label>
                        <input type="text" id="priimek" name="priimek" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telefon">Telefon</label>
                        <input type="tel" id="telefon" name="telefon" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Mail</label>
                        <input type="email" id="email" name="email">
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="opis">Opis problema</label>
                    <textarea id="opis" name="opis" required></textarea>
                </div>
            </form>

                <div class="bottom-box">
                    <button id="gumbjaka" type="submit">Potrdi rezervacijo</button>
                </div>
        </article>
        </article><br/>

    <?php include 'Footer.php'; ?>

    <!-- JAVASCRIPT-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>


</body>

</html>