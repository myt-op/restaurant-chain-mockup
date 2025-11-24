<?php
// -------------------------------------------
// Autoload
// -------------------------------------------
spl_autoload_extensions(".php");
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace("\\", "/", $class) . ".php";
    if (file_exists($file)) include($file);
});

require_once __DIR__ . "/vendor/autoload.php";

use Helpers\RandomGenerator;

// フォームから取得
$format = $_POST['format'] ?? 'html';

// チェーン生成（あなたの自動ランダム版）
$chain = RandomGenerator::chain();

// 出力形式ごとの処理
if ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="restaurant_chain.json"');
    echo json_encode($chain->toArray(), JSON_PRETTY_PRINT);

} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="restaurant_chain.txt"');
    echo $chain->toString();

} elseif ($format === 'md') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="restaurant_chain.md"');
    echo $chain->toMarkdown();

} else {
    // HTML（ダウンロードではなく表示）
    header('Content-Type: text/html; charset=UTF-8');
    echo $chain->toHTML();
}
