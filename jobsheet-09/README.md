# SIMPUS-Mini — Basic PHP & Form Handling

The application moves from static HTML/JS to PHP running on a server.

## What's new
1. All `.html` pages are converted to `.php`.
2. `includes/header.php` and `includes/footer.php` remove the duplicated navbar/footer via `include`.
3. CSS/JS/menu paths are calculated automatically through `$base`, so they work at any folder depth.
4. The Add Book/Add Member forms now `POST` to `proses_tambah.php`.
5. `proses_tambah.php` validates on the server, stores the data in `$_SESSION`, then redirects.
6. `list.php` renders the table from `$_SESSION` (no more fetch/JSON).
7. Flash messages: a success/failure message shown once after a redirect.
8. `buku.js`, `anggota.js` and the `data/` folder are removed; rendering happens on the server.

## Exercises
- **7.4 #1:** `buku/proses_tambah.php` checks that the ISBN (if filled) contains only digits and hyphens using `preg_match()`.
- **7.4 #2:** `anggota/proses_tambah.php` validates NIM (5–15 digits, not already registered), name, email format and phone, each with a flash message.

## Running
```
php -S localhost:8000
```
Run it from this folder, then open http://localhost:8000/index.php (Laragon works too).

> Note: `$_SESSION` data is temporary and disappears when the browser session ends.
> Jobsheet 8 moves the data to a PostgreSQL database.
