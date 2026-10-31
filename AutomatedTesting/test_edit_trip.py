from common import get_driver, pause, admin_login, edit_last_trip

driver = get_driver()
try:
    admin_login(driver)
    edit_last_trip(driver)
    pause(2)
finally:
    driver.quit()
