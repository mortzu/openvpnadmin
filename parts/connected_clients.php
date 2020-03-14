<h3>Connected clients</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Common name</th>
      <th scope="col">Real address</th>
      <th scope="col">Virtual address</th>
      <th scope="col">KB received</th>
      <th scope="col">KB send</th>
      <th scope="col">Connected since</th>
    </tr>
  </thead>
  <tbody>

<?php

$OpenVPNStatus = new OpenVPNStatus();
$OpenVPNStatus->setUnixSocket($config['status']['socket']);
$new = $OpenVPNStatus->parse();

$i = 0;
foreach ($new as $clients) {
  $i++;
  $connected_since = date($config['connected_since_date_format'], $clients['connected_since']);
  echo "<tr><th scope=\"row\">{$i}</th><td>{$clients['name']}</td><td>{$clients['real_ip']}</td><td>{$clients['virtual_ip']}</td><td>{$clients['bytes_received']}</td><td>{$clients['bytes_sent']}</td><td>{$connected_since}</td><tr>";
}

?>

</tbody>
</table>
