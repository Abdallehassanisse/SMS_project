<?php
session_start();
session_unset(); // Masax dhamaan variable-ada session-ka
session_destroy(); // Baabi'i session-ka gebi ahaanba

header("location: login.php");
exit();
?>