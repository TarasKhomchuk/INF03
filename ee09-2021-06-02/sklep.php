<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Warzywniak</title>
        <link href="./styl2.css" rel="stylesheet">
        <?php
            try{
                $con = mysqli_connect('localhost', 'root', '', 'dane2');

            }catch(Exception $ex) {}

            if(isset($con) && isset($_POST["nazwa"]) && isset($_POST["cena"])){
                $wynik = mysqli_query($con, "INSERT INTO `produkty` (nazwa, ilosc, opis, cena, zdjecie, Producenci_id, Rodzaje_id) VALUES ('".$_POST["nazwa"]."', 10, '', ".floatval($_POST["cena"]).", 'owoce.jpg', (SELECT id FROM `producenci` WHERE nazwa='warzywa-rolnik'), (SELECT id FROM `rodzaje` WHERE nazwa='owoce'));");
            }

            function showProduct($nazwa, $ilosc, $opis, $cena, $zdjecie){
                echo '<div class="produkt">';
                echo '<img src="'.$zdjecie.'" alt="warzywniak"/>';
                echo '<h5>'.$nazwa.'</h5>';
                echo '<p>opis: '.$opis.'</p>';
                echo '<p>na stanie: '.$ilosc.'</p>';
                echo '<h2>'.$cena.' zł</h2>';
                echo '</div>';
            }
        ?>
    </head>
    <body>
        <div id="baner1">
            <h1>Internetowy sklep z eko-warzywami</h1>
        </div>
        <div id="baner2">
            <ol>
                <li>warzywa</li>
                <li>owoce</li>
                <li><a href="https://terapiasokami.pl/" target="_blank">soki</a></li>
            </ol>
        </div>
        <div id="glowny">
            <?php
                if(isset($con)){
                    $wynik = mysqli_query($con, 'SELECT nazwa, ilosc, opis, cena, zdjecie FROM `produkty` WHERE Rodzaje_id in (1, 2);');
                    while($row = mysqli_fetch_row($wynik)){
                        showProduct($row[0], $row[1], $row[2], $row[3], $row[4]);
                    }

                    mysqli_close($con);
                }
            ?>
        </div>
        <div id="stopka">
            <form method="post" action="sklep.php">
                <label for="nazwa">Nazwa:</label>
                <input id="nazwa" name="nazwa" type="text" >
                <label for="cena">Cena:</label>
                <input id="cena" name="cena" type="text" >
                <input type="submit" value="Dodaj produkt">
            </form>
            <p>Stronę wykonał: Taras Khomchuk</p>
        </div>
    </body>
</html>