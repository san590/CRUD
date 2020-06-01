<?php include 'common/header.php'; 
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$idError = $_POST['idError'];
$nameError = $_POST['nameError'];
$surnameError = $_POST['surnameError'];
$emailError = $_POST['emailError'];
$fosError = $_POST["fosError"];

$idValue = $_POST['id'];
$nameValue = $_POST['name'];
$surnameValue = $_POST['surname'];
$emailValue = $_POST['email'];
$fosValue = $_POST["fos"];

?>

<title>Utwórz</title>
	</head>
	<body>

<div class="upper"><a class="C">C</a>RUD</div>

<div class="smallWrapper">
    <form method="POST" action="validate.php">
        <label for="id">Indeks:</label>
        <input type="number" id="id" name="id" placeholder="111111" value="<?php echo $idValue; ?>"><br>
        <?php echoError($idError); ?>
        <label for="name">Imię:</label>
        <input type="text" id="name" name="name" placeholder="Jan" value="<?php echo $nameValue; ?>"><br>
        <?php echoError($nameError); ?>
        <label for="surname">Nazwisko:</label>
        <input type="text" id="surname" name="surname" placeholder="Kowalski" value="<?php echo $surnameValue; ?>"><br>
        <?php echoError($surnameError); ?>
        <label for="email">Adres e-mail:</label>
        <input type="text" id="email" name="email" placeholder="111111@stud.prz.edu.pl" value="<?php echo $emailValue; ?>"><br>
        <?php echoError($emailError); ?>
        <label for="field_of_study">Kierunek:</label>
        <input type="text" id="field_of_study" name="field_of_study" placeholder="Informatyka" value="<?php echo $fosValue; ?>"><br>
        <?php echoError($fosError); ?>
        <input type="submit" name="function" value="Utwórz" class="create">
    </form> 
</div>


<?php include 'common/footer.php'; 

function echoError($error){
    if($error == "+"){ ?>
        <a class="C" style="font-size: 16px;">Wartość poprawna</a><br>
    <?php }else{ ?>
        <a class="D" style="font-size: 16px;"><?php echo $error; ?></a><br>
    <?php } 
}
?>