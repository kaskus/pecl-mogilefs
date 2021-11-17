--TEST--
MogileFs::isConnected()
--SKIPIF--
<?php
require_once dirname(__FILE__) . '/test-helper.php';
if (mogilefs_skipped()) print "skip";
--FILE--
<?php
require_once dirname(__FILE__) . '/test-helper.php';
$client = new MogileFs();
var_dump($client->isConnected());
$client = mogilefs_test_factory();
var_dump($client->isConnected());
$client->close();
var_dump($client->isConnected());

try {
    $client->isConnected('invalid param');
} catch (\ArgumentCountError $e) {
    var_dump($e->getMessage(), $e->getCode());
}

?>
==DONE==
--EXPECTF--
bool(false)
bool(true)
bool(false)
string(%d) "MogileFs::isConnected() expects exactly 0 %s, 1 given"
int(0)
==DONE==
