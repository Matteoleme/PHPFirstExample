<?php
// Connessione al database MySQL
$mysqli = mysqli_connect("localhost", "my_user", "my_password", "my_db");

// Verifica della connessione
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Preparazione della query SQL per selezionare gli utenti
$sql = "SELECT id, username, password, created_at FROM users ORDER BY username";

// Esecuzione della query
$result = mysqli_query($mysqli, $sql);

// Verifica che ci siano righe nel risultato
if (mysqli_num_rows($result) > 0) {
    // Inizio della stampa della tabella HTML per mostrare i risultati
    echo "<html><body>";
    echo "<h2>Lista degli utenti registrati:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>Created At</th></tr>";

    // Fetch delle righe come array associativo e stampa dei dati
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["password"]) . "</td>";  // Nota: mostrare la password in chiaro non è sicuro
        echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</body></html>";

    // Liberazione del result set
    mysqli_free_result($result);
} else {
    echo "Nessun utente trovato.";
}

// Chiusura della connessione al database
mysqli_close($mysqli);
?>
