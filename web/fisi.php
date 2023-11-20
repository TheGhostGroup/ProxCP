<?php

if (php_sapi_name() == "cli") {
    require_once "core/init.php";
    require_once "lilib/proxcp_lilib_c.php";
    require_once "lilib/proxcp_lilib_f.php";
    if ($GLOBALS["config"]["instance"]["installed"]) {
        $connection = mysqli_connect($GLOBALS["config"]["database"]["host"], $GLOBALS["config"]["database"]["username"], $GLOBALS["config"]["database"]["password"]);
        mysqli_select_db($connection, $GLOBALS["config"]["database"]["db"]);
        $l_array = get_license_info($connection, 1);
        if ($l_array["notification_case"] != "notification_license_ok") {
            mysqli_close($connection);
            exit("License check failed: " . $l_array["notification_text"]);
        }
        mysqli_close($connection);
        echo "License check successful.";
    }
}

?>
