from common import get_driver, pause, admin_login, add_trip, edit_last_trip, delete_last_trip, admin_logout

driver = get_driver()
try:
    print("=== Master Admin Test ===")
    admin_login(driver)
    pause()
    add_trip(driver)
    pause()
    edit_last_trip(driver)
    pause()
    delete_last_trip(driver)
    pause()
    admin_logout(driver)
    print("=== ALL ADMIN TESTS PASSED ===")
    pause(2)
except AssertionError as err:
    print("FAIL:", err)
    raise
finally:
    driver.quit()
