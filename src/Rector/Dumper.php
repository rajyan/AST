<?php


namespace ASTDemo\Rector;

require_once "../../vendor/autoload.php";

use PhpParser\NodeDumper;
use PhpParser\ParserFactory;

$filename = $argv[1] ?? null;
if (!isset($filename)) {
    print "Needs Filename!" . PHP_EOL;
    exit(0);
}

$code = file_get_contents($filename);
$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
$ast = $parser->parse($code);
print (new NodeDumper())->dump($ast) . PHP_EOL;