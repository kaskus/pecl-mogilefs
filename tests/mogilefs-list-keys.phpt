--TEST--
MogileFs::listKeys(string prefix, string after, int limit)
--SKIPIF--
<?php
require_once dirname(__FILE__) . '/test-helper.php';
if (mogilefs_skipped()) print "skip";
--FILE--
<?php
require_once dirname(__FILE__) . '/test-helper.php';
$client = mogilefs_test_factory();

try {
	$client->listKeys();
} catch (\ArgumentCountError $e) {
	var_dump($e->getMessage(), $e->getCode());
}

try {
	$client->listKeys('pref');
} catch (\ArgumentCountError $e) {
	var_dump($e->getMessage(), $e->getCode());
}

try {
	var_dump($client->listKeys('pref', 'after'));
} catch (MogileFsException $e) {
	var_dump($e->getMessage());
}
try {
	var_dump($client->listKeys('pref', 'prefix'));
} catch (MogileFsException $e) {
	var_dump($e->getMessage());
}

var_dump($client->put(__FILE__, 'testList1', MOGILEFS_CLASS));
var_dump($client->put(__FILE__, 'testList2', MOGILEFS_CLASS));
var_dump($client->put(__FILE__, 'testList3', MOGILEFS_CLASS));

$result = $client->listKeys('testList', 'testList', 10);
var_dump($result['key_1']);
var_dump($result['key_2']);
var_dump($result['key_3']);
var_dump($result['key_count']);
var_dump($result['next_after']);

var_dump($client->delete('testList1'));
var_dump($client->delete('testList2'));
var_dump($client->delete('testList3'));
?>
==DONE==
--EXPECTF--
string(%d) "MogileFs::listKeys() expects at least 2 %s, 0 given"
int(0)
string(%d) "MogileFs::listKeys() expects at least 2 %s, 1 given"
int(0)
string(39) "Pattern does not match the after-value?"
string(52) "No keys match that pattern and after-value (if any)."
bool(true)
bool(true)
bool(true)
string(9) "testList1"
string(9) "testList2"
string(9) "testList3"
string(1) "3"
string(9) "testList3"
bool(true)
bool(true)
bool(true)
==DONE==
