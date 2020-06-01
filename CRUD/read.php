<?php
include 'common/header.php';
$students = json_decode(file_get_contents(__DIR__ . '/resources/students.json'), true);

$id = $_GET['id'];
$specifiedStudent = null;
$flagIsStudent = 1; //czy jest student o podanym indeksie

foreach ($students as $student){
    if ($student['id'] == $id){
        $specifiedStudent = $student;
        break;
    }
}

if($specifiedStudent == null)
    $flagIsStudent = 0;

?>

<?php if($flagIsStudent == 0){ ?>
            <title>Błąd - nie ma takiego studenta</title>
        </head>
    <body>

    <div class="upper">C<a class="R">R</a>UD</div>

    <div class="errorWrapper">
        <p> Studenta o indeksie: <b><?php echo $id ?> </b> nie ma w bazie danych.</p>
        <button  onclick="location.href='index.php'" class="read" type="button" style="font-size: 40px;"><a>Powrót do strony głównej</a></button>
    </div>

<?php } else{ ?>
            <title>Zobacz - <?php echo $specifiedStudent['name'], ' ', $specifiedStudent['surname'] ?></title>
        </head>
    <body>

    <div class="upper">C<a class="R">R</a>UD</div>

    <div class="smallWrapper" >
        <table class="table">
            <tr>
                <td>Indeks</td>
                <td><?php echo $specifiedStudent['id'] ?></td>
            </tr>
            <tr>
                <td>Imię</td>
                <td><?php echo $specifiedStudent['name'] ?></td>
            </tr>
            <tr>
                <td>Nazwisko</td>
                <td><?php echo $specifiedStudent['surname'] ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td><?php echo $specifiedStudent['email'] ?></td>
            </tr>
            <tr>
                <td>Kierunek</td>
                <td><?php echo $specifiedStudent['field of study'] ?></td>
            </tr>
        </table>
        <div class=buttonWrapper>
            <button onclick="location.href='update.php?id=<?php echo $specifiedStudent['id'] ?>'" class="update" type="button"><a>Uaktualnij dane</a></button>
            <button onclick="location.href='delete.php?id=<?php echo $specifiedStudent['id'] ?>'" class="delete" type="button"><a>Usuń studenta</a></button>
        </div>
    </div>
<?php } ?>

<?php include 'common/footer.php' ?>