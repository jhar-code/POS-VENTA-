<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Instalación completada</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #1976d2;
      --primary-dark: #0d47a1;
      --bg: #f4f6f9;
      --text: #333;
      --radius: 12px;
      --shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background: var(--bg);
      color: var(--text);
    }
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    .card {
      background: #fff;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      max-width: 700px;
      width: 100%;
      padding: 40px 30px;
      text-align: center;
      animation: fadeIn 0.6s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    h3 {
      margin-bottom: 15px;
      font-weight: 500;
      color: var(--primary-dark);
      font-size: 1.6rem;
    }
    p {
      margin: 10px 0;
      font-size: 1rem;
      color: #555;
    }
    ul {
      text-align: left;
      margin: 20px auto;
      max-width: 500px;
      padding-left: 20px;
      color: #444;
    }
    ul li {
      margin: 8px 0;
      line-height: 1.5;
    }
    .btn {
      display: inline-block;
      padding: 14px 28px;
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: var(--radius);
      cursor: pointer;
      font-size: 1rem;
      font-weight: 500;
      text-decoration: none;
      transition: background 0.3s ease;
    }
    .btn:hover {
      background: var(--primary-dark);
    }
    .checkmark {
      font-size: 3rem;
      color: #4caf50;
      margin-bottom: 15px;
      animation: scaleIn 0.6s ease;
    }
    @keyframes scaleIn {
      from { transform: scale(0.5); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="checkmark">✅</div>
      <h3>Instalación completada</h3>
      <p>La aplicación fue instalada correctamente.<br>El instalador ha sido deshabilitado.</p>

      <a href="/" class="btn">Ir al inicio</a>
    </div>
  </div>
</body>
</html>
