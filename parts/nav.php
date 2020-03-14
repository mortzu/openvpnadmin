  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <span class="navbar-brand"><span class="font-weight-bold">OpenVPN</span>Admin</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
<?php
foreach ($config['nav'] as $nav) {
  echo '<li class="nav-item"><a class="nav-link" href="' . $nav['target'] . '">' . $nav['name'] . '</a></li>';
}
?>
      </ul>
    </div>
  </nav>
