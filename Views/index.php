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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>
<body>
<?= view("navbar") ?>
    <?php

        if ($adverts == null) {
            echo <<<EOT
                    <div class="container mb-5">
                         <div class="alert alert-danger" role="alert">
                            Sitede ilan bulunmuyor.
                        </div>
                    </div>
                EOT;
            die();
        }

        foreach ($adverts as $advert) {
            echo <<< EOT
                <div class="card mx-5 mb-4">
                    <div class="card-body">
                        <h5 class="card-title">$advert->title</h5>
                        <p class="card-text">$advert->description</p>
                        <div style="display: flex; justify-content: space-between; align-items: center">
                            <a href="#" class="card-link">$advert->username</a> 
            EOT;
            if ($advert->user_id != $_SESSION['id'])
                echo "<button data-id=\"$advert->id\" class='appeal-button btn btn-primary'>Başvuru Yap</button>";
            echo <<< EOT
                        </div>
                    </div>
                </div>
            EOT;
        }
    ?>
<?= view("pagination", ['totalPages' => $totalPages, 'currentPage' => $currentPage]) ?>
</body>

<script>

    const appealButtons = document.querySelectorAll(".appeal-button");
    appealButtons.forEach(button => {
        button.addEventListener('click', async function() {
            const id = this.getAttribute('data-id');
            let response = await fetch(`advert/appeal?id=${id}`);
            let json = await response.json();
            let colorStr = json['success'] === true ? "#4caf50, #8bc34a" : "#d32f2f, #f44336";
            Toastify({
                text: json['message'],
                duration: 2000,
                gravity: "top",
                position: "right",
                style: {
                    background: `linear-gradient(to right, ${colorStr})`,
                    borderRadius: "10px",
                },
                stopOnFocus: false,
            }).showToast();
        });
    });

</script>

</html>