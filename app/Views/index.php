<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import CSV</title>
    <link rel="stylesheet" href="asset/style.css">
</head>

<body>
    <div class="import-container">
        <h2>Importer vos données</h2>
        <p>Sélectionnez un fichier CSV pour mettre à jour la base de données.</p>

        <form action="<?= site_url('import/upload') ?>" method="post" enctype="multipart/form-data">

            <div class="drop-zone" id="dropZone">
                <span class="drop-zone-icon">📁</span>
                <span class="drop-zone-text">Glissez-déposez votre fichier ici ou <span
                        style="color: var(--primary);">parcourez</span></span>
                <input type="file" name="csv_file" id="fileInput" accept=".csv" required>
                <div class="file-name" id="fileName"></div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                Lancer l'importation
            </button>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    ✅ <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    ❌ <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>

<script src="asset/index.js"></script>

</html>