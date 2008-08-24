--TEST--
Mogilefs::createClass(string domain, string class, int device_count) / MogileFs::updateClass(string domain, string class, int device_count) / MogileFs::deleteClass(string domain, string class)
--SKIPIF--
<?php
require_once dirname(__FILE__) . '/test-helper.php';
if (mogilefs_skipped()) {
	print "skip";
} else {
	$client = mogilefs_test_factory();
	try {
		$client->deleteClass(MOGILEFS_DOMAIN, 'crud-test-class');
	} catch (MogileFsException $e) {}
}
--FILE--
<?php
require_once dirname(__FILE__) . '/test-helper.php';
$client = mogilefs_test_factory();

// Params
$client->createClass();


$classname = 'crud-test-class';
$data = $client->createClass(MOGILEFS_DOMAIN, $classname, MOGILEFS_DEVICE_COUNT);
var_dump($data['domain'] === MOGILEFS_DOMAIN);
var_dump($data['class'] === $classname);
var_dump($data['mindevcount'] == MOGILEFS_DEVICE_COUNT);
var_dump(count($data));

try {
	$client->createClass(MOGILEFS_DOMAIN, $classname, MOGILEFS_DEVICE_COUNT);
} catch (MogileFsException $e) {
	var_dump($e->getMessage());
}

sleep(5);
$data = $client->updateClass(MOGILEFS_DOMAIN, $classname, MOGILEFS_DEVICE_COUNT - 1);
var_dump($data['domain'] === MOGILEFS_DOMAIN);
var_dump($data['class'] === $classname);
var_dump($data['mindevcount'] == MOGILEFS_DEVICE_COUNT - 1);
var_dump(count($data));

$data = $client->deleteClass(MOGILEFS_DOMAIN, $classname);
var_dump($data['domain'] === MOGILEFS_DOMAIN);
var_dump($data['class'] === $classname);
var_dump(count($data));
?>
==DONE==
--EXPECTF--

Warning: MogileFs::createClass() expects exactly 3 parameters, 0 given in %s on line %d
bool(true)
bool(true)
bool(true)
int(3)
string(%d) "That class already exists in that domain"
bool(true)
bool(true)
bool(true)
int(3)
bool(true)
bool(true)
int(2)
==DONE==
