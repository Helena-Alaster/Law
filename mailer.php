<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из выпадающего меню
    $service = htmlspecialchars($_POST['service']);
    
    // Получаем email пользователя (если добавили такое поле)
    $user_email = htmlspecialchars($_POST['email']);
    
    // Переводим технические значения обратно в текст для красивого письма
    $services_list = [
        'consultation' => 'Консультация',
        'audit' => 'Аудит проекта',
        'development' => 'Разработка'
    ];
    $service_name = isset($services_list[$service]) ? $services_list[$service] : $service;

    $to = "huaqella@gmail.com"; /* Ваша почта */
    $subject = "Новая заявка с сайта";
    
    // Формируем тело письма
    $message = "Пользователь оставил заявку:\n\n";
    $message .= "Услуга: " . $service_name . "\n";
    $message .= "Email для связи: " . $user_email . "\n";
    
    $headers = "From: no-reply@yourdomain.ru\r\n" .
               "Reply-To: " . $user_email . "\r\n" .
               "Content-type: text/plain; charset=utf-8\r\n";

    if(mail($to, $subject, $message, $headers)) {
        echo "Заявка успешно отправлена!";
    } else {
        echo "Ошибка при отправке.";
    }
}
?>