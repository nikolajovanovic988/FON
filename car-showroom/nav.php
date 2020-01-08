<?php
    include "paths.php";
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Car Profile</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo(get_include_path()); ?>/index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo(get_include_path()); ?>/all_cars.php">All Cars</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo(get_include_path()); ?>/drivers.php" tabindex="-1" aria-disabled="true">Drivers</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Official Pages
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="http://www.peugeot.com/en">Peugeot</a>
                    <a class="dropdown-item" href="https://www.citroen.com/en/">Citroen</a>
                    <a class="dropdown-item" href="https://group.renault.com/">Renault</a>
                    <a class="dropdown-item" href="https://www.opel.rs/">Opel</a>
                </div>
            </li>
        </ul>
        
    </div>
</nav>
