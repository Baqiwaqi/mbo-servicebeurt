<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<!--header-->
<div class="jumbotron">
    <h1 class="text-center">Vakgarage</h1>
    <p class="text-center">Voor al je reparaties en servicebeurten</p>
</div>

<!--nabar-->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="afspraak.php">Afspraak maken</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="onderhoudreparatie.php">Onderhoud & reparatie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <?php
                if (isset($_SESSION['userId'])) {
                    echo "
                                <li class=\"nav-item\">
                                    <a class=\"nav-link\" href=\"#\">Mijn gegevens</a>
                                </li>
                             ";
                }
                ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php
                if (isset($_SESSION['userId'])) {
                    echo '<li class="nav-item">
                                <a class="nav-link" href="includes/logout.inc.php">Uitloggen</a>
                          </li>
                         ';
                }
                else {
                    echo '
                          <li class="nav-item">
                                <a class="nav-link" href="aanmelden.php">Aanmelden</a>
                          </li>
                          <li class="nav-item">
                                <a class="nav-link" href="inloggen.php">Inloggen</a>
                          </li>
                         ';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<!--/navbar-->

<?php
    require 'includes/dbh.php';
    $id = $_SESSION['userId'];
    $sql = "SELECT * FROM users WHERE idUsers='$id'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)){
            $voornaam = $row['voornaamUsers'];
            $achternaam = $row['achternaamUsers'];
            $adres = $row['adresUsers'];
            $huisnummer = $row['huisnummerUsers'];
            $postcode = $row['postcodeUsers'];
            $woonplaats = $row['woonplaatsUser'];
            $email = $row['emailUsers'];
        }

    }
?>

<!-- aanmeld form -->
<div class="container" id="aanmelden">
    <h2 class="text-center">Mijn gegevens</h2>
    <p>Gebruiker gevens aanpassen</p>
    <form class="form-horizontal" action="includes/update.inc.php" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="voornaam">Voornaam:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="voornaam" value="<?php echo $voornaam?>" name="voornaam">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="achternaam">Achternaam:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="achternaam" value="<?php echo $achternaam?>" name="achternaam">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="adres">Adres:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="adres" value="<?php echo $adres?>" name="adres">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="huisnummer">Huisnummer:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="huisnummer" value="<?php echo $huisnummer?>" name="huisnummer">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="huisnummer">Postcode:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="postcode" value="<?php echo $postcode?>" name="postcode">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="huisnummer">Woonplaats:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="woonplaats" value="<?php echo $woonplaats?>" name="woonplaats">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" value="<?php echo $email?>" name="email">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Password:</label>
            <div class="col-sm-10">
                <input required type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwdh">Herhaling Password:</label>
            <div class="col-sm-10">
                <input required type="password" class="form-control" id="pwdh" placeholder="Herhaling password" name="pwdh">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-warning" id="afspraakbtn2" name="submit">Submit</button>
            </div>
        </div>
    </form>
</div>
<!--footer-->
<footer class="container-fluid">
    <div class="row">
        <div class="col-12 col-md">
            <h4>Vakgarage</h4>
            <small class="d-block mb-3 text-muted">&copy; 2019</small>
        </div>
        <div class="col-6 col-md">
            <h5>Diensten</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="#">Vakantiecheck</a></li>
                <li><a class="text-muted" href="#">Onderhoud en reparatie</a></li>
                <li><a class="text-muted" href="#">Pechhulp</a></li>
                <li><a class="text-muted" href="#">Schadeherstel</a></li>
                <li><a class="text-muted" href="#">Grote beurt</a></li>
                <li><a class="text-muted" href="#">Alles over banden</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Onderdelen en producten</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="#">Accesoires</a></li>
                <li><a class="text-muted" href="#">Trekhaken</a></li>
                <li><a class="text-muted" href="#">Oliefilter</a></li>
                <li><a class="text-muted" href="#">Distributieriem</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Over vakgarage</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="#">Over Vakgarage</a></li>
                <li><a class="text-muted" href="#">Vacatures</a></li>
                <li><a class="text-muted" href="#">Locaties</a></li>
                <li><a class="text-muted" href="#">Actueel</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Contact</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="contact.php">Locaties</a></li>
                <li><a class="text-muted" href="contact.php">Contact</a></li>
                <li><a class="text-muted" href="#">Nieuwsbrief</a></li>
                <li><a class="text-muted" href="#">Formulier</a></li>
            </ul>
        </div>
    </div>
</footer>
<!--footer-->
</body>
</html>