<?php
date_default_timezone_set("Europe/Bratislava");

$registerTime = date("H:i:s");
$registerDate = date("d.m.Y H:i:s");
$delay = isDelay($registerTime);

function isDelay($time) {
    $hour = intval( substr($time, 0, 2));
    
    if ($hour >= 20) {
        die('nemozno');
    } else if ($hour >= 8) {
        return true;
    } else {
        return false;
    }
}

function registerArrival($time, $delay) {
    $file = fopen("arrivals.txt", "a");
    
    
    if ($delay) {
        $text = "\n" . $time . ", meskanie";
    }
    
    else {
        $text = "\n" . $time;
    }
    
    fwrite($file, $text);
    fclose($file);
}

function outputArrivals() {
    $file = fopen("arrivals.txt", "r");
    $text = explode(';', fread( $file, filesize('arrivals.txt')));

    for ($i=0; $i < count($text); $i++) { 
        echo "<li> $text[$i] </li>";
    }

    fclose($file);
}

registerArrival($registerDate, $delay);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prichody</title>
</head>

<body>
    <main>
        <h1>Prichody</h1>

        <?php
            echo "<h2> Tvoj cas prichodu $registerTime </h2>";
        ?>

        <ul>
            <?php outputArrivals(); ?>
        </ul>
    </main>
</body>
</html>