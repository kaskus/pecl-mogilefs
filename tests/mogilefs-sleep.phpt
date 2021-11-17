--TEST--
MogileFs::sleep(int time)
--SKIPIF--
<?php
require_once dirname(__FILE__) . '/test-helper.php';
if (mogilefs_skipped()) print "skip";
--FILE--
<?php
require_once dirname(__FILE__) . '/test-helper.php';

$client = mogilefs_test_factory();
$start = microtime(true);
var_dump($client->sleep(1));
$end = (microtime(true) - $start);
var_dump($end >= 1);

try {
    $client->sleep("wrong");
} catch (\TypeError $e) {
    var_dump($e->getMessage(), $e->getCode());
}

?>
==DONE==
--EXPECTF--
bool(true)
bool(true)
string(%d) "MogileFs::sleep(): Argument #1 ($duration) must be of type int, string given"
int(0)
==DONE==
