<?php
// Avvia la sessione
session_start();

// Connetti al database
$dbconn = new mysqli('localhost', 'root', '', 'recensioni');

if ($dbconn->connect_error) {
    die("Connessione fallita: " . $dbconn->connect_error);
}

// Verifica che il metodo di richiesta sia POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $dbconn->real_escape_string($_POST['email']);
    $password = $dbconn->real_escape_string($_POST['password']);

    // Prepara una query SQL per verificare le credenziali
    $query = "SELECT * FROM Utenti WHERE email = '$email' AND password = '$password'";
    $result = $dbconn->query($query);

    if ($result->num_rows > 0) {
        // Imposta una variabile di sessione per l'utente loggato
        $_SESSION['user_email'] = $email;
        echo "Login riuscito!";
        // Reindirizza all'area riservata o a una pagina di benvenuto
        header("Location: welcome.php");
    } else {
        echo "Credenziali non valide!";
    }
    $dbconn->close();
} else {
    // Reindirizza alla pagina di login se il metodo di richiesta non è POST
    header("Location: login.html");
}
?>