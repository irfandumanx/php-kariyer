<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
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
    <form style="min-width: 350px" method="post">
        <?php echo isset($error) ? "<div class='mb-3 text-center text-danger'>$error</div>" : "" ?>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">İsim</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="surname" class="form-label">Soyisim</label>
                    <input type="text" class="form-control" id="surname" name="surname">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="username" class="form-label">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Şifre</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <a class="hrf" href="/login">Hesabın mı var?</a>
        </div>
        <button type="submit" class="w-100 btn btn-primary">Kayıt Ol</button>
    </form>
</div>

</body>
</html>