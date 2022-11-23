<?php
ini_set("display_errors",1);
function debug(mixed $something): void{
    echo "<pre>";
    print_r($something);
    echo "</pre>";
}
function console(string $something,string $style = "''"): void {
    $log = file_get_contents('log.js');
    file_put_contents('log.js', $log."console.log('".$something."',".$style.");\n");
}
file_put_contents('log.js', "console.log('new Game');\n");
include_once "controller.php";

$game = new Controller(['Aardige jongeman', 'Onaardige jongeman', 'hardwerkende jongeman', 'luie jongeman']);

?>
<html>
<head>
    <title>Catan</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="catan.css">
    <meta name="author" content="NJM.Janssen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?=$game?>

<script src="log.js"></script>
</body>
</html>
