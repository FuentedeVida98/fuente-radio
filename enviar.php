<?php
if (isset($_POST['submit'])){
    require 'PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host='smtp.api.createsend.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->Username='ef6f18b9-9f43-4682-8e66-c5485acc2920';
    $mail->Password='ef6f18b9-9f43-4682-8e66-c5485acc2920';

    $mail->setFrom('radio@fuentedevida.edu.gt',$_POST['nombre']);
    $mail->addAddress('radio@fuentedevida.edu.gt');
    $mail->addReplyTo($_POST['email'],$_POST['nombre']);

    $mail->isHTML(true);
    $mail->Subject='Enviado por '.$_POST['nombre'];
    $mail->Body='<h3>Nombre: </h3>'.$_POST['nombre'].'<br><h3>Email: </h3>'.$_POST['email'].'<br><h3>Mensaje: </h3>'.$_POST['mensaje'];
    $mail->CharSet = "UTF-8";

    if(!$mail->send()){
    echo "Error: {$mail->ErrorInfo}";
    }else{
        header('Location: index.html');
    }

}
?>