<div class="container">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Vaša banka</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="index.php"><a href="index.php">Početna</a></li>
                <?php if(isset($_SESSION['userName']) && $_SESSION['userAdmin'] == 0){ ?>
                    <li><a href="transaction.php">Tvoje transakcije</a></li>
                    <li><a href="transfer.php">Pošalji novac</a></li>
                    <li><a href="bizInfo.php">Biz Info</a></li>
                <?php } else if (isset($_SESSION['userName']) && $_SESSION['userAdmin'] == 1) { ?>
                    <li><a href="transactionAdmin.php">Pregled transakcija</a></li>
                    <li><a href="chart.php">Grafikon</a></li>
                    <li><a href="users.php">Svi korisnici</a></li>
                <?php }?>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php if(!isset($_SESSION['userName'])){ ?>
                    <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Registracija</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Logovanje</a></li>
                <?php } else if (isset($_SESSION['userName'])) { ?>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
                <?php }?>
            </ul>
        </div>
    </nav>
</div>