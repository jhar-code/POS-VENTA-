<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instalador - Paso 1</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #1976d2;
      --primary-dark: #115293;
      --bg: #f4f6f9;
      --text: #333;
      --error: #d32f2f;
      --success: #388e3c;
      --radius: 10px;
      --shadow: 0 4px 20px rgba(0,0,0,0.08);
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
      align-items: flex-start;
      padding: 60px 20px;
    }
    .card {
      background: #fff;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      width: 100%;
      max-width: 900px;
      overflow: hidden;
      animation: fadeIn 0.6s ease;
    }
    @keyframes fadeIn {
      from {opacity:0; transform: translateY(15px);}
      to {opacity:1; transform: translateY(0);}
    }
    .card-header {
      background: var(--primary);
      color: #fff;
      padding: 25px;
    }
    .card-header h2 {
      margin: 0;
      font-weight: 500;
    }
    .progress-bar {
      background: rgba(255,255,255,0.2);
      height: 5px;
      margin-top: 15px;
      border-radius: 50px;
      overflow: hidden;
    }
    .progress-bar div {
      width: 33%;
      height: 100%;
      background: #fff;
    }
    .card-body {
      padding: 30px;
    }
    h3 {
      margin-top: 0;
      font-weight: 500;
      font-size: 1.2rem;
    }
    .requirements {
      list-style: none;
      padding: 0;
      margin: 0 0 25px 0;
    }
    .requirements li {
      padding: 10px;
      border: 1px solid #eee;
      border-radius: var(--radius);
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 0.95rem;
    }
    .badge {
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 500;
      color: #fff;
    }
    .badge.success { background: var(--success); }
    .badge.error { background: var(--error); }
    form {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
      gap: 20px;
    }
    .form-group {
      position: relative;
    }
    .form-group input {
      width: 100%;
      padding: 14px 12px 6px;
      border: none;
      border-bottom: 2px solid #ccc;
      font-size: 1rem;
      outline: none;
      background: transparent;
      transition: border-color 0.3s;
    }
    .form-group input:focus {
      border-color: var(--primary);
    }
    .form-group label {
      position: absolute;
      top: 14px;
      left: 12px;
      font-size: 1rem;
      color: #777;
      pointer-events: none;
      transition: all 0.2s ease;
    }
    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label {
      top: -8px;
      left: 10px;
      font-size: 0.8rem;
      color: var(--primary);
      background: #fff;
      padding: 0 4px;
    }
    .form-section {
      grid-column: 1 / -1;
      margin-top: 25px;
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
      position: relative;
      overflow: hidden;
      transition: background 0.3s;
    }
    .btn:hover {
      background: var(--primary-dark);
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
      to {transform: scale(4); opacity: 0;}
    }
    .alert {
      grid-column: 1 / -1;
      padding: 15px;
      border-radius: var(--radius);
      font-size: 0.9rem;
      margin-bottom: 15px;
      background: #fdecea;
      color: var(--error);
    }
    .actions {
      grid-column: 1 / -1;
      text-align: right;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h2>Instalador - Paso 1</h2>
        <p>Requisitos y configuración inicial</p>
        <div class="progress-bar"><div></div></div>
      </div>
      <div class="card-body">

        <h3>Requisitos del servidor</h3>
        <ul class="requirements">
          <li>
            PHP 
            <span class="badge {{ version_compare($requirements['php_version'], '8.0', '>=') ? 'success' : 'error' }}">
              {{ $requirements['php_version'] }}
            </span>
          </li>
          @foreach ($requirements['extensions'] as $ext => $ok)
            <li>
              {{ $ext }}
              <span class="badge {{ $ok ? 'success' : 'error' }}">
                {{ $ok ? 'OK' : 'Falta' }}
              </span>
            </li>
          @endforeach
          @foreach ($requirements['writable'] as $path => $ok)
            <li>
              {{ $path }} escribible
              <span class="badge {{ $ok ? 'success' : 'error' }}">
                {{ $ok ? 'OK' : 'No escribible' }}
              </span>
            </li>
          @endforeach
        </ul>

        @if ($errors->any())
          <div class="alert">
            ⚠️ {{ $errors->first() }}
          </div>
        @endif

        <form action="{{ route('installer.database') }}" method="POST">
          @csrf

          <!-- Configuración DB -->
          <div class="form-section"><h3>Configuración de Base de Datos</h3></div>
          <div class="form-group">
            <input type="text" name="db_host" placeholder=" " value="{{ old('db_host', '127.0.0.1') }}" required>
            <label>DB Host</label>
          </div>
          <div class="form-group">
            <input type="text" name="db_port" placeholder=" " value="{{ old('db_port', 3306) }}" required>
            <label>DB Port</label>
          </div>
          <div class="form-group">
            <input type="text" name="db_database" placeholder=" " value="{{ old('db_database', 'laravel') }}" required>
            <label>DB Name</label>
          </div>
          <div class="form-group">
            <input type="text" name="db_username" placeholder=" " value="{{ old('db_username', 'root') }}" required>
            <label>DB User</label>
          </div>
          <div class="form-group">
            <input type="password" name="db_password" placeholder=" ">
            <label>DB Password</label>
          </div>

          <!-- Admin -->
          <div class="form-section"><h3>Cuenta Administrador</h3></div>
          <div class="form-group">
            <input type="text" name="admin_name" placeholder=" " value="{{ old('admin_name') }}" required>
            <label>Nombre</label>
          </div>
          <div class="form-group">
            <input type="email" name="admin_email" placeholder=" " value="{{ old('admin_email') }}" required>
            <label>Email</label>
          </div>
          <div class="form-group">
            <input type="password" name="admin_password" placeholder=" " required>
            <label>Contraseña</label>
          </div>
          <div class="form-group">
            <input type="password" name="admin_password_confirmation" placeholder=" " required>
            <label>Confirmar contraseña</label>
          </div>

          <div class="actions">
            <button class="btn">Guardar y continuar →</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</body>
</html>
