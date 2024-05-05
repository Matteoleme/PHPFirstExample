<?php
// Connessione al database MySQL
$mysqli = new mysqli("localhost", "root", "", "recensioni");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Preparazione della query SQL per selezionare gli utenti
$sql = "SELECT * FROM utenti";

// Esecuzione della query
$result = $mysqli->query($sql);

// Verifica che ci siano righe nel risultato
if ($result->num_rows > 0) {
    // Inizio della stampa della tabella HTML per mostrare i risultati
    echo "<html><body>";
    echo "<h2>Lista degli utenti registrati:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Cognome</th><th>Email</th></tr>";

    // Fetch delle righe come array associativo e stampa dei dati
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["cognome"] . "</td>";
	echo "<td>" . $row["email"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo '<a href="login.html">Loggati!</a>';
    echo "</body></html>";

    // Liberazione del result set
    $result->free_result();
} // Altrimenti se non ci sono righe nel risultato stampa un messaggio a video
else {
    echo "Nessun utente trovato.";
}

// Chiusura della connessione al database
$mysqli->close();
?>


