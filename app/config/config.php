<?php

$config['default'] = 'pizza';
$config['lang'] = 'fr';
if (strstr($_SERVER['HTTP_HOST'], 'jabouzi.com'))
{
	$config['database'] = 'jabouzic_pizza_app';
	$config['username'] = 'jabouzic_db';
	$config['password'] = '7024043';
	$config['host'] = 'localhost';
}
else
{
	$config['database'] = 'pizza';
	$config['username'] = 'root';
	$config['password'] = '7024043';
	$config['host'] = 'localhost';
}
$config['driver'] = 'mysql';
$config['site_languages'] = array('fr', 'en');
$config['autoload_helpers'] = array('functions');
$config['autoload_languages'] = array('application');
