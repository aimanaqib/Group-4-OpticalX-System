<?php include("connection.php"); ?>
<!DOCTYPE html>
<html>

<head><title>Logout</title>

<script type="text/javascript">

	setTimeout("window.location='admin_login.php';");
	
	history.forward();
 
</script>

</head>

<body>
<?php

session_destroy();
?>
</body>

</html>

