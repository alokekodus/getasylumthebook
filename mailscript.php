<?php

if (isset($_POST['email'])) {

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
   }

   $to = $_POST['email'];
   $subject = "Pre Subscribe Form";
   
   sendMail($to, $subject);
} else {
   $return['msgType'] = false;
   $return['msg'] = "Something went wrong!";
   echo json_encode($return);
}

// Function form mail send
function sendMail($to, $subject)
{
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

   $mail->AddAddress("getasylumthebook@gmail.com", "Get Asylum The Book");
   $mail->SetFrom($to, "Get Asylum The Book");
   $mail->AddReplyTo($to, $_POST["name"]);

   $mail->IsHTML(true);

   $message = "Name: " . check_input($_POST["fname"]) . " " . check_input($_POST["lname"]) . "<br/>";
   $message .= "Country: " . check_input($_POST["country"]) . "<br/>";
   $message .= "Email: " . check_input($_POST["email"]) . "<br/>";
   $message .= "Phone Number: " . check_input($_POST["phone"]) . "<br/>";
   $message .= "Message: " . check_input($_POST["comment"]) . "<br/>";

   $mail->Subject = $subject;
   $mail->Body = $message;

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
