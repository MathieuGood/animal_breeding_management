<!-- Pagination -->
<!-- Modify page numbers displayed (previous and next) relatively to the current_page -->
<nav aria-label="Page navigation for animal list">
    <ul class="pagination">
        <?php
        if ($current_page <= 1) {
            // On page 1, disable links on "First" and "Previous"
            if ($total_page <= 2) {
                if ($total_page == 1) {
                    $disabled_option = 'disabled';
                } else {
                    $disabled_option = '';
                }
                echo '
                    <li class="page-item disabled"><a class="page-link" href="#" onclick=pageAnimalList(1)>First</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#" onclick=pageAnimalList(1)>←</a></li>
                    <li class="page-item active"><a class="page-link" href="#" onclick=pageAnimalList(1)>1</a></li>
                    <li class="page-item ' . $disabled_option . '"><a class="page-link" href="#" onclick=pageAnimalList(2)>2</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#" >3</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">→</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Last</a></li>
                ';
            } else {
                echo '
                    <li class="page-item disabled"><a class="page-link" href="#">First</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">←</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#" onclick="pageAnimalList(2)">2</a></li>
                    <li class="page-item"><a class="page-link" href="#" onclick="pageAnimalList(3)">3</a></li>
                    <li class="page-item"><a class="page-link" href="#" onclick="pageAnimalList(2)">→</a></li>
                    <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(' . ($total_page) . ')>Last</a></li>
                    ';
            }


            // On last page, disable links on "Last" and "Next"
        } else if ($current_page >= $total_page) {
            // Case if there are only 2 pages
            if ($total_page == 2) {
                echo '
                    <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(1)>First</a></li>
                    <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(1)>←</a></li>
                    <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(1)>1</a></li>
                    <li class="page-item active"><a class="page-link" href="#" onclick=pageAnimalList(2)>2</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#" >3</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">→</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Last</a></li>
                    ';
                // Case if there is only 1 page
            } else {
                echo '
                    <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(1)>First</a></li>
                    <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(' . ($total_page - 2) . ')>←</a></li>
                    <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(' . ($total_page - 2) . ')>' . ($total_page - 2) . '</a></li>
                    <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(' . ($total_page - 1) . ')>' . ($total_page - 1) . '</a></li>
                    <li class="page-item active"><a class="page-link" href="#" onclick=pageAnimalList(' . $total_page . ')>' . $total_page . '</a></li>
        
                    <li class="page-item disabled"><a class="page-link" href="#">→</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#">Last</a></li>
                    ';
            }
        } else {

            echo '
            <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(1)>First</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(' . ($current_page - 1) . ')>←</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(' . ($current_page - 1) . ')>' . ($current_page - 1) . '</a></li>
            <li class="page-item active"><a class="page-link" href="#" onclick=pageAnimalList(' . $current_page . ')>' . $current_page . '</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(' . ($current_page + 1) . ')>' . ($current_page + 1) . '</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(' . ($current_page + 1) . ')>→</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick=pageAnimalList(' . ($total_page) . ')>Last</a></li>
            ';
        }
        ?>
    </ul>
</nav>