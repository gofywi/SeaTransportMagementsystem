# Sea Transport Management System

A simple PHP web app for viewing boat trips and booking tickets. Admins can log in to add, edit, and delete trips. Data is saved in JSON files, so no database setup is needed.

## Run the web app

1. Install XAMPP and place this project in `C:\xampp\htdocs\Ass1`.
2. Open the XAMPP Control Panel and start **Apache**.
3. Open [http://localhost/Ass1/](http://localhost/Ass1/) in your browser.
4. View available trips and click **Book** to make a booking.

For the admin page, open [http://localhost/Ass1/Views/login.php](http://localhost/Ass1/Views/login.php).

- Username: `admin`
- Test password: `admin123`

## Run the Python automated tests

Install Python and Google Chrome. Keep Apache running, then open a terminal in the project folder.

Install Selenium:

```powershell
py -m pip install selenium
```

Run the admin tests (login, add trip, edit trip, delete trip, and logout):

```powershell
py AutomatedTesting/master_admin_test.py
```

Run the booking test:

```powershell
py AutomatedTesting/test_booking.py
```

Chrome opens automatically. Look for `PASS` messages in the terminal. The first run may need internet access to download the Chrome driver.

The tests use `http://localhost/Ass1`. If your folder or address is different, update `BASE_URL` in `AutomatedTesting/common.py`. The booking test needs at least one available trip and creates a real test booking in the local JSON data.

## Project folders

- `Views/` — web pages.
- `php/` — login, trip, and booking logic.
- `data/` — trips and bookings saved as JSON.
- `AutomatedTesting/` — Python Selenium tests.
