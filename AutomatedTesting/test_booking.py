from selenium.webdriver.common.by import By
from common import get_driver, pause, BASE_URL

driver = get_driver()
try:
    driver.get(f"{BASE_URL}/views/home.php")
    book_links = driver.find_elements(By.LINK_TEXT, "Book")
    assert book_links, "No trips available to book"
    pause()
    book_links[0].click()
    assert "booking.php" in driver.current_url
    print("PASS: Trip selected")

    driver.find_element(By.NAME, "name").send_keys("Sudarshan Prasad")
    driver.find_element(By.NAME, "email").send_keys("sp@gmai.com")
    driver.find_element(By.NAME, "phone").send_keys("+679 9123456")
    qty = driver.find_element(By.NAME, "passengers")
    qty.clear()
    qty.send_keys("2")
    pause()
    driver.find_element(By.CSS_SELECTOR, "button[type=submit]").click()

    assert "confirm.php" in driver.current_url
    assert "Booking Confirmed!" in driver.page_source
    print("PASS: Booking created ->", driver.current_url.split("ref=")[-1])
    pause(2)
finally:
    driver.quit()
