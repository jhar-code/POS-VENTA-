<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Instalando...</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #1976d2;
      --primary-dark: #115293;
      --bg: #f4f6f9;
      --text: #333;
      --success: #388e3c;
      --radius: 12px;
      --shadow: 0 6px 20px rgba(0,0,0,0.08);
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
      max-width: 600px;
      width: 100%;
      padding: 40px 30px;
      text-align: center;
      animation: fadeIn 0.5s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    h4 {
      margin: 0 0 15px;
      font-weight: 500;
      color: var(--primary-dark);
      font-size: 1.4rem;
    }
    p {
      margin: 0 0 30px;
      font-size: 1rem;
      color: #555;
    }
    .btn {
      display: inline-block;
      padding: 14px 28px;
      background: var(--success);
      color: #fff;
      border: none;
      border-radius: var(--radius);
      cursor: pointer;
      font-size: 1rem;
      font-weight: 500;
      position: relative;
      overflow: hidden;
      transition: background 0.3s;
    }
    .btn:hover {
      background: #2e7d32;
    }
    .btn:after {
      content: "";
      position: absolute;
      background: rgba(255,255,255,0.5);
      border-radius: 50%;
      transform: scale(0);
      width: 100px;
      height: 100px;
      top: 50%;
      left: 50%;
      pointer-events: none;
      animation: ripple 0.6s linear;
      opacity: 0;
    }
    .btn:active:after {
      transform: scale(3);
      opacity: 1;
      transition: transform 0.6s, opacity 1s;
    }
    @keyframes ripple {
      to { transform: scale(4); opacity: 0; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <h4>✅ Listo para instalar</h4>
      <p>Se generará la <strong>APP_KEY</strong>, se ejecutarán las migraciones y se creará la cuenta administrador.</p>

      <form action="{{ route('installer.run') }}" method="POST">
        @csrf
        <button class="btn">Iniciar instalación</button>
      </form>
    </div>
  </div>
</body>
</html>
