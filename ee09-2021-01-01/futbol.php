<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Rozgrywki futbolowe</title>
        <link href="styl.css" rel="stylesheet">
    </head>
    <body>
        <section id="baner">
            <h2>Światowe rozgrywki piłkarskie</h2>
            <img src="obraz1.jpg" alt="boisko">
        </section>
        <section id="mecze">
            <?php
                $con = mysqli_connect('localhost', 'root', '', 'egzamin');
                $wynik = mysqli_query($con, "SELECT zespol1, zespol2, wynik, data_rozgrywki FROM rozgrywka WHERE zespol1='EVG';");
                while($arr = mysqli_fetch_array($wynik)){
                    echo '<section class="rozgrywka">';
                    echo "<h3>$arr[0] - $arr[1]</h3>";
                    echo "<h4>$arr[2]</h4>";
                    echo "<p>w dniu: $arr[3]</p>";
                    echo '</section>';
                }
                mysqli_close($con);
            ?>
        </section>
        <section id="glowny">
            <h2>Reprezentacja Polski</h2>
        </section>
        <section id="lewy">
            <p>Podaj pozycję zawodników (1-bramkarze, 2-obrońcy, 3-pomocnicy, 4-napastnicy):</p>
            <form method="post">
                <input type="number" id="pozycja" name="pozycja">
                <input type="submit" value="Sprawdź">
                <ul>
                    <?php
                        if(isset($_POST["pozycja"])){
                            $con = mysqli_connect('localhost', 'root', '', 'egzamin');
                            $wynik = mysqli_query($con, "SELECT imie, nazwisko FROM zawodnik WHERE pozycja_id=".$_POST['pozycja'].";");
                            while($arr = mysqli_fetch_array($wynik)){
                                echo '<li>';
                                echo "<p>$arr[0] - $arr[1]</p>";
                                echo '</li>';
                            }
                            mysqli_close($con);
                        }
                    ?>
                </ul>
            </form>
        </section>
        <section id="prawy">
            <img src="zad1.png" alt="piłkarz">
            <p>Autor: Taras Khomchuk</p>
        </section>
    </body>
</html>