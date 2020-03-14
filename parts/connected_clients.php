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

foreach ($new as $clients)
  echo '<tr><th scope="row">' . ($key + 1) . '</th><td>' . $clients['name'] . '</td><td>' . $clients['real_ip'] . '</td><td>' . $clients['virtual_ip'] . '</td><td>' . round($clients['bytes_received'] / 1024, 2) . '</td><td>' . round($clients['bytes_sent'] / 1024, 2) . '</td><td>' . date($config['connected_since_date_format'], $clients['connected_since']) . '</td><tr>';

?>

</tbody>
</table>
