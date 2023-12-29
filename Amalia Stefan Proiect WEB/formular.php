<?php
session_start(); // Începeți sau continuați o sesiune existentă
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Parametrii pentru conectarea la baza de date PostgreSQL
    $host = "localhost"; // Adresa IP sau numele serverului PostgreSQL
    $port = "5432"; // Portul pentru conexiunea la PostgreSQL
    $dbname = "utilizatori"; // Înlocuiți cu numele bazei de date reale
    $user = "postgres"; // Înlocuiți cu numele utilizatorului real
    $password = "1234crazy"; // Înlocuiți cu parola reală

    // Realizarea conexiunii
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    // Verificarea conexiunii
    if (!$conn) {
        die("Conexiunea la baza de date a eșuat");
    }

    // Verificați dacă există date trimise prin formular și procesați-le aici...
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // TODO: Verificați credențialele în baza de date și faceți operațiile necesare
        $query = "SELECT * FROM nume_tabela WHERE email='$email' AND password='$password'";
        $result = pg_query($conn, $query);

        if (!$result) {
            die("Eroare la interogare: " . pg_last_error($conn));
        }

        // Verificăm dacă s-au găsit rânduri în rezultatul interogării
        if (pg_num_rows($result) > 0) {
            // Autentificare reușită
            echo "Autentificare reușită!";
            // Aici puteți redirecționa utilizatorul către pagina de profil sau altă pagină relevantă
        } else {
            // Autentificare eșuată
            echo "Autentificare eșuată. Verificați adresa de email și parola.";
        }

        if (pg_num_rows($result) > 0) {
            // Autentificare reușită
            $_SESSION['loggedin'] = true; // Setăm o variabilă de sesiune pentru a indica că utilizatorul este autentificat
            $_SESSION['username'] = $email; // Puteți stoca alte informații ale utilizatorului în sesiune, cum ar fi numele de utilizator sau alte detalii relevante
        
            // Redirecționare către o pagină de profil sau altă pagină relevantă după autentificare
            header('Location: pagina_de_profil.php');
            exit();
        } else {
            // Autentificare eșuată
            echo "Autentificare eșuată. Verificați adresa de email și parola.";
        }

        // Verificăm dacă utilizatorul este autentificat
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Afișăm mesajul de autentificare sau alte informații relevante pentru utilizatorul autentificat
        echo "Bun venit, " . $_SESSION['username'] . "!"; // Aici puteți afișa numele de utilizator sau alte detalii

        // Afișăm un buton sau link pentru deconectare sau alte acțiuni specifice utilizatorului autentificat
        echo '<a href="logout.php">Deconectare</a>'; // Aici "logout.php" ar fi pagina unde veți trata deconectarea utilizatorului
        } else {
        // Afișăm un mesaj sau formular pentru autentificare, dacă utilizatorul nu este autentificat
        echo '<div class="login-container">
            <h1>Formular de Login</h1>
            <form class="login-form" action="login.php" method="POST">
                <input type="text" name="email" placeholder="Introduceți adresa de email"><br> 
                <input type="password" name="password" placeholder="Introduceți parola"><br>
               
                <input type="reset" value="RENUNTA">
                <input type="submit" value="TRIMITE">
            </form>
          </div>';
        }
    }

    // Distrugem toate variabilele de sesiune
    session_unset();

    // Ștergem sesiunea
    session_destroy();

    // Redirecționăm către pagina de login sau altă pagină relevantă
    header('Location: index.html');
    exit();
    
}
?>