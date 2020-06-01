<?php
$students = json_decode(file_get_contents(__DIR__ . '/resources/students.json'), true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$idError = "";
$nameError = "";
$surnameError = "";
$emailError = "";
$fosError = "";

$id= $_POST['id'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$fos = $_POST["field_of_study"];

$function = $_POST['function'];
$oldId = 0;
$flagId = 0;


if($function == "Aktualizuj"){
    $oldId = $_POST["oldId"];
    $token = $_POST['token'];
}


if($id == ""){
    $idError = 'Nie podano numeru indeksu!';
} else if ($id < 1) {
    $idError = 'Indeks musi być liczbą dodatnią!';
} else if(!($function == "Aktualizuj")){
        foreach($students as $student){
            if($student['id'] == $id){
                $idError = 'Student o podanym indeksie już istnieje!';
                $flagId = 1;
                break;
            }
        }
        if($flagId == 0)
        $idError="+"; //sytuacja gdy nie ma żadnego studenta, wówczas pętla na górze się nigdy nie wykona i plus w pętli by nie wystąpił, a musi do poprawnej walidacji
} else {
        foreach($students as $student){    
            $idError = "+";
            if($student['id'] == $id && $student['token'] != $token){
                $idError = 'Próbujesz nadpisać innego studenta!';
                break;
            }
    }
}

if($name == ""){
    $nameError = "Nie podano imienia!";
} else {
    $nameError = "+";
}

if($surname == "") {
    $surnameError = "Nie podano nazwiska!";
} else {
    $surnameError = "+";
}

if($email == "") {
    $emailError = "Nie podano adresu e-mail!";
} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailError = "Błędny format adresu e-mail!";
} else {
    $emailError ="+";
}

if($fos == "") {
    $fosError = "Nie podano kierunku studiów!";
} else{
    $fosError = "+";
}

?>
    
<form method="POST" action="create.php" id="form1" style="display: none;">
    <input type="text" id="idError" name="idError" value="<?php echo $idError; ?>"><br>
    <input type="text" id="nameError" name="nameError" value="<?php echo $nameError; ?>"><br>
    <input type="text" id="surnameError" name="surnameError" value="<?php echo $surnameError; ?>"><br>
    <input type="text" id="emailError" name="emailError" value="<?php echo $emailError; ?>"><br>
    <input type="text" id="fosError" name="fosError" value="<?php echo $fosError; ?>"><br>
    <input type="text" id="id" name="id" value="<?php echo $id; ?>"><br>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
    <input type="text" id="surname" name="surname" value="<?php echo $surname; ?>"><br>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>
    <input type="text" id="fos" name="fos" value="<?php echo $fos; ?>"><br>
</form>

<form method="POST" action="update.php" id="form2" style="display: none;">
    <input type="text" id="idError" name="idError" value="<?php echo $idError; ?>"><br>
    <input type="text" id="nameError" name="nameError" value="<?php echo $nameError; ?>"><br>
    <input type="text" id="surnameError" name="surnameError" value="<?php echo $surnameError; ?>"><br>
    <input type="text" id="emailError" name="emailError" value="<?php echo $emailError; ?>"><br>
    <input type="text" id="fosError" name="fosError" value="<?php echo $fosError; ?>"><br>
    <input type="text" id="id" name="id" value="<?php echo $id; ?>"><br>
    <input type="text" id="oldId" name="oldId" value="<?php echo $oldId; ?>"><br>
    <input type="text" id="token" name="token" value="<?php echo $token; ?>"><br>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
    <input type="text" id="surname" name="surname" value="<?php echo $surname; ?>"><br>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>
    <input type="text" id="fos" name="fos" value="<?php echo $fos; ?>"><br>
</form>


<form method="POST" action="save.php" id="form3" style="display: none;">
    <input type="text" id="id" name="id" value="<?php echo $id; ?>"><br>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
    <input type="text" id="surname" name="surname" value="<?php echo $surname; ?>"><br>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>
    <input type="text" id="fos" name="fos" value="<?php echo $fos; ?>"><br>
    <input type="text" id="function" name="function" value="<?php echo $function; ?>"><br>
    <input type="text" id="oldId" name="oldId" value="<?php echo $oldId; ?>"><br>
    <input type="text" id="token" name="token" value="<?php echo $token; ?>"><br>
</form>

<?php if(!($idError == "+" && $nameError == "+" && $surnameError == "+" && $emailError == "+" && $fosError == "+")){
    if($function == "Aktualizuj"){?>
        <script type="text/javascript">
            document.getElementById("form2").submit();
        </script>
    <?php }else{ ?>
        <script type="text/javascript">
            document.getElementById("form1").submit();
        </script>
    <?php }
}

if($idError == "+" && $nameError == "+" && $surnameError == "+" && $emailError == "+" && $fosError == "+"){?>
    <script type="text/javascript">
        document.getElementById("form3").submit();
    </script>
<?php } ?>