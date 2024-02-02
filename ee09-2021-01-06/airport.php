<?php
    if(!isset($_COOKIE['expire'])){
        $wellcome = '<i>Dzień dobry! Sprawdź regulamin naszej strony</i>';
        setcookie('expire', time()+60*60, time()+60*60);
    }else{
        $wellcome = '<b>Miło nam, że nas znowu odwiedziłeś</b>';
    }
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Odloty samolotów </title>
        <link href="./styl6.css" rel="stylesheet">
    </head>

    <body>
        <div id="baner1">
            <h2>Odloty z lotniska</h2>
        </div>
        <div id="baner2">
            <img src="./zad6.png" alt="logotyp"/>
        </div>
        <div id="glowny">
            <h4>tabela odlotów</h4>
            <table>
                <thead>
                    <tr>
                        <th>lp.</th>
                        <th>numer rejsu</th>
                        <th>czas</th>
                        <th>kierunek</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        try{
                            $con = mysqli_connect('localhost', 'root', '', 'egzamin');
                        }catch(Exception $ex){

                        }

                        if(isset($con)){
                            $wynik = mysqli_query($con, 'SELECT id, nr_rejsu, czas, kierunek, status_lotu FROM odloty ORDER BY czas DESC;');

                            while($row = mysqli_fetch_row($wynik)){
                                echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td></tr>';
                            }
                            mysqli_close($con);
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="stopka1">
            <a href="./kw1.jpg" target="_blank">Pobierz obraz</a>
        </div>
        <div id="stopka2">
            <?php
                echo '<p>'.$wellcome.'</p>';
            ?>
        </div>
        <div id="stopka3">
            <span>Autor: Taras Khomchuk</span>
        </div>

    </body>
</html>
