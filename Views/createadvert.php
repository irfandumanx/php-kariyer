<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            height: 100vw;
        }
    </style>
</head>
<body>
<?= view("navbar") ?>
<div style="height: 500px; display: flex; justify-content: center; align-items: center">
    <form style="min-width: 350px" method="post">
        <?php echo isset($error) ? "<div class='mb-3 text-center text-danger'>$error</div>" : "" ?>
        <div class="mb-3">
            <label for="title" class="form-label">İlan Başlığı</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">İlan Açıklaması</label>
            <textarea rows="5" class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="w-100 btn btn-primary">İlan Aç</button>
    </form>
</div>

</body>
</html>