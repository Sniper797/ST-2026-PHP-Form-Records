# ST-2026 · PHP Form Records

A small PHP + MySQL web app: submit a **name** and **age** through a one-line form, store them in a MySQL database, and list every record in a table below the form — each row with a **toggle button** that flips its status between `0` and `1`. Third application task of the Smart Methods (ST 2026) training.

![The live form running on InfinityFree](docs/hero.png)

> 🔗 **Live site:** https://websitetest.infinityfree.io/page.html
> *(hosted free on [InfinityFree](https://infinityfree.com) — first load runs a JavaScript bot-check and reloads with `?i=1`; if you see a blank page, hard-refresh with `Ctrl+Shift+R` or disable your ad blocker for the domain)*

> ⚠️ **Status: in progress.** Steps 1–3 of the task are working (form → database). Steps 4–6 (records table, toggle button, live status update) are not built yet — see [Progress](#progress) below.

---

## 1. The task

From the Smart Methods brief:

| # | Requirement | Status |
|---|---|---|
| 1 | Design a webpage using HTML, CSS, JavaScript and PHP | 🟡 HTML + PHP done, CSS/JS pending |
| 2 | Create a **one-line** form with name, age and a submit button | 🟡 form works, not yet on one line |
| 3 | Store the submitted data in a MySQL table | ✅ done |
| 4 | Display all records from the table below the form | ⬜ not started |
| 5 | Add a toggle button per record to switch status between `0` and `1` | ⬜ not started |
| 6 | Reflect the updated status immediately on the page | ⬜ not started |

The target layout — a one-line form, then a table of records with a per-row toggle:

![Target layout from the task brief](docs/task-brief.png)

---

## 2. How it works

Three moving parts: a static HTML page holds the form, a PHP script receives the submission and writes to MySQL, and MySQL stores the rows.

```
page.html  ──submit (GET)──▶  InsertData.php  ──INSERT──▶  MySQL
   │                                                    (MyGuests)
   │                                                          │
   └──◀────────── (step 4: SelectData reads rows back) ───────┘
```

| Piece | Where it runs | Job |
|---|---|---|
| `page.html` | browser | the form — collects `name` and `age` |
| `InsertData.php` | InfinityFree server | reads `$_GET`, runs the `INSERT` |
| `db.php` | InfinityFree server | holds the connection credentials |
| MySQL `MyGuests` | InfinityFree server | stores `id`, `name`, `age` (`status` still to add) |

---

## 3. Building it

### The form

`page.html` is plain HTML — two text inputs and a submit button, posting to `InsertData.php` over `GET`. The placeholders are in Arabic (`ادخل اسمك` / `ادخل عمرك`) since the page is for an Arabic-speaking user.

### The database connection

Credentials live in their own file, `db.php`, which is **git-ignored** — a public repo must never carry a live database password. The repo ships [`db.example.php`](db.example.php) instead: copy it to `db.php`, fill in the four values from the InfinityFree panel (**MySQL Databases** → hostname, username, password, database name), and upload it alongside the other files.

```php
require 'db.php';   // gives us $conn, already connected
```

### Hosting

Everything is uploaded through the InfinityFree **File Manager** into the `htdocs/` directory, which is the web root for `websitetest.infinityfree.io`.

![InfinityFree file manager showing the uploaded files in htdocs](docs/file-manager.png)

---

## 4. Notes & trade-offs

Honest list of what's rough, so it's clear these are known and not overlooked:

- **The form uses `GET`, not `POST`.** That puts the submitted name and age in the URL. `POST` is the correct verb for a request that writes to a database — worth switching.
- **The query is built by string interpolation**, so it's open to SQL injection. `$conn->prepare()` with bound parameters is the fix.
- **No `status` column yet.** Steps 5 and 6 need one — `ALTER TABLE MyGuests ADD status TINYINT(1) NOT NULL DEFAULT 0;`
- **No input validation.** An empty submit inserts an empty row.
- **No CSS.** The page is unstyled browser default; step 1 asks for CSS.

---

## Progress

- [x] Set up free hosting + MySQL database on InfinityFree
- [x] Build the HTML form (`page.html`)
- [x] Write the insert script (`InsertData.php`) and confirm rows land in MySQL
- [x] Move credentials out of the committed code (`db.php` / `db.example.php`)
- [ ] Put the form on a single line + add CSS
- [ ] Add the `status` column to `MyGuests`
- [ ] Build `SelectData.php` to list all records in a table
- [ ] Add the per-row toggle button and update the status live

---

## Repository contents

| File | What it is |
|---|---|
| [`page.html`](page.html) | the form page — name, age, submit |
| [`InsertData.php`](InsertData.php) | receives the submission and inserts it into MySQL |
| [`db.example.php`](db.example.php) | credential template — copy to `db.php` and fill in |
| `db.php` | **not in the repo** (git-ignored) — your real credentials |
| [`.gitignore`](.gitignore) | keeps `db.php` out of version control |
| `docs/` | screenshots used in this README |

---

## Key specs

| | |
|---|---|
| Stack | HTML · PHP 8 · MySQL (MariaDB) |
| Host | InfinityFree — `websitetest.infinityfree.io` |
| Web root | `htdocs/` |
| Database | `if0_42446707_myfrist`, table `MyGuests` |
| Columns | `id` (AUTO_INCREMENT), `name`, `age` |

---

## Credits & references

- **Task brief** — Smart Methods (الأساليب الذكية) ST 2026 summer training
- **Hosting & MySQL** — [InfinityFree](https://infinityfree.com)
- **PHP/MySQL reference** — [W3Schools · PHP MySQL Insert Data](https://www.w3schools.com/php/php_mysql_insert.asp) and [Select Data](https://www.w3schools.com/php/php_mysql_select.asp)
