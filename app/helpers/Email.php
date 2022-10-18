<?php

namespace Helper;

class Email
{
    static function send($TO, $Subject, $Body)
    {
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host   = EMAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = EMAIL_USERNAME;
            $mail->Password   = EMAIL_PASSWORD;
            $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port   = 587;
            $mail->setFrom(EMAIL_USERNAME, EMAIL_NAME);
            $mail->addReplyTo(EMAIL_USERNAME, EMAIL_NAME);
            $mail->addAddress($TO);
            $mail->isHTML(false);
            $mail->Subject = "[lighter] " . $Subject;
            $mail->Body = $Body;
            $mail->AltBody = \Soundasleep\Html2Text::convert($Body, ['ignore_errors' => true]);
            $mail->addCustomHeader("List-Unsubscribe", '<support@lighter.io>, <https://lighter.io/?Unsubscribe=' . $TO . '>');
            // $mail->AddEmbeddedImage('/home/admin/web/lighter.io/public_html/assets/img/icon.png', 'icon');

            return $mail->send();
        } catch (\Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}