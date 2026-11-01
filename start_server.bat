@echo off
title SILKY & SIP - Laravel Server
echo ========================================================
echo         SILKY & SIP - Artisanal Indulgence
echo         Praktikum E-Commerce - Kelompok 4
echo ========================================================
echo.
echo Menjalankan Laravel Development Server...
echo Buka browser di: http://127.0.0.1:8000
echo.
echo Tekan Ctrl+C untuk menghentikan server.
echo ========================================================
echo.

"C:\xampp\php\php.exe" artisan serve --host=127.0.0.1 --port=8000
pause

