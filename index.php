<?php
// -------------------------------------------
// Autoload（あなたのプロジェクト構成）
// -------------------------------------------
spl_autoload_extensions(".php");
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace("\\", "/", $class) . ".php";
    if (file_exists($file)) include($file);
});

require_once __DIR__ . "/vendor/autoload.php";

use Helpers\RandomGenerator;

$previewChain = RandomGenerator::chain();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Chain Generator</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <h1>Restaurant Chain Generator</h1>

    <!-- ダウンロードフォーム -->
    <section>
        <form action="download.php" method="post">
            <label>
                出力形式:
                <select name="format">
                    <option value="html">HTML</option>
                    <option value="json">JSON</option>
                    <option value="txt">Text</option>
                    <option value="md">Markdown</option>
                </select>
            </label>

            <button type="submit">ダウンロード</button>
        </form>
    </section>

    <hr>

    <!-- プレビュー表示 -->
    <section>
        <h2>Preview (Random)</h2>
        <?= $previewChain->toHTML(); ?>
    </section>

</body>

</html>
