<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['kirim'])) {
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'aksarajepara@gmail.com';
  $mail->Password = 'eytcvvdfvvtqqmtc';

  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  $mail->setFrom($_POST['email'], $_POST['telepon']);
  $mail->addAddress('aksarajepara@gmail.com');
  $mail->addReplyTo($_POST['email'], $_POST['telepon']);
  $mail->isHTML(true);
  $mail->Subject = $_POST['nama'];
  $mail->Body = $_POST['pesan'];
  $mail->send();

  echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Alert Berhasil</title>
            </head>
            <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Pesan Berhasil Dikirm',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    window.location.href = 'kontak.php';
                });
            </script>
            </body>
            </html>";
}
?>