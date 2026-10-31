from common import get_driver, pause, admin_login, add_trip

driver = get_driver()
try:
    admin_login(driver)
    add_trip(driver)
    pause(2)
finally:
    driver.quit()
