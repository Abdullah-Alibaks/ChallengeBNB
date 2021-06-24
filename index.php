<?php
// Je hebt een database nodig om dit bestand te gebruiken....

//if (!isset($db_conn)) { //deze if-statement checked of er een database-object aanwezig is. Kun je laten staan.
    ///return;
//}
require "database.php";


$database_gegevens = null;
$poolIsChecked = false;
$bathIsChecked = false;
$fireplaceIsChecked = false;
$bikerentalIsChecked = false;

$sql = "SELECT * FROM `homes`"; //Selecteer alle huisjes uit de database

if (isset($_GET['filter_submit'])) {

    if ($_GET['faciliteiten'] == "ligbad") { // Als ligbad is geselecteerd filter dan de zoekresultaten
        $bathIsChecked = true;

        $sql = "SELECT * FROM `homes` WHERE id=3 OR id=4"; // query die zoekt of er een BAD aanwezig is.
    }

    if ($_GET['faciliteiten'] == "zwembad") {
        $poolIsChecked = true;

        $sql = "SELECT * FROM `homes` WHERE id=2 OR id=3"; // query die zoekt of er een ZWEMBAD aanwezig is.
    }
    if ($_GET['faciliteiten'] == "openhaard") {
        $fireplaceIsChecked = true;

        $sql = "SELECT * FROM `homes` WHERE id=4"; // query die zoekt of er een openhaard aanwezig is.
    }
    if ($_GET['faciliteiten'] == "fietsverhuur") {
        $bikerentalIsChecked = true;

        $sql = "SELECT * FROM `homes` WHERE id=3"; // query die zoekt of je er fietsen kan huren.
    }
    
}


if (is_object($db_conn->query($sql))) { //deze if-statement controleert of een sql-query correct geschreven is en dus data ophaalt uit de DB
    $database_gegevens = $db_conn->query($sql)->fetchAll(PDO::FETCH_ASSOC); //deze code laten staan
}

$prijspp = array(
    "IJmuiden Cottage" => "55",
    "Assen Bungalow" => "150",
    "Espelo Entree" => "300",
    "Weustenrade Woning" => "75");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNB</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <style>
        <?php include "css/index.css"; ?>  
    </style>
      
</head>

<body>
<header>
    <h1>Quattro Cottage Rental</h1>
        

</header>
<main>
<div class="left">
    <div id="mapid"></div>
        <form class="book" action="index.php" method="post">
            
            <div id="keuzes">
                <h3>Reservering maken</h3>
                <div class="form-control">
                    <label for="gekozen_huis">Vakantiehuis</label>
                    <select name="gekozen_huis" id="gekozen_huis">
                        <option value="IJmuiden Cottage">IJmuiden Cottage</option>
                        <option value="Assen Bungalow">Assen Bungalow</option>
                        <option value="Espelo Entree">Espelo Entree</option>
                        <option value="Weustenrade Woning">Weustenrade Woning</option>
                    </select>
                </div>
                <div class="form-control">
                    <label for="aantal_personen">Aantal personen</label>
                    <input type="number" name="aantal_personen" id="aantal_personen">
                </div>
                <div class="form-control">
                    <label for="aantal_dagen">Aantal dagen</label>
                    <input type="number" name="aantal_dagen" id="aantal_dagen">
                </div>
                <div class="form-control">
                    <h5>Beddengoed</h5>
                    <label for="beddengoed_ja">Ja</label>
                    <input type="radio" id="beddengoed_ja" name="beddengoed" value="ja">
                    <label for="beddengoed_nee">Nee</label>
                    <input type="radio" id="beddengoed_nee" name="beddengoed" value="nee">
                </div>
                <button>Reserveer huis</button>
            </div>
            <?php if(isset($_POST["gekozen_huis"])){?>
            <div class="currentBooking">
                <div class="bookedHome">
                    <h4><?php echo "Jouw reservering: "?></h4>
                    <h4><?php echo $_POST["gekozen_huis"]?></h4>
                    <p><?php echo "Aantal personen = ".$_POST["aantal_personen"]."x €".$prijspp[$_POST["gekozen_huis"]];?></p>
                    <p><?php echo "Aantal dagen = ".$_POST["aantal_dagen"]."x €".$_POST["aantal_personen"] * $prijspp[$_POST["gekozen_huis"]]; ?></p>
                    
                    
            </div>
            <?php } ?>
            <?php if(isset($_POST["aantal_personen"], $_POST["aantal_dagen"])){ ?>
            <div class="totalPriceBlock">Totale prijs &euro;<span class="totalPrice"><?php echo $_POST["aantal_dagen"] * $_POST["aantal_personen"] * $prijspp[$_POST["gekozen_huis"]]; ?></span></div>
              <?php } ?>  
        </div>
    </form>
        
    
