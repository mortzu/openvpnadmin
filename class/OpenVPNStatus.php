<?php

class OpenVPNStatus {

  private $content = '';
  private $unixsocket = '';

  function __construct() {
  }

  public function setUnixSocket($unixsocket) {
    $this->unixsocket = $unixsocket;
  }

  private function getStatus() {
    $fp = stream_socket_client('unix://' . $this->unixsocket, $errno, $errstr);

    if (!$fp)
      return false;
    else {
      fwrite($fp, "status\n");
      sleep(1);
      fwrite($fp, "quit\n");
      sleep(1);

      while (!feof($fp)) {
        $this->content .= fgets($fp, 1024);
      }
      fclose($fp);

      return (empty($this->content) ? false : $this->content);
    }
  }

  public function parse() {
    $clients = array();
    $content = '';

    if (false === $content = $this->getStatus())
      return array();

    preg_match('/OpenVPN CLIENT LIST(.*)Common.*Connected Since(.*)ROUTING TABLE.*Virtual.*Last Ref(.*)GLOBAL STATS(.*)END/s', $this->content, $matches);

    if (empty(trim($matches[2])))
      return array();

    $client_lines = preg_split('/\n|\r\n?/', trim($matches[2]));
    $routing_lines = preg_split('/\n|\r\n?/', trim($matches[3]));

    foreach ($client_lines as $client_line) {
      $fields = str_getcsv($client_line);

      if ($fields[0] == 'UNDEF')
        continue;

      preg_match('/(.*):([\d]+)/', $fields[1], $field_matches);

      foreach ($routing_lines as $routing_line) {
        $fields_routing = str_getcsv($routing_line);

        if ($fields_routing[1] == $fields[0])
          $virtual_ip = $fields_routing[0];
      }

      $clients[] = array('name' => $fields[0],
                         'real_ip' => $field_matches[1],
                         'real_port' => $field_matches[2],
                         'bytes_received' => $fields[2],
                         'bytes_sent' => $fields[3],
                         'connected_since' => strtotime($fields[4]),
                         'virtual_ip' => $virtual_ip);
    }

    return $clients;
  }
}
