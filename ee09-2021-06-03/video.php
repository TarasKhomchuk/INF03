<?php
// script 3
    try{
        $con = mysqli_connect('localhost', 'root', '', 'dane3');
    }catch(Exception $ex){}

    if(isset($_POST["film_id"]) && isset($con)){
        try{
            $wynik = mysqli_query($con, 'DELETE FROM `produkty` WHERE id = '.$_POST["film_id"].';');
        }catch(Exception $ex){}
    }

    function showFilm($id, $name, $img, $descr){
        echo '<div class="film">';
        echo '<h4>'.$id.'. '.$name.'</h4>';
        echo '<img src="./'.$img.'" alt="film">';
        echo '<p>'.$descr.'</p>';
        echo '</div>';
    }
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Video On Demand</title>
        <link href="./styl3.css" rel="stylesheet">
    </head>
    <body>
        <div id="baner1">
            <h1>Internetowa wypożyczalnia filmów</h1>
        </div>
        <div id="baner2">
            <table>
                <tr><td>Kryminał</td><td>Horror</td><td>Przygodowy</td></tr>
                <tr><td>20</td><td>30</td><td>20</td></tr>
            </table>
        </div>
        <div id="polecamy" class="list">
            <h3>Polecamy</h3>
            <?php
            // script 1
                if(isset($con)){
                    $wynik = mysqli_query($con, 'SELECT id, nazwa, opis, zdjecie FROM `produkty` WHERE id in (8, 22, 23, 25);');

                    while($row = mysqli_fetch_row($wynik))
                        showFilm($row[0], $row[1], $row[3], $row[2]);
                }
            ?>
        </div>
        <div id="filmy_fantastyczne" class="list">
            <h3>Filmy fantastyczne</h3>
            <?php
                // script 2
                if(isset($con)){
                    $wynik = mysqli_query($con, 'SELECT id, nazwa, opis, zdjecie FROM `produkty` WHERE Rodzaje_id = 12;');

                    while($row = mysqli_fetch_row($wynik))
                        showFilm($row[0], $row[1], $row[3], $row[2]);

                    mysqli_close($con);
                }
            ?>
        </div>
        <div id="stopka">
        <form method="POST" sction="/video.php">
                <label for="film_id">Usuń film nr.: </label>
                <input type="number" id="film_id" name="film_id">
                <input type="submit" value="Usuń film">
            </form>
            <p>Stronę wykonał: <a href="mailto:ja@poczta.com">Taras Khomchuk</a></p>
        </div>
    </body>
</html>