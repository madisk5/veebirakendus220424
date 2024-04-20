<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Minu JavaScriptid -->
    <script src="js/my_scripts.js" type="text/javascript"></script>
    
    


    <title>CRUD MySQLi kodutöö</title>
</head>

<body>
    <!-- MENÜÜ -->
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <?php require_once 'menu.php'; ?>
            </div>
        </div>
    </div>

    <!-- Siin toimub autmaatne sisu lugemine -->
    <div class="container">
    <h2 class="text-center">Madise kodutöö</h2>
<?php
// Lisame siia leheküljendamise
include 'paginate.php';
?>

<div class="container">
    <div class="row">
        <div class="col">
            <?php
            // sql lause, päring ja if lause
            $sql = 'SELECT * FROM simple ORDER BY added DESC LIMIT '.$start.', '.$maxPerPage;
            $res = $database->dbGetArray($sql);
            if($res !== false && !empty($res)){ // Kontrollime, kas päringu tulemused on olemas
            ?>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr class="text-center">
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
                    $count = $start + 1; // Alustame järjekorranumbri lugemist
                    foreach($res as $key=>$val){
                        $date = new DateTime($val['birth']);
                        $birth = $date->format('d.m.Y');
                        $dateTime = new DateTime($val['added']);
                        $added = $dateTime->format('d.m.Y H:i:s');

                    ?>

                    <tr>
                        <td class="text-center"><?php echo $count; ?></td> <!-- Järjekorranumber -->
                        <td><?php echo $val['name']; ?></td>
                        <td class="text-center"><?php echo $birth; ?></td>
                        <td class="text-end"><?php echo $val['salary']; ?></td>
                        <td class="text-end"><?php echo $val['height']; ?></td>
                        <td class="text-end"><?php echo $added; ?></td>
                        <td class="text-center">
                            <a href="index.php?page=hw_update-by-id&ids=<?php echo $val['id']; ?>"><i class="fa-solid fa-pen-to-square text-warning" title="Edit"></i></a>
                            <a href="index.php?page=hw_delete&ids=<?php echo $val['id']; ?>" onclick="if (confirm('Kas oled kindel?')) { return true; } else { return false; }">
                                <i class="fa-solid fa-trash-can text-danger" title="Delete"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                    $count++; // Suurendame järjekorranumbrit iga rea jaoks
                    }
                    ?>

                </tbody>
            </table>
            <?php
            } else {
            ?>

                <div class="alert alert-danger">Sobivaid kirjeid ei leitud</div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
