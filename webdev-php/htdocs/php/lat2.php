<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perbandingan PHP</title>
</head>
<body>

<?php
    $a = 2;
    $x = 100;
    $y = "100";
    $z = 100;

    var_dump($x == $y);
    echo "<br>";

    var_dump($x != $y);
    echo "<br>";

    var_dump($x > $a);
    echo "<br>";

    var_dump($z == $x);
?>

</body>
</html>