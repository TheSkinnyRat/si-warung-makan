# SI Warung Makan - Source Code

![Preview Image](https://img.shields.io/github/last-commit/theskinnyrat/si-warung-makan?style=flat-square)
![Preview Image](https://img.shields.io/github/languages/count/theskinnyrat/si-warung-makan?style=flat-square)
![Preview Image](https://img.shields.io/github/languages/top/theskinnyrat/si-warung-makan?style=flat-square)

Program source code for SI Warung Makan Project [RPL B - 2021].
> ![Preview Image](https://github.com/theskinnyrat/si-warung-makan/raw/master/preview.png)

## Online Preview

 [[Coming Soon]](#online-preview)

## Used Technology

- [Laravel 8](https://laravel.com/) - Framework
- [PHP 8](https://www.php.net/releases/8.0/en.php) - Server Side Programming Language

## Part of this project

- [si-warung-makan-db](https://github.com/TheSkinnyRat/si-warung-makan-db) - Database
- [si-warung-makan-design](https://github.com/TheSkinnyRat/si-warung-makan-design) - Design

## Getting Started

1. Configure the [database](#part-of-this-project)
2. Download / clone this repository to your server or local server `(htdocs in xampp, /www folder, etc)`
3. Rename or copy `.env.example` to `.env`
4. Open `.env` file and configure according to your database
5. Open command line (cmd, power shell, etc)
6. Run `composer install`
7. Run `php artisan key:generate`
8. All set ~
9. You can try login to backend using `username: superadmin` and `password: superadmin`
10. Or you can directly insert data to user table using BCrypt as password encryptor. You can use [BCrypt generator tool](https://bcrypt-generator.com/) in online sites to encrypt your password!
11. Not work? [open issue](https://github.com/TheSkinnyRat/si-warung-makan/issues)

## To Do Lists

**Backend**
- Login
    - [x] ~~Login Super Admin~~
    - [x] ~~Login Admin~~
- Super Admin
    - [x] ~~CRUD User~~
    - [x] ~~CRUD Menu~~
    - [x] ~~CRUD Kategori~~
    - [x] ~~CRUD Status~~
    - [x] ~~CRUD Pelanggan~~
    - [x] ~~Manajemen Pesanan~~
    - [x] ~~Generate Laporan~~
- Admin
    - [x] ~~Manajemen Pesanan~~

**Frontend**
- [x] ~~Sistem Pendaftaran~~
- [x] ~~Sistem Pemesanan~~
- [x] ~~Status Pesanan~~

## Find a bug or something wrong ?
**[Open issue !](https://github.com/TheSkinnyRat/si-warung-makan/issues)**

## LICENSE

> [MIT License](https://github.com/TheSkinnyRat/si-warung-makan/blob/master/LICENSE)
