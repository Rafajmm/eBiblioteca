<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>eBiblioteca<?= isset($titulo) ? ' · '. htmlspecialchars($titulo) : ''?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet" />

    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/bootstrap-icons/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="assets/css/ebiblioteca.css" rel="stylesheet" />

    <?php if (isset($css_extra)): ?>
        <?php foreach($css_extra as $css):?>
            <link href="<?= $css ?>" rel="stylesheet" />
        <?php endforeach; ?>
    <?php endif; ?>

  </head>

  <body>
    <?php require_once __DIR__ . '/components/header.php'; ?>
    
    <main class="container-fluid py-4 px-md-5">
        <?= $contenido ?>
    </main>


    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/ebiblioteca.js"></script>

    <?php if (isset($js_extra)): ?>
        <?php foreach($js_extra as $js):?>
            <script src="<?= $js ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
  </body>
</html>
