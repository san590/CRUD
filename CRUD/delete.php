<?php
include 'common/header.php';
$students = json_decode(file_get_contents(__DIR__ . '/resources/students.json'), true);

$id = $_GET['id'];
$i = 0;

foreach ($students as $student){
    if($student['id'] == $id){
        $name = $student['name'];
        $surname = $student['surname'];
        unset($students[$i]);
        break;}
    $i = $i+1;
}

$students = array_values($students);


file_put_contents('resources/students.json', json_encode($students, JSON_PRETTY_PRINT));

?>

<title>Usunięto - <?php echo $name, ' ', $surname ?></title>
	</head>
	<body>

<div class="upper">CRU<a class="D">D</a></div>

<div class="wrapper" style="height: auto; overflow-y: hidden; text-align: center;">
    <p style="font-size: 32px;">Poprawnie usunięto studenta <b><?php echo $student['name'], ' ', $student['surname']?></b> o indeksie: <b><?php echo $student['id'] ?></b>.</p>
    <button  onclick="location.href='index.php'" class="read" type="button" style="font-size: 40px;"><a>Powrót do strony głównej</a></button>
</div>

<?php include 'common/footer.php'; ?>