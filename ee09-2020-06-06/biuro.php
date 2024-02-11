<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Wycieczki krajoznawcze</title>
        <link href="styl4.css" rel="stylesheet">
    </head>
    <body>
        <section id="baner">
            <h1>WITAMY W BIURZE PODRÓŻY</h1>
        </section>
        <section id="dane">
            <h3>ARCHIWUM WYCIECZEK</h3>
                <?php
                    $con = mysqli_connect('localhost', 'root', '', 'egzamin4');
                    if(isset($con)){
                        $wynik = mysqli_query($con, 'SELECT id, cel, cena FROM wycieczki WHERE dostepna=false;');
                        while($arr = mysqli_fetch_array($wynik))
                            echo "$arr[0]. $arr[1], cena: $arr[2]<br>";
                    }
                ?>
        </section>
        <section id="lewy">
            <h3>NAJTANIEJ...</h3>
            <table>
                <tr><td>Włochy</td><td>od 1200 zł</td></tr>
                <tr><td>Francja</td><td>od 1200 zł</td></tr>
                <tr><td>Hiszpania</td><td>od 1400 zł</td></tr>
            </table>
        </section>
        <section id="srodkowy">
            <h3>TU BYLIŚMY</h3>
                <?php
                    if(isset($con)){
                        $wynik = mysqli_query($con, 'SELECT nazwaPliku, podpis FROM zdjecia ORDER BY podpis DESC;');
                        while($row = mysqli_fetch_row($wynik)){
                            echo '<img src="'.$row[0].'" alt="'.$row[1].'">';
                        }

                        mysqli_close($con);
                    }
                ?>
        </section>
        <section id="prawy">
            <h3>SKONTAKTUJ SIĘ</h3>
            <a href="mailto:wycieczki@wycieczki.pl">napisz do nas</a>
            <p>telefon: 555666777</p>
        </section>
        <section id="stopka">
            <p>Stronę wykonał: Taras Khomchuk</p>
        </section>
    </body>
</html>