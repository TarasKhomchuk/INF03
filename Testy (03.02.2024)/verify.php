<?php
    $testResult = array();

    function veryifyAnswer($value, $key){
        if(is_array($value)){
            foreach($_REQUEST[$key] as $value)
                addAnswer2List($value);
        }else{
            if($value=='on')
                addAnswer2List($key);
            else
                addAnswer2List($value);
        }
    }

    function addAnswer2List($complex){
        $arr = explode('_', $complex);

        if(empty($GLOBALS['testResult'][$arr[0]]))
            $GLOBALS['testResult'][$arr[0]] = array($arr[1]);
        else
            array_push($GLOBALS['testResult'][$arr[0]], $arr[1]);

        // var_dump($GLOBALS['testResult']);
    }

    function makeRequest($conn, $req="") {
        if(isset($conn) and ($req!='')){
            try{
                $wynik = mysqli_execute_query($conn, $req);
            }catch(Exception $e){
                array_push($errors, $e->getMessage());
            }
        }
        return $wynik;
    }

    function showPytanie($con, $id){
        $pytania = makeRequest($con, 'SELECT text FROM `pytania` WHERE id='.$id.';');
        while($pytanie = mysqli_fetch_array($pytania)){
            echo '<h4>Pytanie '.$id.': '.$pytanie[0].'</h4>';
        }
    }

    function showOdpowiedz($con, $id){
        $odpowiedzi = makeRequest($con, 'SELECT text, prawidlowa FROM `odpowiedz` WHERE id='.$id.';');
        echo '<ul>';
        while($pytanie = mysqli_fetch_array($odpowiedzi)){
            if($pytanie[1])
                $style = ' style="color: green;"';
            else
            $style = ' style="color: red;"';

            echo '<li'.$style.'> '.$pytanie[0].'</li>';
        }
        echo '</ul>';
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
        <h2>Byli podane następny odpowiedzi:</h2>
        <?php
            #process results
            array_walk($_REQUEST, "veryifyAnswer");

            $errors=array();
            try{
                $conn = mysqli_connect("localhost","root","","03022024");
            }catch(Exception $e){
                array_push($errors, $e->getMessage());
            }

            $pytKeys = array_keys($GLOBALS['testResult']);
            foreach($pytKeys as $key){
                // echo 'Pytanie: '.$key.'<br>';
                showPytanie($conn, $key);

                foreach($GLOBALS['testResult'][$key] as $odpKey)
                    // echo '<tab>'.$odpKey.'<br>';
                    showOdpowiedz($conn, $odpKey);
            }

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
    </body>
</html>