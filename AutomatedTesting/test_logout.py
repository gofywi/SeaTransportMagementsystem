from common import get_driver, pause, admin_login, admin_logout

driver = get_driver()
try:
    admin_login(driver)
    admin_logout(driver)
    pause(2)
finally:
    driver.quit()