</div>
        <div class="right">
            <div class="filter-box">
                <form class="filter-form">
                    <div class="form-control">
                        <a href="index.php">Reset Filters</a>
                    </div>
                    <div class="form-control">
                        <label for="ligbad">Ligbad</label>
                        <input type="checkbox" id="ligbad" name="faciliteiten" value="ligbad" <?php if ($bathIsChecked) echo 'checked' ?>>
                    </div>
                    <div class="form-control">
                        <label for="zwembad">Zwembad</label>
                        <input type="checkbox" id="zwembad" name="faciliteiten" value="zwembad" <?php if ($poolIsChecked) echo 'checked' ?>>
                    </div>
                    <div class="form-control">
                        <label for="openhaard">Open haard</label>
                        <input type="checkbox" id="openhaard" name="faciliteiten" value="openhaard" <?php if ($fireplaceIsChecked) echo 'checked' ?>>
                    </div>
                    <div class="form-control">
                        <label for="fietsverhuur">Fietsverhuur</label>
                        <input type="checkbox" id="fietsverhuur" name="faciliteiten" value="fietsverhuur" <?php if ($bikerentalIsChecked) echo 'checked' ?>>
                    </div>
                    <button type="submit" name="filter_submit">Filter</button>
                </form>
                <div class="homes-box">
                    <?php if (isset($database_gegevens) && $database_gegevens != null) : ?>
                        <?php foreach ($database_gegevens as $huisje) : ?>
                            <h2>
                                <?php echo $huisje['name']; ?>
                            </h2>

                            <p>
                                <?php echo $huisje['description'] ?>
                            </p>
                            <?php echo "<img src='images/{$huisje['image']}'/>" ?>
                            <div class="kenmerken">
                                <h4>Kenmerken</h4>
                                <ul>

                                    <?php
                                    if ($huisje['bath_present'] ==  1) {
                                        echo "<li>Er is een ligbad!</li>";
                                    }
                                    ?>
                                    <?php
                                    if ($huisje['pool_present'] ==  1) {
                                        echo "<li>Er is een zwembad!</li>";
                                    }
                                    ?>
                                     <?php
                                    if ($huisje['fireplace_present'] ==  1) {
                                        echo "<li>Er is een openhaard!</li>";
                                    }
                                    ?>
                                    <?php
                                    if ($huisje['bbq_present'] ==  1) {
                                        echo "<li>Er is een BBQ!</li>";
                                    }
                                    ?>
                                    <?php
                                    if ($huisje['bike_rental'] ==  1) {
                                        echo "<li>Je kunt hier een fiets huren!</li>";
                                    }
                                    ?>
                                    

                                </ul>

                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </main>
    <footer>
        <div></div>
        <div>copyright Quattro Rentals BV.</div>
        <div></div>

    </footer>
    <script src="js/map_init.js"></script>
    <script>
        // De verschillende markers moeten geplaatst worden. Vul de longitudes en latitudes uit de database hierin
        var coordinates = [
            [52.44902, 4.61001],
            [52.99864, 6.64928],
            [52.30340 ,6.36800],
            [50.89720, 5.90979]
        ];

        var bubbleTexts = [
            
        ];
    </script>
    <script src="js/place_markers.js"></script>
</body>

</html>