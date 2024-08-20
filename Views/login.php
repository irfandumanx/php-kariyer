<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .hrf {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <?php echo isset($error) ? "<div class='mb-3 text-center text-danger'>$error</div>" : "" ?>
    <form style="min-width: 350px" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Email | Kullanıcı Adı</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Şifre</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <a class="hrf" href="/register">Hesabın yok mu?</a>
        </div>
        <button type="submit" class="w-100 btn btn-primary">Giriş Yap</button>
    </form>
</div>

</body>
</html>