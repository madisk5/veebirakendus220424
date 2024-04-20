<?php 
// Andmebaasiühendus
require_once 'config/mysqli.php';

// Siia tuleb suurem ports PHP koodi aga kõik on loogiline
// Loe kokku kirjed
$sql = 'SELECT COUNT(id) AS total FROM simple;';
$res = $database->dbGetArray($sql);
$total = $res[0]['total'];
// Mitmendal leheküljel oleme
if($total > 0){
    if(isset($_GET['pg'])){
        $pg = $_GET['pg']; //URLilt saadud lk. number

    } else {
        $pg = 1;
    }
} else {
    $pg = 1;
}

$totalRows = $total;
$maxPerPage = MAXPERPAGE; // MAXPERPAGE tuleb confiq/mysqli.php failist
$pageCount = ceil($totalRows / $maxPerPage);

// Vigane pg väärtus muudetakse 1
if(empty($pg) || $pg < 1 || $pg > $pageCount){
    $pg = 1;
}

$nextStart = $pg * $maxPerPage;
$start = $nextStart - $maxPerPage;

// Defineeri leht, kuhu suunatakse

$page = isset($_GET['page']) ? $_GET['page'] : (isset($_POST['page']) ? $_POST['page'] : 'homepage');


?>
<nav aria-label="Page navigation">
    <div class="pagination pagination-color justify-content-center">
        <div class="page-item">
            <a class="page-link <?php echo ($pg == 1) ? 'disabled': null; ?>" href="<?php echo ($page == 'kodutoo') ? 'kodutoo.php' : 'index.php'; ?>?page=<?php echo $page; ?>&pg=1" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </div>
        <div class="page-item">
            <a class="page-link <?php echo ($pg == 1) ? 'disabled': null; ?>" href="<?php echo ($page == 'kodutoo') ? 'kodutoo.php' : 'index.php'; ?>?page=<?php echo $page; ?>&pg=<?php echo (($pg - 1) == 0) ? "1" : ($pg - 1); ?>" aria-label="Previous">
                <span aria-hidden="true">&lsaquo;</span>
            </a>
        </div>
        <?php for($x = 0; $x < $pageCount; $x++): ?>
            <div class="page-item">
                <a class="page-link <?php echo ($x + 1 == $pg) ? 'active' : ''; ?>" href="<?php echo ($page == 'kodutoo') ? 'kodutoo.php' : 'index.php'; ?>?page=<?php echo $page; ?>&pg=<?php echo $x + 1; ?>"><?php echo $x + 1; ?></a>
            </div>
        <?php endfor; ?>
        <div class="page-item">
            <a class="page-link <?php echo ($pg >= $pageCount) ? 'disabled': ''; ?>" href="<?php echo ($page == 'kodutoo') ? 'kodutoo.php' : 'index.php'; ?>?page=<?php echo $page; ?>&pg=<?php echo min($pg + 1, $pageCount); ?>" aria-label="Next">
                <span aria-hidden="true">&rsaquo;</span>
            </a>
        </div>
        <div class="page-item">
            <a class="page-link <?php echo ($pg >= $pageCount) ? 'disabled': ''; ?>" href="<?php echo ($page == 'kodutoo') ? 'kodutoo.php' : 'index.php'; ?>?page=<?php echo $page; ?>&pg=<?php echo $pageCount; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </div>
    </div>
</nav>
