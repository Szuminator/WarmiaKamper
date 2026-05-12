<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "calendar";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

$sql = "SELECT * FROM availability";
$result = $conn->query($sql);

$events = [];

while($row = $result->fetch_assoc()) {

    $color = '#4CAF50';

    if($row['status'] === 'booked') {
        $color = '#e74c3c';
    }

    $events[] = [
        'title' => $row['status'] === 'booked' ? 'Zajęty' : 'Wolny',
        'start' => $row['start_date'],
        'end' => date('Y-m-d', strtotime($row['end_date'] . ' +1 day')),
        'color' => $color
    ];
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Kalendarz dostępności | Warmia Kamper</title>

  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">

  <style>

    body {
      font-family: Arial, sans-serif;
      background: #f7f7f7;
      margin: 0;
      padding: 40px 20px;
    }

    .container {
      max-width: 1100px;
      margin: auto;
    }

    h1 {
      text-align: center;
      margin-bottom: 40px;
    }

    #calendar {
      background: white;
      padding: 20px;
      border-radius: 24px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .back-button {
      display: inline-block;
      margin-bottom: 20px;
      text-decoration: none;
      color: white;
      background: #3f6a52;
      padding: 12px 18px;
      border-radius: 999px;
    }

  </style>

</head>
<body>

<div class="container">

  <a href="index.html" class="back-button">
    ← Powrót
  </a>

  <h1>Kalendarz dostępności</h1>

  <div id="calendar"></div>

</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {

    const calendarEl = document.getElementById('calendar');

   const calendar = new FullCalendar.Calendar(calendarEl, {

    initialView: 'dayGridMonth',

    locale: 'pl',

    firstDay: 1,
    
    buttonText: {
      today: 'Dzisiaj'
    },

    events: <?php echo json_encode($events); ?>

});

    calendar.render();

});

</script>

</body>
</html>