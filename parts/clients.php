<?php

$OpenVPNAuth = new OpenVPNAuth();
$OpenVPNAuth->setAuthFile($config['auth']['file']);
$OpenVPNAuth->setRealm($config['auth']['realm']);

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
  $OpenVPNAuth->delUser($_GET['delete']);
} elseif (!empty($_POST['submit']) && !empty($_POST['name'])) {
  $OpenVPNAuth->addUser($_POST['name']);
}

?>
<div class="jumbotron">
<h3>Clients</h3>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Common name</th>
    </tr>
  </thead>
  <tbody>
<?php

foreach ($OpenVPNAuth->getUsers() as $key => $user)
  echo '<tr><th scope="row">' . ($key + 1) . '</th><td>' . $user . '</td></tr>';

?>
</tbody>
</table>
</div>

<div class="jumbotron">
<h3>Create a new client</h3>
<form action="/?page=clients" method="post">
  <div class="form-group">
    <label for="exampleInputEmail">Name</label>
    <input type="text" class="form-control" name="name">
  </div>
  <button type="submit" class="btn btn-primary" name="submit" value="submit">Create</button>
</form>
</div>
