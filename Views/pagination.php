<nav>
    <ul class="pagination justify-content-center">
        <?php
        $previousDisabled = "";
        $nextDisabled = "";
        $previousPage = $currentPage;
        $currentPage++;
        $nextPage = $currentPage + 1;
        $totalPages++;
        $buttonCount = 5;
        if ($previousPage == 0)
            $previousDisabled = "disabled";
        if ($currentPage == $totalPages)
            $nextDisabled = "disabled";
        if ($totalPages > 0) {
            echo "<li class='page-item $previousDisabled'><a href='?page=$previousPage' class='page-link'>Önceki</a></li>";
            if ($totalPages <= $buttonCount) {
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $currentPage)
                        echo "<li id='page-{$i}' class='page-item active'><span class='page-link'>$i</span></li>";
                    else
                        echo "<li id='page-{$i}' class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";

                }
            }else if($currentPage < 3) {
                for ($i = 1; $i <= $buttonCount; $i++) {
                    if ($i == $currentPage)
                        echo "<li id='page-{$i}' class='page-item active'><span class='page-link'>$i</span></li>";
                    else
                        echo "<li id='page-{$i}' class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                }
            }
            else {
                if ($currentPage + 3 > $totalPages) {
                    for ($i = $currentPage - 4 + ($totalPages - $currentPage); $i <= $totalPages; $i++) {
                        if ($i == $currentPage)
                            echo "<li id='page-{$i}' class='page-item active'><span class='page-link'>$i</span></li>";
                        else
                            echo "<li id='page-{$i}' class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                    }
                }
                else {
                    for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) {
                        if ($i == $currentPage)
                            echo "<li id='page-{$i}' class='page-item active'><span class='page-link'>$i</span></li>";
                        else
                            echo "<li id='page-{$i}' class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                    }
                }
            }
            echo "<li class='page-item $nextDisabled'><a class='page-link' href='?page={$nextPage}'>Sonraki</a></li>";
        }
        ?>
        <li class='page-item' style="position: relative">
            <button class="page-link" onclick="showPageInput()">...</button>
            <input type="number" id="page-input" class="form-control" style="display:none; position: absolute; bottom: 100%; left: 50%; transform: translateX(-50%); width: 100px; text-align: center;" value="1">
        </li>
    </ul>
</nav>

<script>

    const pageInput = document.getElementById("page-input");
    pageInput.onkeyup = (event) => {
        if (event.key === 'Enter') {
            let page = document.getElementById("page-input").value;
            if (page > 0)
                window.location.href = '?page=' + page;
        }
    }
    function showPageInput() {
        document.getElementById("page-input").style.display = "inline-block";
        pageInput.focus();
    }

</script>