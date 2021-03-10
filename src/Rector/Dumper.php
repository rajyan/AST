<?php

require_once __DIR__ .  '/../../vendor/autoload.php';

use PhpParser\NodeDumper;
use PhpParser\ParserFactory;

$filename = $argv[1] ?? null;
if (!isset($filename)) {
    print "Needs filename!" . PHP_EOL;
    exit(1);
}

if (!file_exists($filename)) {
    print "No such file!" . PHP_EOL;
    exit(1);
}

$code = file_get_contents($filename);
$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
$ast = $parser->parse($code);
print (new NodeDumper())->dump($ast) . PHP_EOL;
