from selenium.webdriver.common.by import By
from common import get_driver, pause, admin_login, BASE_URL

driver = get_driver()
try:
    driver.get(f"{BASE_URL}/views/login.php")
    driver.find_element(By.NAME, "username").send_keys("admin")
    driver.find_element(By.NAME, "password").send_keys("wrong")
    driver.find_element(By.CSS_SELECTOR, "button[type=submit]").click()
    pause()
    assert "Invalid username or password" in driver.page_source, "Error message not shown for wrong password"
    print("PASS: Invalid login rejected")
    pause()

    admin_login(driver)
    pause(2)
finally:
    driver.quit()
