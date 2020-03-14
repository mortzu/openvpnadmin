<?php

$config = array();
$config['auth']['realm'] = '';
$config['auth']['file'] = $script_directory . '/auth/passwdfile';
$config['connected_since_date_format'] = 'd.m.Y H:i:s';
$config['nav']['status'] = array('target' => '/', 'name' => 'Status');
$config['nav']['clients'] = array('target' => '/?page=clients', 'name' => 'Clients');
$config['status']['socket'] = '/var/lib/openvpn/server.socket';
$config['superuser']['auth'] = '';

?>
