<?php

// Check inputs if empty
if (empty($_POST['fname'])) {
   $return['msgType'] = false;
   $return['msg'] = "Please enter first name";
   echo json_encode($return);
} else if (empty($_POST['lname'])) {
   $return['msgType'] = false;
   $return['msg'] = "Please enter last name";
   echo json_encode($return);
} else if (empty($_POST['country'])) {
   $return['msgType'] = false;
   $return['msg'] = "Please enter your country name";
   echo json_encode($return);
} else if (empty($_POST['email'])) {
   $return['msgType'] = false;
   $return['msg'] = "Please enter your email";
   echo json_encode($return);
} else {
   // Send mail
   require("mail/class.phpmailer.php");

   $mail = new PHPMailer();
   $mail->IsSMTP();
   $mail->IsSMTP();
   $mail->Mailer = "smtp";

   $mail->SMTPDebug  = 1;
   $mail->SMTPAuth   = true;
   $mail->SMTPSecure = "ssl";
   $mail->Port       = 465;
   $mail->Host       = "mail.ekodusproject.tech";
   $mail->Username = "noreply@ekodusproject.tech";
   $mail->Password = "Developer@123";

   $mail->AddAddress("getasylumthebook@gmail.com", "Pre Order");
   $mail->SetFrom($_POST["email"], $_POST["name"]);
   $mail->AddReplyTo($_POST["email"], $_POST["name"]);

   $mail->IsHTML(true);

   $MESSAGE_BODY = "Name: " . check_input($_POST["fname"]) . " " . check_input($_POST["lname"]) . "<br/>";
   $MESSAGE_BODY .= "Country: " . check_input($_POST["country"]) . "<br/>";
   $MESSAGE_BODY .= "Email: " . check_input($_POST["email"]) . "<br/>";
   $MESSAGE_BODY .= "Phone Number: " . check_input($_POST["phone"]) . "<br/>";
   $MESSAGE_BODY .= "Message: " . check_input($_POST["comment"]) . "<br/>";

   $mail->Subject = "Pre Subscribe Form";
   $mail->Body = $MESSAGE_BODY;

   if (!$mail->Send()) {
      $return['msgType'] = false;
      $return['msg'] = $mail->ErrorInfo;
      echo json_encode($return);
   } else {
      $return['msgType'] = true;
      $return['msg'] = "Thank you for subscribe";
      echo json_encode($return);
   }

   function check_input($data)
   {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }
}
