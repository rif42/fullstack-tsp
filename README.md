# Fullstack Engineer Test for TSP

## Instalasi
### Pre-requisite
- install PHP dan Composer menggunakan command dibawah ([source](https://laravel.com/docs/11.x/installation))
```
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.4'))
```

### Clone dan Install Packages
- buka vscode, buat folder baru dan buka folder di dalam vscode
- clone repository ini di dalam folder tersebut
- jalankan ```composer install``` untuk menginstall depedency dari laravel
- jalankan ```bun install``` untuk menginstall depedency frontend

### Database Setup
- nyalakan service mysql, direkomendasikan untuk menggunakan [laragon](https://laragon.org/download/)
- buat mysql database dengan nama sesuai seperti di directory (tsp_test), jalankan command ini di terminal  
```mysql -u root -p -e "CREATE DATABASE tsp_test;```  
- setelah database dibuat, import file sql ke database, jalankan command ini  
```mysql -u root -p tsp_test < tsp_test.sql```  
- buat file `.env` di directory, isi dengan data ini  
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tsp_test
DB_USERNAME=root
DB_PASSWORD=
```
- setelah selesai, jalankan migrasi dengan command
```php artisan migrate:fresh --seed```

### Jalankan aplikasi
- buat terminal baru
- jalankan `bun run dev` untuk menjalankan server frontend
- buat terminal baru lagi
- jalankan `php artisan serve` untuk menjalankan server backend
- pastikan service database masih aktif
- buka `http://127.0.0.1:8000` di browser
