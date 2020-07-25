<?php
ob_start();
session_start();
require_once 'database/dbAccess.php';
$conn = connect();
// if session is not admin and also not user, this will redirect to login page
if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin'])) {
    header("Location: index.php");
    exit;
}
if(isset($_SESSION['user'])){  //if you are a user but not an admin
    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Adopet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Icon library -->
    <script src="https://kit.fontawesome.com/d94fa60402.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="adoption.css">

</head>

<div id="content">
</head>
    <header>
        <div class="jumbotron main_header text-center mb-3">
            <h1 class="display-4 text-center mt-1">Find you best friend</h1>
            <p class="lead text-center mt-1">help us to give a home for all of these animals!</p>
        </div>
    </header>

      <body class="bg-info">
       <nav class="navbar m-0 navbar-expand-lg navbar-white bg-secondary mb-sm-5">
        <a class="navbar-brand" href="index.php">Adopet</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active ml-5">
                    <a class="nav-link" id="add" href="addAnimal.php">Add a new animal</a>
                </li>
                <li class="nav-item active ml-5">
                    <a class="nav-link" id="add" href="home.php">User's home</a>
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


    <div id="animalContent" class="container mt-sm-5 col-8 ">

        <?php
        if ($_GET["id"]) {
        $id =  $_GET["id"];
            $animalArray = (animalDetail($id));
            $animalInfo = $animalArray[0];
            $hobbies="";
        }

        if($_POST){
            $id =  $_POST["id"];
            $name = $_POST["name"];
            $species = $_POST["species"];
            $type = $_POST["type"];
            $birthdate = $_POST["birthdate"];
            $adoptableDate = $_POST["adoptableDate"];
            $website= $_POST["website"];
            $animalImg = $_POST["animalImg"];
            $adoptedBy = $_POST["adoptedByUserID"];
            $address = $_POST["address"];
            $zip = $_POST["zip"];
            $city = $_POST["city"];
            $country = $_POST["country"];
            $hobbies= $_POST["hobbies"];
            $adoptedBy= $_POST['adoptedByUserID'];

            $result= updateAnimal($id, $name,$species,$birthdate,$adoptableDate,$animalImg,$type,$website, $hobbies, $address,$zip,$city,$country,$adoptedBy);

            if($result == TRUE){
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                          <a class=' btn btn-light'  href='adminHome.php'>back to homepage</a>
                          <span class='pl-3'><strong>Thank you for UPDATING!</strong></span>    
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        <br> ";
            }else{
                echo "error";
            }
        }
        ?>
        <form class="col-10 mx-auto" method="post"  action="updateAnimal.php?id=<?=$id?>"  autocomplete="off" >

            <h2>Here you can update the animal's info:</h2>
            <hr />

            Name:
            <input class ="form-control" type="text" name="name" id="name" value="<?php echo $animalInfo['name']?>"placeholder ="Enter animal's name"  maxlength ="50"  /><br>

            Species:
            <input class ="form-control" type="text" name="species" id="species" placeholder ="Enter the species"  maxlength ="40" value="<?php echo $animalInfo['species']?>" /><br>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Type of animal:</label>
                </div>
                <select name="type" value="<?php echo $animalInfo['type']?>" class="custom-select" id="inputGroupSelect01">
                    <option name="type" value="small" <?php if($animalInfo['type'] == 'small') echo "selected='selected'"?>>Small animal</option>
                    <option name="type" value="large" <?php if($animalInfo['type'] == 'large') echo "selected='selected'"?>>Large animal</option>
                    <option name="type" value="senior" <?php if($animalInfo['type'] == 'senior') echo "selected='selected'"?>>Senior</option>
                </select>
            </div>

            Free for adoption since:
            <input class ="form-control" type="date" name="adoptableDate" id="adoptableDate" placeholder ="Free for adoption Date:" value="<?php echo $animalInfo['adoptableDate']?>" maxlength ="50"  /><br>

            <input type="hidden" value="<?php echo $animalInfo['animalID']?>" name="id">

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">Adopted by:</label>
                </div>
                <select name="adoptedByUserID" value="<?php echo $animalInfo['type']?>" class="custom-select" id="inputGroupSelect02"><option name='type' value='' >Choose user:  </option>
                    <?php
                    $users = nameAdoptUser();
                    foreach ($users as $user){
                        $selectedValue = $user['userID'] === $animalInfo['adoptedByUserID'] ? 'selected' : '';
                        echo "<option name='type' value='".$user['userID']."' ".$selectedValue.">".$user['lastName']." </option>";
                    }
                    ?>
                </select>
            </div>

            Birthdate:
            <input class ="form-control" type="date" name="birthdate" id="birthdate" placeholder ="Birthdate" value="<?php echo $animalInfo['birthdate']?>" maxlength ="50"  /><br>

            Hobbies:
            <div class="mt-1" id="hobbiesDiv"><?=$hobbies?></div>
            <input class ="form-control hobbies mb-2" type="text" name="hobbies[]" id="hobbies" placeholder ="Enter animal's hobbies one by one"  maxlength ="50"  /><br>

            <button type="button" class="btn btn-light adding mb-5">&#10133;</button>
            <br>
            Link of Website if existing:
            <input class ="form-control" type="text" name="website" id="website" placeholder ="Enter the link of the animal's Website:" value="<?php echo $animalInfo['website']?>" maxlength ="200"  /><br>

            Animal's image link:
            <input class ="form-control" type="text" name="animalImg" id="animalImg" placeholder ="Copy here a link for the animal's picture:" value="<?php echo $animalInfo['animalImg']?>" maxlength ="500"  /><br>

            Address:
            <input class ="form-control hobbies" type="text" name="address" id="address" placeholder ="Enter animal's Address" value="<?php echo $animalInfo['address']?>" maxlength ="50"  /><br>

            Zip Code:
            <input class ="form-control hobbies" type="text" name="zip" id="zip" placeholder ="Enter zip code"  maxlength ="50" value="<?php echo $animalInfo['zip']?>" /><br>

            City:
            <input class ="form-control hobbies" type="text" name="city" id="city" placeholder ="Enter animal's city"  maxlength ="50" value="<?php echo $animalInfo['city']?>"  /><br>

            Country:
            <input class ="form-control hobbies" type="text" name="country" id="country" placeholder ="Enter animal's country" value="<?php echo $animalInfo['country']?>" maxlength ="50"  /><br>

            <hr />

            <button   type = "submit"   class = "btn btn-block btn-warning"   name = "updatebtn" >Update animal's info</button >
            <hr  />

        </form>

    </div>
</div>
<footer class="navbar navbar-expand-lg navbar-dark bg-secondary  mt-1 mt-sm-5 mb-0">
    <a class="navbar-brand" href="#">Adopet &#x2764;</a>
</footer>

</body>
</html>
<?php  ob_end_flush(); ?>