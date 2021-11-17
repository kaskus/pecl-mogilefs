--TEST--
MogileFs::close()
--SKIPIF--
<?php
require_once dirname(__FILE__) . '/test-helper.php';
if (mogilefs_skipped()) print "skip";
--FILE--
<?php
require_once dirname(__FILE__) . '/test-helper.php';

$client = mogilefs_test_factory();
var_dump($client->close());
var_dump($client->close());

try {
	$client->close("param");
} catch (\ArgumentCountError $e) {
	var_dump($e->getMessage(), $e->getCode());
}

$client = mogilefs_test_factory();
var_dump($client->disconnect());
var_dump($client->disconnect());
?>
==DONE==
--EXPECTF--
bool(true)
bool(false)
string(%d) "MogileFs::close() expects exactly 0 %s, 1 given"
int(0)
bool(true)
bool(false)
==DONE==
