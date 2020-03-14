<?php

class OpenVPNAuth {
  private $auth_filename = '';
  private $auth_users = array();
  private $auth_realm = '';

  function __construct() {
  }

  public function setAuthFile($filename) {
    $this->auth_filename = $filename;
  }

  public function setRealm($realm) {
    $this->auth_realm = $realm;
  }

  public function getUsers() {
    $content = file($this->auth_filename);
    $this->auth_users = array();

    foreach ($content as $line)
      $this->auth_users[] = stristr($line, ':', true);

    return $this->auth_users;
  }

  public function addUser($username) {
    $this->getUsers();

    $generated_password = substr(md5(mt_rand()), 0, 16);

    if (!in_array($username, $this->auth_users)) {
      return (false !== file_put_contents($this->auth_filename, $username . ':' . $this->auth_realm . ':' . md5($username . ':' . $this->auth_realm . ':' . $generated_password) . "\n", FILE_APPEND) ? true : false);
    }
  }

  public function delUser($username) {
  }
}
