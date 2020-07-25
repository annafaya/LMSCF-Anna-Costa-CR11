
<?php
ob_start();
session_start();
require_once 'database/dbAccess.php';
$conn = connect();
//require_once 'DBconnect.php';
// if session is not admin and also not user, this will redirect to login page
if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adopet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Icon library -->
    <script src="https://kit.fontawesome.com/d94fa60402.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="adoption.css">

</head>
    <header>
        <div class="jumbotron main_header text-center mb-3">
            <h1 class="display-4 text-center mt-1">Find you best friend</h1>
            <p class="lead text-center mt-1">help us to give a home for all of these animals!</p>
        </div>
    </header>
<body>
      <body class="bg-info">
       <nav class="navbar m-0 navbar-expand-lg navbar-white bg-secondary mb-sm-5">
        <a class="navbar-brand" href="index.php">Adopet</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Our sweet friends:
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" value="all" href="home.php?type=all">All animals</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" value="small" href="home.php?type=small">Small ones</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" value="large" href="home.php?type=large">Large ones</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" value="senior" href="home.php?type=senior">Old ones</a>
                       
                    </div>
                </li>
                <li class="nav-item active ml-5">
                    <span class="nav-link" >Hi <?php echo getUserFirstName($userID); ?> !</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Sign Out</a>
                </li>
            </ul>
        </div>


    </nav>

        <div id="animalContent" class="container mt-sm-5 ">
            <div id="message" class="row">
            <?php
            $selectedFilter = $_GET["type"];
            switch ($selectedFilter) {
                case "small":
                    $typeQ= "SELECT * FROM animals  INNER JOIN `locations` ON `fk_locationID`= `locationID` WHERE type= 'small'";
                    break;
                case "large":
                    $typeQ= "SELECT * FROM animals  INNER JOIN `locations` ON `fk_locationID`= `locationID`  WHERE type= 'large' ";
                    break;
                case "senior":
                    $typeQ= "SELECT * FROM animals  INNER JOIN `locations` ON `fk_locationID`= `locationID`  WHERE type= 'senior' ";
                    break;
                default:
                    $typeQ= "SELECT * FROM animals  INNER JOIN `locations` ON `fk_locationID`= `locationID`  ";
            }
            $animal=mysqli_query($conn, $typeQ);
            $animalRow = $animal->fetch_all(MYSQLI_ASSOC);

            foreach ($animalRow as $value) {
                echo "<div class='AnimalVisibility mx-auto text-center card p-2' style='width: 15rem;'>
                              <img class='card-img-top ' src='". $value['animalImg']."' alt='Card image cap'>
                              <div class='card-body'>
                                <h5 class='card-title'><strong>" . $value["name"] . "</strong></h5>
                                <p class='card-text'>" . $value["species"] . " <br> " . $value["city"] ."</p>
                                <a class='btn btn-secondary mt-1 mb-1' href='showDetail.php?id=".$value['animalID']."'>Details</a>
                              </div>
                            </div>";
            }
            ?>
            </div>
        </div>
    </div>
<footer class="navbar navbar-expand-lg navbar-dark bg-secondary  mt-1 mt-sm-5 mb-0">
    <a class="navbar-brand" href="#">Adopet &#x2764;</a>
</footer>
   
</body>
</html>
<?php ob_end_flush(); ?>
