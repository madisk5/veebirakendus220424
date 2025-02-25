<?php
require_once(__DIR__ . "/config/mysqli.php");

// Kui submit nupp on vajutatud update-by-id vormil
if(isset($_POST['submit'])) {
    $id = $_POST['sid'];    
    $name = $_POST['name'];    
    $birth = $_POST['birth'];
    $salary = $_POST['salary'];
    $height = $_POST['height'];
    if(empty($salary)) {
        $salary = 'NULL';
    }
    if(empty($height)) {
        $height = 'NULL';
    }
    $sql = 'UPDATE simple SET
            name = '.$database->dbFix($name).',
            birth = '.$database->dbFix($birth).',
            salary = '.$salary.',
            height = '.$height.',
            added = added
            WHERE id = '.$id;
    if($database->dbQuery($sql)) {
        $success = true;
        $_POST = array();
        
        // Suuname tagasi kodutoo.php lehele
        header("Location: kodutoo.php?page=kodutoo");
        exit;
    } else {
        $success = ('Location: index.php?page=update');
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
 
        <div class="col-sm-8">
            <h3 class="text-center">Update - Kliki muutmis ikoonil muutmiseks</h3>
            <?php
            // Kui toimus uuendamine
            if(isset($success) && $success){
                ?>
                <div class="alert alert-success">
                    Sissekanne on uuendatud.
                </div>
                <?php
             
            } else if(isset ($success) && !$success) {
                ?>
                <div class="alert alert-danger">
                    Sissekande uuendamisel tekkis tõrge.
                </div>
                <?php
    
            }
            
            
            // sql lause, päring ja if lause
            $sql = 'SELECT * FROM simple ORDER BY added DESC';
            $res = $database->dbQuery($sql);
            if($res !== false) {
 
            
            ?>
                <table class="table table-bordered table-striped table-hover mt-2">
                    <thead class="text-center">
                        <tr>
                            <th>Jrk</th>
                            <th>Nimi</th>
                            <th>Sünniaeg</th>
                            <th>Palk</th>
                            <th>Pikkus</th>
                            <th>Lisatud</th>
                            <th>Tegevus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // foreach-loop algab
                        foreach($res as $key=>$val) {
                            $date = new DateTime($val['birth']);
                            $birth = $date->format("d.m.Y");
                            $dateTime = new DateTime($val['added']);
                            $added = $dateTime->format('d.m.Y H:i:s');

                            // Kui kirje ID vastab URL-ist saadud ID-le, täidame väljad väärtustega
                            if(isset($_GET['ids']) && $_GET['ids'] == $val['id']) {
                                $name = $val['name'];
                                $birth = $val['birth'];
                                $salary = $val['salary'];
                                $height = $val['height'];
                            }
                        ?>
                            <tr>
                                <td class="text-end"><?php echo ($key +1); ?>.</td>
                                <td><?php echo $val['name']; ?></td>
                                <td><?php echo $birth; ?></td>
                                <td class="text-end"><?php echo $val['salary']; ?></td>
                                <td class="text-end"><?php echo $val['height']; ?></td>
                                <td><?php echo $added; ?></td>
                                <td class="text-center">
                                    <a href="kodutoo.php?page=update&ids=<?php echo $val['id']; ?>"><i class="fa-solid fa-pen-to-square text-warning" title="Edit"></i></a>
                                </td>
                            </tr>
                        <?php
                        // foreach-loop lõppeb
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            // if lause else
            } else {
            ?>
                <p class="text-danger fs-4 text-center fw-bold">Isikuid ei leitud</p>
            <?php
            // if lause lõppeb
            }
            ?>
        </div>
 
        <div class="col-sm-2"></div>
    </div>
</div>
