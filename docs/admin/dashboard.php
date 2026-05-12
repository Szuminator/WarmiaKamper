<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli("localhost", "root", "", "calendar");

$conn->query("
    DELETE FROM availability
    WHERE end_date < DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
");

if ($conn->connect_error) {
    die("Błąd połączenia");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $start = $_POST['start_date'];
    $end = $_POST['end_date'];

    $stmt = $conn->prepare("
        INSERT INTO availability (start_date, end_date, status)
        VALUES (?, ?, 'booked')
    ");

    $stmt->bind_param("ss", $start, $end);
    $stmt->execute();
}

$result = $conn->query("
    SELECT * FROM availability
    ORDER BY start_date ASC
");
?>

<!DOCTYPE html>
<html lang="pl">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Panel admina</title>

<style>

body {
    font-family: Arial;
    background: #f7f7f7;
    padding: 40px;
}

.container {
    max-width: 1000px;
    margin: auto;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 20px;
    margin-bottom: 30px;
}

input,
button {
    padding: 12px;
    margin-bottom: 10px;
}

button {
    background: #3f6a52;
    border: none;
    color: white;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td,
th {
    padding: 14px;
    border-bottom: 1px solid #ddd;
}

.delete-btn {
    background: #e74c3c;
    padding: 8px 14px;
    text-decoration: none;
    color: white;
    border-radius: 8px;
}

.logout {
    display: inline-block;
    margin-bottom: 20px;
}

</style>

</head>
<body>

<div class="container">

<a href="logout.php" class="logout">
Wyloguj
</a>

<div class="card">

<h2>Dodaj zajęty termin</h2>

<form method="POST">

<label>Od:</label><br>
<input type="date" name="start_date" required><br>

<label>Do:</label><br>
<input type="date" name="end_date" required><br>

<button type="submit">
Dodaj termin
</button>

</form>

</div>

<div class="card">

<h2>Aktualne rezerwacje</h2>

<table>

<tr>
<th>Od</th>
<th>Do</th>
<th>Usuń</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>

<tr>

<td><?php echo $row['start_date']; ?></td>
<td><?php echo $row['end_date']; ?></td>

<td>
<a class="delete-btn" href="delete.php?id=<?php echo $row['id']; ?>">
Usuń
</a>
</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</div>

</body>
</html>