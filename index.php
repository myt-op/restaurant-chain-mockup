<?php
spl_autoload_extensions(".php");
spl_autoload_register(function($class){
    $file = __DIR__ . "/" . str_replace("\\", "/", $class). ".php";
    if(file_exists($file)) include($file);
});

require_once __DIR__ . "/vendor/autoload.php";

use Helpers\RandomGenerator;

$chain = RandomGenerator::chain();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Chain Mockup</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <h1 class="title">Restaurant Chain Overview</h1>

    <section class="chain-container">
        <?= $chain->toHTML(); ?>
    </section>

</body>
</html>
