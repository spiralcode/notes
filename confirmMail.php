<?php
session_start();
?>
<!doctype html>
<html>
<head>
</head>
<body>
Confirm the e-mail,  <?php echo $_SESSION['email']; ?> , and proceed. 

A confirmation will be there in either Inbox / Junk / Spam folder of your email ( <?php echo $_SESSION['email']; ?>). Open the mail, and click the confirmation link. 
</body>
</html>