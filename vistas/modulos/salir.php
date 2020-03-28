<?php
$statusOnline = ControladorUsuarios::ctrOnlineStatus(0,$_SESSION["usuario"]);

session_destroy();

echo '<script>

	window.location = "./";

</script>';