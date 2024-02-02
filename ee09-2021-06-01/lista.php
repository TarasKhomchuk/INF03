<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Lista przyjaciół</title>
        <link href="styl.css" rel="stylesheet">
        <?php
            try{
                $con = mysqli_connect('localhost', 'root', '', 'dane');
            }catch(Exception $ex){
            }

            function showOsobe($imie, $nazwisko, $opis, $zdjecie){
                echo '<div class="osoba">';
                echo '<div class="zdjecie"><img src="'.$zdjecie.'" alt="przyjaciel"></img></div>';
                echo '<div class="opis">';
                echo '<h3>'.$imie.' '.$nazwisko.'</h3>';
                echo '<p>Ostatni wpis: '.$opis.'</p>';
                echo '</div>';
                echo '<div class="linia"></div>';
                echo '</div>';
            }
        ?>
    </head>
    <body>
        <div id="baner">
            <h1>Portal Społecznościowy - moje konto</h1>
        </div>
        <div id="glowny">
            <h2>Moje zainteresowania</h2>
            <ul>
                <li>muzyka</li>
                <li>film</li>
                <li>komputery</li>
            </ul>
            <h2>Moi znajomi</h2>
            <?php
                if(isset($con)){
                    $wynik = mysqli_query($con, 'SELECT imie, nazwisko, opis, zdjecie FROM `osoby` WHERE Hobby_id in (1, 2, 6);');

                    while($row = mysqli_fetch_row($wynik)){
                        showOsobe($row[0], $row[1], $row[2], $row[3]);
                    }
                    mysqli_close($con);
                }
            ?>
            <!-- <div class="osoba">
                <div class="zdjecie"><img src="./osoba1.jpg"></img></div>
                <div class="opis">opis</div>
                <div class="linia"></div>
            </div> -->
        </div>
        <div class="stopka">
            <text>Stronę wykonał: Taras Khomchuk</text>
        </div>
        <div class="stopka">
            <a href="mailto:ja@portal.pl">napisz do mnie</a>
        </div>
    </body>
</html>