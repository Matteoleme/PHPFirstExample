<?php
// Avvia la sessione
session_start();

// Dettagli del server e credenziali per la connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "recensioni";

// Crea la connessione al database
$dbconn = mysqli_connect($servername, $username, $password, $db_name);

// Controlla la connessione
if (!$dbconn) {
    die("Connessione fallita: " . mysqli_connect_error());
}

// Verifica che il metodo di richiesta sia POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($dbconn, $_POST['email']);
    $password = mysqli_real_escape_string($dbconn, $_POST['password']);

    // Prepara una query SQL per verificare le credenziali
    $query = "SELECT * FROM Utenti WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($dbconn, $query);

    // Verifica se sono state trovate corrispondenze
    if (mysqli_num_rows($result) > 0) {
        // Imposta una variabile di sessione per l'utente loggato
        $_SESSION['user_email'] = $email;
        echo "Login riuscito!";
        // Reindirizza all'area riservata o a una pagina di benvenuto
        header("Location: welcome.php");
        exit();
    } else {
        echo "Credenziali non valide!";
    }
    mysqli_close($dbconn);
} else {
    // Reindirizza alla pagina di login se il metodo di richiesta non è POST
    header("Location: login.html");
    exit();
}
?>
