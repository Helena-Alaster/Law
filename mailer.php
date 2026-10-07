<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    
    // Собираем выбранные пункты
    $services = isset($_POST['services']) ? implode(", ", $_POST['services']) : "Не выбраны";

    $to = "huaqella@gmail.com"; // Сюда придет письмо
    $subject = "Заявка с сайта от " . $name;
    
    $message = "Имя: " . $name . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Услуги: " . $services;
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    // Отправка
    if (mail($to, $subject, $message, $headers)) {
        // Переадресация на страницу благодарности
        header("Location: thanks.html");
        exit();
    } else {
        echo "Ошибка отправки. Попробуйте позже.";
    }
}
?>
