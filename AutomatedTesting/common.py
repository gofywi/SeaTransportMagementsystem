import time
from selenium import webdriver
from selenium.webdriver.common.by import By

BASE_URL = "http://localhost/Ass1"
ADMIN_USER = "admin"
ADMIN_PASS = "admin123"

NEW_TRIP = {
    "boat": "Goundar Shipping - Lomaiviti Princess V",
    "from": "Suva",
    "to": "Levuka (Ovalau)",
    "date": "2026-12-20",
    "time": "10:30",
    "price": "55",
    "seats": "350",
}
EDITED_TRIP = {"boat": "Patterson Brothers - Island Express", "price": "60", "seats": "280"}

LAST_TRIP_ROW = "(//table)[1]//tr[last()]"


def get_driver():
    driver = webdriver.Chrome()
    driver.maximize_window()
    driver.implicitly_wait(5)
    return driver


def pause(sec=1):
    time.sleep(sec)


def admin_login(driver):
    driver.get(f"{BASE_URL}/views/login.php")
    driver.find_element(By.NAME, "username").send_keys(ADMIN_USER)
    driver.find_element(By.NAME, "password").send_keys(ADMIN_PASS)
    pause()
    driver.find_element(By.CSS_SELECTOR, "button[type=submit]").click()
    assert "admin.php" in driver.current_url, "Login failed"
    assert "Admin Console" in driver.page_source
    print("PASS: Admin login")


def add_trip(driver):
    driver.get(f"{BASE_URL}/views/admin.php")
    for field, value in NEW_TRIP.items():
        el = driver.find_element(By.NAME, field)
        if field in ("date", "time"):
            driver.execute_script("arguments[0].value = arguments[1];", el, value)
        else:
            el.clear()
            el.send_keys(value)
    pause()
    driver.find_element(By.CSS_SELECTOR, "button[type=submit]").click()
    pause()
    assert "msg=saved" in driver.current_url, "Trip not saved"
    last_row = driver.find_element(By.XPATH, LAST_TRIP_ROW).text
    assert NEW_TRIP["boat"] in last_row, "New trip not in table"
    print("PASS: Add new trip ->", last_row)


def edit_last_trip(driver):
    driver.get(f"{BASE_URL}/views/admin.php")
    driver.find_element(By.XPATH, LAST_TRIP_ROW + "//a[text()='Edit']").click()
    assert "edit=" in driver.current_url
    for field, value in EDITED_TRIP.items():
        el = driver.find_element(By.NAME, field)
        el.clear()
        el.send_keys(value)
    pause()
    driver.find_element(By.CSS_SELECTOR, "button[type=submit]").click()
    last_row = driver.find_element(By.XPATH, LAST_TRIP_ROW).text
    assert EDITED_TRIP["boat"] in last_row, "Trip not updated"
    print("PASS: Edit last trip ->", last_row)


def delete_last_trip(driver):
    driver.get(f"{BASE_URL}/views/admin.php")
    row = driver.find_element(By.XPATH, LAST_TRIP_ROW)
    trip_id = row.find_element(By.XPATH, "./td[1]").text
    row.find_element(By.XPATH, ".//a[text()='Delete']").click()
    driver.switch_to.alert.accept()
    pause()
    assert "msg=deleted" in driver.current_url, "Trip not deleted"
    ids = [td.text for td in driver.find_elements(By.XPATH, "(//table)[1]//tr/td[1]")]
    assert trip_id not in ids, "Trip still in table"
    print(f"PASS: Delete last trip (ID {trip_id})")


def admin_logout(driver):
    driver.get(f"{BASE_URL}/views/admin.php")
    driver.find_element(By.LINK_TEXT, "Logout").click()
    pause()
    assert "home.php" in driver.current_url, "Logout did not go to home page"
    driver.get(f"{BASE_URL}/views/admin.php")
    assert "login.php" in driver.current_url, "Still logged in after logout"
    print("PASS: Admin logout")
