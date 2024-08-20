<nav class="mb-5 navbar navbar-expand-lg bg-body-tertiary">
    <div style="display: flex; justify-content: space-around; align-items: center; min-width: 100%;">
        <a class="navbar-brand" href="/">Kariyer İlanları</a>
        <div style="min-width: 400px">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="İlan Başlığı Arayın" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Ara</button>
            </form>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['username'] ?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/advert/create">İlan Aç</a></li>
                <li><a class="dropdown-item" href="/advert/submissions">Başvuranlar</a></li>
                <li><a class="dropdown-item" href="/logout">Çıkış Yap</a></li>
            </ul>
        </div>
    </div>
</nav>