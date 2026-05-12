<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $password = $_POST['password'];

    if ($password === 'kamper123') {

        $_SESSION['logged_in'] = true;

        header('Location: dashboard.php');
        exit;

    } else {

        $error = 'Nieprawidłowe hasło';

    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Panel logowania</title>

<style>

body {
    font-family: Arial;
    background: #f7f7f7;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.box {
    background: white;
    padding: 40px;
    border-radius: 20px;
    width: 350px;
}

input {
    width: 100%;
    padding: 14px;
    margin-bottom: 20px;
}

button {
    width: 100%;
    padding: 14px;
    border: none;
    background: #3f6a52;
    color: white;
    cursor: pointer;
}

.error {
    color: red;
    margin-bottom: 20px;
}

</style>

</head>
<body>

<div class="box">

<h2>Panel administratora</h2>

<?php if($error): ?>
<div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST">

<input type="password" name="password" placeholder="Hasło">

<button type="submit">
Zaloguj
</button>

</form>

</div>

</body>
</html>