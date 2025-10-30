@echo off
echo 🚀 Iniciando Sistema POS con Docker...
echo.

:: Verificar Docker
docker --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ ERROR: Docker no esta instalado.
    echo 📥 Descarga desde: https://www.docker.com/get-started
    pause
    exit /b 1
)

echo ✅ Docker esta instalado
echo 🏗️  Iniciando sistema...

:: Limpiar contenedores previos
echo 🧹 Limpiando contenedores anteriores...
docker-compose down

:: Copiar configuración
if not exist ".env" (
    copy ".env.docker" ".env"
    echo 📝 Archivo .env creado
)

:: Iniciar servicios
echo ⚡ Iniciando contenedores...
docker-compose up --build -d

echo ⏳ Esperando inicialización (90 segundos)...
timeout /t 90 /nobreak

:: Verificar servicios
echo 🔍 Verificando servicios...
docker-compose ps

:: Verificar base de datos
echo 🗃️  Verificando base de datos...
docker-compose exec database mysql -u root -prootpassword -e "SHOW DATABASES;" 2>nul
if %errorlevel% equ 0 (
    echo ✅ Base de datos funcionando
) else (
    echo ❌ Problema con la base de datos
    goto :error
)

:: Configurar Laravel
echo ⚙️  Configurando Laravel...
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear

:: Verificar conexión desde Laravel
echo 🔌 Probando conexión Laravel...
docker-compose exec app php artisan tinker --execute="try { DB::connection()->getPdo(); echo '✅ Conexión exitosa a BD'; } catch (Exception \$e) { echo '❌ Error: ' . \$e->getMessage(); }"

echo.
echo 🎉 ¡SISTEMA LISTO!
echo.
echo 🌐 URL: http://localhost:8080
echo 🔑 Admin: administrador@gmail.com / password
echo 🔑 Vendedor: jhared@gmail.com / password
echo.
echo 📊 BD: localhost:3308 (usuario: root, password: rootpassword)
echo.
pause
exit /b 0

:error
echo.
echo ❌ Hubo un error. Revisa los logs:
echo docker-compose logs database
echo docker-compose logs app
echo.
pause