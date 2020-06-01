<?php
include 'common/header.php';
$students = json_decode(file_get_contents(__DIR__ . '/resources/students.json'), true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$id = $_GET['id'];
$inputId = 0;
$inputId = $_POST['id'];
$specifiedStudent = null;
$flagIsStudent = 1; //czy jest student o podanym indeksie

foreach ($students as $student){
    if ($student['id'] == $id){
        $specifiedStudent = $student;
        break;
    }
}

$idError = $_POST['idError'];
$nameError = $_POST['nameError'];
$surnameError = $_POST['surnameError'];
$emailError = $_POST['emailError'];
$fosError = $_POST["fosError"];


if($inputId == 0){ //żeby nie wydrukkować "poprawna wartość" dla braku podanej wartości
    $idValue = $specifiedStudent['id'];
    $oldIdValue = $idValue;
    $nameValue = $specifiedStudent['name'];
    $surnameValue = $specifiedStudent['surname'];
    $emailValue = $specifiedStudent['email'];
    $fosValue = $specifiedStudent["field of study"];
    $token = $specifiedStudent['token'];
} else{
    $oldIdValue = $_POST['oldId'];
    $idValue = $_POST['id'];
    $nameValue = $_POST['name'];
    $surnameValue = $_POST['surname'];
    $emailValue = $_POST['email'];
    $fosValue = $_POST["fos"];
    $token = $_POST['token'];
}

foreach ($students as $student){
    if ($student['id'] == $idValue){
        $specifiedStudent = $student;
        break;
    }
}

if($specifiedStudent == null && $idValue != $oldIdValue)
    $flagIsStudent = 0;

?>

<?php if($flagIsStudent == 0){ ?>
            <title>Błąd - nie ma takiego studenta </title>
	    </head>
	<body>

    <div class="upper">CR<a class="U">U</a>D</div>

    <div class="errorWrapper">
        <p> Studenta o indeksie: <b><?php echo $idValue ?> </b> nie ma w bazie danych.</p>
        <button  onclick="location.href='index.php'" class="read" type="button" style="font-size: 40px;"><a>Powrót do strony głównej</a></button>
    </div>

<?php } else { ?>
            <title>Uaktualnij - <?php echo $nameValue, ' ', $surnameValue ?> </title>
        </head>
    <body>

    <div class="upper">CR<a class="U">U</a>D</div>

    <div class="smallWrapper">
        <form method="POST" action="validate.php">
            <label for="id">Indeks:</label>
            <input type="number" id="id" name="id" value=<?php echo $idValue; ?>><br>
            <?php echoError($idError); ?>
            <label for="name">Imię:</label>
            <input type="text" id="name" name="name" value=<?php echo $nameValue; ?>><br>
            <?php echoError($nameError); ?>
            <label for="surname">Nazwisko:</label>
            <input type="text" id="surname" name="surname" value=<?php echo $surnameValue;?>><br>
            <?php echoError($surnameError); ?>
            <label for="email">Adres e-mail:</label>
            <input type="text" id="email" name="email" value=<?php echo $emailValue; ?>><br>
            <?php echoError($emailError); ?>
            <label for="field_of_study">Kierunek:</label>
            <input type="text" id="field_of_study" name="field_of_study" value=<?php echo $fosValue; ?>><br>
            <?php echoError($fosError); ?>
            <input type="submit" name="function" value="Aktualizuj" class="update" style="width: 100%;">
            <input type="hidden" name="oldId" value=<?php echo $oldIdValue ?>>
            <input type="hidden" name="token" value=<?php echo $token ?>>
        </form> 
    </div>
<?php } ?>


<?php include 'common/footer.php';

function echoError($error){
    if($error == "+"){ ?>
        <a class="C" style="font-size: 16px;">Wartość poprawna</a><br>
    <?php }else{ ?>
        <a class="D" style="font-size: 16px;"><?php echo $error; ?></a><br>
    <?php } 
}
?>