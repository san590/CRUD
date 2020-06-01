<?php
$students = json_decode(file_get_contents(__DIR__ . '/resources/students.json'), true);
include 'common/header.php';

usort($students, function($a, $b) {
    return $a['id'] <=> $b['id'];
});
?>

<title>Panel głowny</title>
	</head>
	<body>

<div class="upper"><a class="C">C</a><a class="R">R</a><a class="U">U</a><a class="D">D</a></div>

<div class="wrapper">
    <table class="table">
        <thead>
        <tr>
            <th>Indeks</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>E-mail</th>
            <th>Kierunek</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $student){ ?>
            <tr>
                <td><?php echo $student['id'] ?></td>
                <td><?php echo $student['name'] ?></td>
                <td><?php echo $student['surname'] ?></td>
                <td><?php echo $student['email'] ?></td>
                <td><?php echo $student['field of study']?></td>
                <td>
                    <button  onclick="location.href='read.php?id=<?php echo $student['id'] ?>'" class="read" type="button"><a>Zobacz</a></button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
       
    </table>
    <button onclick="location.href='create.php'" class="create" type="button"><a>Dodaj nowego studenta</a></button>
    
</div>

<?php include 'common/footer.php'; ?>