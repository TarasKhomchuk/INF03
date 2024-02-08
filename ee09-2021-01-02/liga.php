<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>piłka nożna</title>
        <link href="styl2.css" rel="stylesheet">
        <?php
        try{
            $con = mysqli_connect('localhost', 'root', '', 'egzamin');
        }catch(Exception $ex){}
        ?>
    </head>
    <body>
        <section id="baner">
            <h3>Reprezentacja polski w piłce nożnej</h3>
            <img src="obraz1.jpg" alt="reprezentacja">
        </section>
        <section id="lewy">
            <form method="get">
                <select id="rozwijalna" name="rozwijalna">
                    <option value="1">Bramkarze</option>
                    <option value="2">Obrońcy</option>
                    <option value="3">Pomocnicy</option>
                    <option value="4">Napastnicy</option>
                </select>
                <input type="submit" value="Zobacz"><br>
                <img src="zad2.png" alt="piłka">
                <p>Autor: Taras Khomchuk</p>
            </form>
        </section>
        <section id="prawy">
            <ol>
                <?php
                    if(isset($con) && isset($_REQUEST["rozwijalna"])){
                        $wynik = mysqli_query($con, 'SELECT imie, nazwisko FROM zawodnik WHERE pozycja_id='.$_REQUEST["rozwijalna"]);
                        while($row = mysqli_fetch_row($wynik)){
                            echo '<li>'.$row[0].' '.$row[1].'</li>';
                        }
                    }
                ?>
            </ol>
        </section>
        <section id="główny">
            <h3>Liga mistrzów</h3>
        </section>
        <section id="liga">
            <?php
                if(isset($con) && isset($_REQUEST["rozwijalna"])){
                    $wynik = mysqli_query($con, 'SELECT zespol, punkty, grupa FROM liga ORDER BY liga.punkty DESC;');
                    while($row = mysqli_fetch_row($wynik)){
                        echo '<section class="druzyna">';
                        echo '<h2>'.$row[0].'</h2>';
                        echo '<h1>'.$row[1].'</h1>';
                        echo '<p>grupa: '.$row[2].'</p>';
                        echo '</section>';
                    }
                }
            ?>            
        </section>
    </body>
    <?php
    if(isset($con))
        mysqli_close($con);
    ?>
</html>