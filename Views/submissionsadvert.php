<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kariyer İlanları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        a {
            color: darkcyan;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?= view("navbar") ?>
<?php

    if (count($datas) == 0) {
        echo <<<EOT
            <div class="container mb-5">
                 <div class="alert alert-danger" role="alert">
                    İlanlarınıza başvuran yok.
                </div>
            </div>
        EOT;
        die();
    }

    foreach ($datas as $data) {
        echo <<<EOT
            <div class="container mb-5">
                <div class="card" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
                    <div class="card-body">
                        <h5 class="card-title">{$data["entity"]->title}</h5>
                        <p class="card-text">{$data["entity"]->description}</p>
                    </div>
                </div>
                <div class="card border-top-0" style="border-top-left-radius: 0; border-top-right-radius: 0;">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Başvuranlar</h6>
                        <ul class="list-group">
        EOT;
                        foreach ($data["appeals"] as $appeal) {
                            $entity = $appeal[0];
                            echo <<<EOT
                                <li class="list-group-item">
                                    <div><strong>İsim:</strong> $entity->name $entity->surname</div>
                                    <div><strong>Başvuru Tarihi:</strong> {$appeal["created_at"]}</div>
                                    <div><strong>Mail ile ulaşın -></strong> $entity->email</div>
                                </li>
                            EOT;
                        }
        echo <<<EOT
                        </ul>
                    </div>
                </div>
            </div>
        EOT;
    }
?>
<?= view("pagination", ['totalPages' => $totalPages, 'currentPage' => $currentPage]) ?>

</body>
</html>