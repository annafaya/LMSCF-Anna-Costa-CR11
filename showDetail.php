<?php
ob_start();
session_start();
require_once 'database/dbAccess.php';

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


    <?php
    if($_GET['id']) {
        $animalID = $_GET['id'];
        $animalArray = (animalDetail($animalID));
        $animalInfo = $animalArray[0];
        $birthdate= $animalInfo['birthdate'];
        $adoptableDate= $animalInfo['adoptableDate'];
        $hobbies = $animalInfo['hobbies'];

    ?>
        <div class='container '>
            <div class='row thumbnail mx-auto'>
                <div class='col-12 row mx-auto'>
                    <img class='col-12'  src='<?=$animalInfo['animalImg']?>' alt=\"Lights\" style='width:50%'>
                    <div class='caption my-auto col-12'>
                        <hr>
                        <h3>Who am I:</h3>
                        <a class="float-right btn btn-secondary" href="mailto:anna@gmail.com">Click here to meet me!</a>
                        <br>
                      
                        <p>My name is:  <strong><?=$animalInfo['name']?></strong> </p>
                                   <p>I'm a lovely <strong><?=$animalInfo['species']?></strong>.</p>
                        <p class="<?=isset($animalInfo['adoptedByUserID'])?'d-none':''?>">I'm available for adoption since: <strong><?=$animalInfo['adoptableDate']?></strong>  , just waiting for you!</p>
                        <p class="<?=isset($animalInfo['adoptedByUserID'])?'':'d-none'?>"><strong>I already found my best Friend but thank you for your interest &#x2764;</strong></p>

                        <p>My birthday is on:  <strong><?=$animalInfo['birthdate']?></strong></p>
                        <p>My favorite activity is: <strong><?=$hobbies?></strong></p>
                        <p class="<?=isset($animalInfo['website']) && strpos($animalInfo['website'], 'http') !==false? '' :'d-none'?>">And that's the website I take care of when I'm not busy with my hobbies:</p>
                        <a class='btn btn-secondary mt-1 mb-1 <?=isset($animalInfo['website']) && strpos($animalInfo['website'], 'http') !==false ? '' : 'd-none'?>' target="_blank" href='<?=$animalInfo['website']?>'>my website</a>
                        <br>
                        
                        <h3>Temporary home:</h3>
                        
                        <p>My address for now:</p>
                        <strong><p><?=$animalInfo['address']?>, <?=$animalInfo['zip']?>, <?=$animalInfo['city']?></p>
                            <p><?=$animalInfo['country']?></p></strong>
                        <br>
                                        

                    </div>
                </div>
            </div>



        </div>

    <?php
    }
    ?>
</div>
<footer class="navbar navbar-expand-lg navbar-dark bg-secondary  mt-1 mt-sm-5 mb-0">
    <a class="navbar-brand" href="#">Adopet &#x2764;</a>
</footer>

</body>
</html>
<?php  ob_end_flush(); ?>