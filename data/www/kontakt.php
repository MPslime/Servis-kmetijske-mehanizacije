<?php
include 'db.php';

$lastIdStranka = null;
$lastIdRezervacija = null;

// DELETE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM Rezervacija WHERE idRezervacija = :id");
    $stmt->execute([':id' => intval($_POST['idRezervacija'])]);
    $deleted = true;
}

// UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $stmt = $conn->prepare("UPDATE Stranka 
                            SET Ime = :ime, Priimek = :priimek, Email = :email 
                            WHERE idStranka = :id");
    $stmt->execute([
        ':ime'     => trim($_POST['update_ime']),
        ':priimek' => trim($_POST['update_priimek']),
        ':email'   => trim($_POST['update_email']),
        ':id'      => intval($_POST['idStranka'])
    ]);
    $updated = true;
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['update']) && !isset($_POST['delete'])) {
    $ime      = trim($_POST['ime'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $storitev = intval($_POST['storitev'] ?? 0);
    $sporocilo = trim($_POST['sporocilo'] ?? '');

    if ($ime && $email && $storitev) {
        try {
            $stmt = $conn->prepare("SELECT idStranka FROM Stranka WHERE Email = :email");
            $stmt->execute([':email' => $email]);
            $existing = $stmt->fetch();

            if ($existing) {
                $lastIdStranka = $existing['idStranka'];
            } else {
                $parts = explode(' ', $ime, 2);
                $stmt = $conn->prepare("INSERT INTO Stranka (Ime, Priimek, Email) 
                                        VALUES (:ime, :priimek, :email)");
                $stmt->execute([
                    ':ime'     => $parts[0],
                    ':priimek' => isset($parts[1]) ? $parts[1] : '',
                    ':email'   => $email
                ]);
                $lastIdStranka = $conn->lastInsertId();
            }

            $stmt = $conn->prepare("INSERT INTO Rezervacija (Datum_in_ura, TK_idStranka, TK_idStoritve) 
                                    VALUES (NOW(), :stranka, :storitev)");
            $stmt->execute([
                ':stranka'  => $lastIdStranka,
                ':storitev' => $storitev
            ]);
            $lastIdRezervacija = $conn->lastInsertId();
            $success = true;

        } catch (PDOException $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = "Prosimo, izpolnite vsa obvezna polja.";
    }
}
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
<section class="hero-section3">
    <div class="container d-flex justify-content-center flex-column h-100">
        <h1 class="fw-bold text-white">Kontakt</h1>
        <p class="text-white mt-2">Imate vprašanja ali potrebujete pomoč? Tu smo za vas. Stopite v stik z našo ekipo.</p>
        <div>
            <a href="tel:+38670468410" class="button-klic mt-3">Pokliči za nujno pomoč</a>
        </div>
    </div>
</section>
    <!--hero konec-->

<section class="py-5">
    <div class="container">
        <div class="row g-4">

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <div class="icon-box mb-3">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h5 class="fw-bold mt-2">Obiščite nas</h5>
                    <p class="text-muted mt-2">Kmetijska cesta 123<br>1000 Ljubljana, Slovenija</p>
                    <a href="https://maps.google.com" class="kontakt-link" target="_blank">Pot do nas &rarr;</a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <div class="icon-box mb-3">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h5 class="fw-bold mt-2">Pokličite nas</h5>
                    <p class="text-muted mt-2">+386 1 234 5678<br>Nujna pomoč: +386 1 234 5679</p>
                    <a href="tel:+38612345678" class="kontakt-link">Pokliči zdaj &rarr;</a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <div class="icon-box mb-3">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h5 class="fw-bold mt-2">Pišite nam</h5>
                    <p class="text-muted mt-2">info@agriservis.si<br>nujno@agriservis.si</p>
                    <a href="mailto:info@agriservis.si" class="kontakt-link">Pošlji e-pošto &rarr;</a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <div class="icon-box mb-3">
                        <i class="bi bi-clock"></i>
                    </div>
                    <h5 class="fw-bold mt-2">Delovni čas</h5>
                    <p class="text-muted mt-2">
                        Pon-Pet: 7:00 - 18:00<br>
                        Sobota: 8:00 - 16:00<br>
                        Nedelja: Samo nujni primeri
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FORMA IN ZEMLJEVID -->
<?php if (isset($success)): ?>
    <div class="alert alert-success mb-4">
        Vaše sporočilo je bilo uspešno poslano! Potrditev bomo poslali na vaš e-mail.
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="alert alert-danger mb-4">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php if (isset($deleted)): ?>
    <div class="alert alert-warning">Vaša rezervacija je bila izbrisana.</div>
<?php endif; ?>

<?php if (isset($updated)): ?>
    <div class="alert alert-success">Vaši podatki so bili posodobljeni.</div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>


<section class="py-5">
    <div class="container">
        <div class="row g-5">

            <!-- Forma -->
            <div class="col-12 col-lg-7">
                <h2 class="fw-bold mb-4">Pošljite nam sporočilo</h2>

                <form method="POST" action="">

                    <div class="mb-3">
                        <label class="form-label">Ime <span class="text-danger">*</span></label>
                        <input type="text" name="ime" class="form-control kontakt-input"
                               value="<?= htmlspecialchars($_POST['ime'] ?? '') ?>" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label">E-pošta <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control kontakt-input"
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">Telefon</label>
                            <input type="tel" name="telefon" class="form-control kontakt-input"
                                   value="<?= htmlspecialchars($_POST['telefon'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Storitev</label>
                        <select name="storitev" class="form-control kontakt-input">
                            <option value="" disabled selected>Izberite storitev...</option>
                            <?php
                                $storitve = $conn->query("SELECT * FROM Storitve ORDER BY Ime_storitve")
                                                 ->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($storitve as $s) {
                                    $selected = (isset($_POST['storitev']) && $_POST['storitev'] == $s['idStoritve'])
                                                ? 'selected' : '';
                                    echo "<option value='{$s['idStoritve']}' {$selected}>{$s['Ime_storitve']}</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Sporočilo <span class="text-danger">*</span></label>
                        <textarea name="sporocilo" class="form-control kontakt-input" rows="5"
                                  placeholder="Kako vam lahko pomagamo?" required><?= htmlspecialchars($_POST['sporocilo'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="button-narociSV">
                        <i class="bi bi-send me-2"></i>Pošlji sporočilo
                    </button>
                    <p class="text-muted mt-3" style="font-size: 13px;">* Obvezna polja</p>

                </form>
            </div>

<?php if (isset($success) && $success === true): ?>
<div class="mt-4 p-4 border rounded-4 bg-light">
    <h5 class="fw-bold mb-3">Upravljanje vaše rezervacije</h5>

    <!-- UPDATE -->
    <form method="POST" action="" class="mb-3">
        <input type="hidden" name="idStranka" value="<?= $lastIdStranka ?>">
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <input type="text" name="update_ime" class="form-control kontakt-input"
                       placeholder="Novo ime" required>
            </div>
            <div class="col-12 col-md-4">
                <input type="text" name="update_priimek" class="form-control kontakt-input"
                       placeholder="Nov priimek" required>
            </div>
            <div class="col-12 col-md-4">
                <input type="email" name="update_email" class="form-control kontakt-input"
                       placeholder="Nov e-mail" required>
            </div>
        </div>
        <button type="submit" name="update" class="button-narociSV mt-3">
            <i class="bi bi-pencil me-2"></i>Posodobi podatke
        </button>
    </form>

    <!-- DELETE -->
    <form method="POST" action=""
          onsubmit="return confirm('Ali ste prepričani, da želite izbrisati vašo rezervacijo?')">
        <input type="hidden" name="idRezervacija" value="<?= $lastIdRezervacija ?>">
        <button type="submit" name="delete" class="btn btn-outline-danger rounded-pill">
            <i class="bi bi-trash me-2"></i>Izbriši rezervacijo
        </button>
    </form>
</div>
<?php endif; ?>

            <!-- Zemljevid -->
            <div class="col-12 col-lg-5">
                <h2 class="fw-bold mb-4">Najdite nas</h2>
                <div class="zemljevid-box rounded-4 d-flex flex-column align-items-center justify-content-center text-center p-5">
                    <i class="bi bi-geo-alt-fill zemljevid-pin"></i>
                    <h6 class="fw-bold mt-3">Lokacija na zemljevidu</h6>
                    <p class="text-muted mb-3">Kmetijska cesta 123, Ljubljana</p>
                    <a href="https://maps.google.com" class="kontakt-link" target="_blank">Odpri v Google Maps &rarr;</a>
                </div>
            </div>

        </div>
    </div>
</section>

    <?php include 'Footer.php'; ?>

    <!-- JAVASCRIPT-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>


</body>

</html>