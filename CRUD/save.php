<?php
include 'common/header.php';

$students = json_decode(file_get_contents(__DIR__ . '/resources/students.json'), true);

$obj = new stdClass();
$obj->id = $_POST['id'];
$obj->name = $_POST['name'];
$obj->surname = $_POST['surname'];
$obj->email = $_POST['email'];
$obj->{'field of study'} = $_POST['fos'];

$i = 0;
$function = $_POST['function'];

if($function == "Utwórz"){
    $obj->token = generate();
} else {
    $obj->token = $_POST['token'];
}

if($function == "Aktualizuj"){
    foreach ($students as $student){
        if($student['id'] == $_POST['oldId'])
            unset($students[$i]);
        $i = $i+1;
    } 
}else {
    foreach ($students as $student){
        if($student['id'] == $obj->id)
            unset($students[$i]);
        $i = $i+1;
    } 
}


$array = (array) $obj;

$var = array();
array_push($var, $array);

$arr = array_merge($students, $var);

file_put_contents('resources/students.json', json_encode($arr, JSON_PRETTY_PRINT));

function generate(){
    $str = "";

    for($i = 0; $i < 16; $i = $i +1){
        $var = mt_rand(48, 122);

        if(($var >= 48 && $var <= 57 ) || ($var >= 65 && $var <= 90 ) || ($var >= 97 && $var <= 122))
            $str .= chr($var);
    }

    return $str;
}

?>

<?php if($function == "Aktualizuj"){ ?>
    <title>Zaktualizowano - <?php echo $obj->name, ' ', $obj->surname ?></title>
	</head>
	<body>
    <div class="upper">CR<a class="U">U</a>D</div>
<?php }else{ ?>
    <title>Dodano - <?php echo $obj->name, ' ', $obj->surname ?></title>
	</head>
	<body>
    <div class="upper"><a class="C">C</a>RUD</div>
<?php } ?>

<div class="wrapper" style="height: auto; overflow-y: hidden; text-align: center;">
    <?php if($function == "Aktualizuj"){ ?>
        <p style="font-size: 32px;">Poprawnie zaktualizowano studenta <b><?php echo $obj->name, ' ', $obj->surname?></b> o indeksie: <b><?php echo $obj->id ?></b>.</p>
    <?php }else{ ?>
        <p style="font-size: 32px;">Poprawnie dodano studenta <b><?php echo $obj->name, ' ', $obj->surname?></b> o indeksie: <b><?php echo $obj->id ?></b>.</p>
    <?php } ?>
    <button  onclick="location.href='index.php'" class="read" type="button" style="font-size: 40px;"><a>Powrót do strony głównej</a></button>
</div>

<?php include 'common/footer.php' ?>