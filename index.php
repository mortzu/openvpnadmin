<?php

$script_directory = realpath(__DIR__);

require_once $script_directory . '/config.defaults.php';
require_once $script_directory . '/config.php';
require_once $script_directory . '/class/OpenVPNAuth.php';
require_once $script_directory . '/class/OpenVPNStatus.php';

session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title></title>
    <style>main > .container { padding: 60px 15px 0; }</style>
  </head>
  <body>

<header>
<?php require_once $script_directory . '/parts/nav.php'; ?>
</header>

<main role="main" class="flex-shrink-0">
<div class="container">

<?php

if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
  if (!isset($_GET['page']) || $_GET['page'] == '')
    require_once $script_directory . '/parts/connected_clients.php';
  elseif ($_GET['page'] == 'clients')
    require_once $script_directory . '/parts/clients.php';
} else {
  require_once $script_directory . '/parts/login.php';
}

?>
</div>
</main>

</body>
</html>
