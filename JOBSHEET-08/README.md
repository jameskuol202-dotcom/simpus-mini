# SIMPUS-Mini — Jobsheet 8 (PostgreSQL Connection)

Book and member data now live in a PostgreSQL database instead of `$_SESSION`.

## What's new
- `sql/01_books_members.sql` — schema for the `books` and `members` tables
- `includes/connection.php` — PDO connection to PostgreSQL
- `book/process_add.php`, `amember/process_add.php` — `INSERT ... RETURNING id` via prepared statements
- `book/list.php`, `amember/list.php` — `SELECT * ... ORDER BY id DESC`
- `index.php` — Total Books/Members cards from `SELECT COUNT(*)`
- Duplicate member IDs show a flash message instead of a raw error (exercise 7.4 #1)

## Setup
1. Make sure PostgreSQL is running and `pdo_pgsql` is enabled (`php -m | findstr pgsql`).
2. Create the database: `createdb -U postgres simpus_mini`
3. Load the schema: `psql -U postgres -d simpus_mini -f sql/01_books_members.sql`
4. Adjust `$user` / `$pass` in `includes/connection.php` if needed.
5. Run `php -S localhost:8000` in this folder and open http://localhost:8000/index.php

## Notes
- Queries with user input use prepared statements (`:placeholder`), never string concatenation.
- The `id` column is fetched but not displayed yet; it will be used for Edit/Delete in Jobsheet 9.
