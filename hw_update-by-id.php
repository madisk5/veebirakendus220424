<?php 
require_once(__DIR__ . "/config/mysqli.php");

// Kas ids on ja kas on number
if(isset($_GET['ids']) && is_numeric($_GET['ids'])) {
    $id = $_GET['ids'];
    if(is_numeric($id)) {
        $sql = 'SELECT * FROM simple WHERE id = '.$id;
        $res = $database->dbGetArray($sql);
    }
}

// Määratleme vaikimisi lehekülje numbri, kui kasutaja pole määratlenud
$pageNumber = isset($_GET['pg']) ? $_GET['pg'] : 1;
$prevPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'kodutoo.php?page=kodutoo';
?>
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8">
            <h3 class="text-center">Update - Muuda tabeli kirjet</h3>

            <form action="hw_update.php?pg=<?php echo $pageNumber; ?>" method="post">
                
                <div class="row mb-2">
                    <label for="name" class="col-sm-2 form-label mt-1 fw-bold">Nimi</label>
                    <div class="col">
                        <input type="text" name="name" value="<?php if(isset($res[0]['name'])) {echo $res[0]['name'];} ?>" id="name" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="birth" class="col-sm-2 form-label mt-1 fw-bold">Sünniaeg</label>
                    <div class="col">
                        <input type="date" name="birth" value="<?php if(isset($res[0]['birth'])) {echo $res[0]['birth'];} ?>" id="birth" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="salary" class="col-sm-2 form-label mt-1 fw-bold">Palk</label>
                    <div class="col">
                        <input type="number" min="0" max="9999" step="1"  name="salary" value="<?php if(isset($res[0]['salary'])) {echo $res[0]['salary'];} ?>" id="salary" class="form-control">
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="height" class="col-sm-2 form-label mt-1 fw-bold">Pikkus</label>
                    <div class="col">
                        <input type="number" min="0.00" max="2.72" step="0.01" name="height" value="<?php if(isset($res[0]['height'])) {echo $res[0]['height'];} ?>" id="height" class="form-control">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <input type="hidden" name="sid" value="<?php if(isset($res[0]['id'])) {echo $res[0]['id'];} ?>">
                        <input type="hidden" name="prev_pg" value="<?php echo $prevPage; ?>">
                        <input type="submit" name="submit" value="Muuda andmeid" class="btn btn-warning form-control">                        
                    </div>
                    <div class="col">
                        <button type="reset" class="btn btn-info form-control">Reseti vorm</button>
                    </div>

                </div>

            </form>
        </div>

        <div class="col-sm-2"></div>
    </div>
</div>

<?php
// Kontrollime, kas muudatused on salvestatud
if(isset($_POST['submit'])) {
   
    
    
    exit(); // Veendume, et suunamine toimub korrektselt
}
?>
