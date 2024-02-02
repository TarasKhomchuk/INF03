<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Wędkowanie</title>
        <link href="./styl_1.css" rel="stylesheet">
    </head>
    <body>
        <div id="baner">
            <h1>Portal dla wędkarzy</h1>
        </div>
        <div id="prawy">
            <img src="./ryba.jpg" alt="Sum"></img></br>
            <a href="./kwerendy.txt">Pobierz kwerendy</a>
        </div>
        <div id="lewy1">
            <h3>Ryby zamieszkujące rzeki</h3>
            <?php
                try{
                    $con = mysqli_connect('localhost', 'root', '', 'wedkowanie');
                }catch(Exception $e){
                    echo 'Nie morliwe połonczyć się z bazą';
                    // exit;
                }
                if(isset($con)){
                    $wynik = mysqli_query($con, "SELECT nazwa, akwen, wojewodztwo  FROM `ryby` INNER JOIN `lowisko` ON `ryby`.id = `lowisko`.Ryby_id WHERE `lowisko`.rodzaj=3");
                    echo '<ol>';
                    while($row = mysqli_fetch_row($wynik)){
                        echo '<li>'.$row[0].' pływa w rzece '.$row[1].', '.$row[2].'</li>';
                    }
                    echo '</ol>';
                }
            ?>
        </div>
        <div id="lewy2">
            <h3>Ryby drapieżne naszych wód</h3>
            <table>
                <thead><th>L.p.</th><th>Gatunek</th><th>Występowanie</th></thead>
                <tbody>
                <?php
                        if(isset($con)){
                            $wynik = mysqli_query($con, "SELECT id, nazwa, wystepowanie FROM `ryby` WHERE styl_zycia=1;");
                            
                            while($row = mysqli_fetch_row($wynik)){
                                echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td></tr>';
                            }
                        
                            mysqli_close($con);
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="stopka">
            <p>Stronę wykonał: Taras Khomchuk</p>
        </div>
    </body>
</html>