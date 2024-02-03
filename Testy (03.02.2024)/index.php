<?php
    $errors=array();
    try{
        $conn = mysqli_connect("localhost","root","","03022024");
    }catch(Exception $e){
        array_push($errors, $e->getMessage());
    }

    function makeRequest($conn, $req="") {
        if(isset($conn)){
            try{
                $wynik = mysqli_execute_query($conn, $req);
            }catch(Exception $e){
                array_push($errors, $e->getMessage());
            }
        }
        return $wynik;
    }
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Test</title>
        <link href="./style.css" rel="stylesheet">
    </head>
    <body>
        <form method="post" action="./verify.php">
            <?php
                if(isset($conn)){

                    $pytania = makeRequest($conn, "SELECT id, text FROM `pytania`;");

                    while($pytanie = mysqli_fetch_array($pytania)){
                        $odpowiedzi = makeRequest($conn, "SELECT id, text FROM `odpowiedz` WHERE pytanie_id=".$pytanie[0].";");

                        echo '<fieldset class="test">';
                        echo '<legend>Pytanie '.$pytanie[0].'</legend>';
                        echo '<h5>'.$pytanie[1].'</h5>';

                        // while($odpowiedz = mysqli_fetch_array($odpowiedzi)){
                        //     $ctrlId = $pytanie[0].'_'.$odpowiedz[0];
                        //     echo '<input type="checkbox" id="'.$ctrlId.'" name="'.$ctrlId.'"> <label for="'.$ctrlId.'">'.$odpowiedz[1].'</label><br>';
                        // }

                        // while($odpowiedz = mysqli_fetch_array($odpowiedzi)){
                        //     $ctrlId = $pytanie[0].'_'.$odpowiedz[0];
                        //     echo '<input type="radio" id="'.$ctrlId.'" name="'.$ctrlId.'"/> <label for="'.$ctrlId.'">'.$odpowiedz[1].'</label><br>';
                        // }     

                        // echo '<select id="'.$pytanie[0].'" name="'.$pytanie[0].'">';
                        // while($odpowiedz = mysqli_fetch_array($odpowiedzi)){
                        //     $ctrlId = $pytanie[0].'_'.$odpowiedz[0];
                        //     echo '<option id="'.$ctrlId.'" name="'.$ctrlId.'" value="'.$ctrlId.'">'.$odpowiedz[1].'</option>';
                        // }
                        // echo '</select>';

                        echo '<select id="'.$pytanie[0].'" name="'.$pytanie[0].'[]" multiple="true">';
                        while($odpowiedz = mysqli_fetch_array($odpowiedzi)){
                            $ctrlId = $pytanie[0].'_'.$odpowiedz[0];
                            echo '<option id="'.$ctrlId.'" value="'.$ctrlId.'">'.$odpowiedz[1].'</option>';
                        }
                        echo '</select>';

                        echo '</fieldset>';                        
                    }
                }

            ?>
            <input type="submit" value="Sprawdż">
        </form>
    </body>
    <?php
        if(count($errors)> 0){
            echo '<script lang="javascript">';
            foreach($errors as $error){
                echo 'console.error("'.$error.'")';
            }
            echo '</script>';
        }

        if(isset($conn)){
            mysqli_close($conn);
        }
    ?>    
</html>

