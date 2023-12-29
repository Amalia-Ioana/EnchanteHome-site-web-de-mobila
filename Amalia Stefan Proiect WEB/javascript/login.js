const express = require('express');
const bodyParser = require('body-parser');
const { Pool } = require('pg');

const app = express();

// Configurare pentru a parsa corpul cererii
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Configurare pentru conectare la baza de date PostgreSQL
const pool = new Pool({
  user: 'utilizator',
  host: 'localhost',
  database: 'nume_baza_date',
  password: 'parola',
  port: 5432,
});

// Ruta pentru gestionarea cererii de login
app.post('/login', async (req, res) => {
  const { email, password } = req.body;

  try {
    // Verificare în baza de date pentru existența utilizatorului și a parolei
    const query = 'SELECT * FROM users WHERE email = $1 AND password = $2';
    const result = await pool.query(query, [email, password]);

    if (result.rows.length > 0) {
      // Autentificare reușită
      res.status(200).send('Autentificare reușită!');
    } else {
      // Autentificare eșuată
      res.status(401).send('Email sau parolă incorecte!');
    }
  } catch (error) {
    console.error('Eroare la autentificare:', error);
    res.status(500).send('Eroare la autentificare!');
  }
});

// Pornirea serverului
app.listen(3000, () => {
  console.log('Serverul rulează pe portul 3000');
});
