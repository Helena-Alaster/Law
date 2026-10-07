<?php
// Разрешаем кириллицу и корректную работу с JSON
header('Content-Type: application/json; charset=utf-8');

// Проверяем, пришел ли POST-запрос
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method Not Allowed"]);
    exit;
}

// Функция для очистки данных (защита от инъекций)
function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Получаем данные из формы (замените name="name" на свои атрибуты из HTML)
$name = clean($_POST['name']) ?? 'Не указано';
$phone = clean($_POST['service']) ?? 'Не указан';
$email = clean($_POST['email']) || 'Не указан';
$message = clean($_POST['message']) || 'Пустое сообщение';

// Куда присылать письма
$to = "huaqella@gmail.com"; // ВАША ПОЧТА
$subject = "Новое обращение с сайта (Юрист)";

// Формируем тело письма
$email_body = "Вы получили новое сообщение с сайта:\n\n";
$email_body .= "Имя: " . $name . "\n";
$email_body .= "услуги: " . $phone . "\n";
$email_body .= "Email: " . $email . "\n\n";
$email_body .= "Сообщение:\n" . $message . "\n";

// Заголовки для корректной кодировки
$headers = "From: no-reply@" . $_SERVER['HTTP_HOST'] . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";

// Попытка отправить письмо
if (mail($to, $subject, $email_body, $headers)) {
    echo json_encode(["status" => "success", "message" => "Спасибо! Ваше сообщение отправлено."]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Ошибка сервера. Попробуйте позже или позвоните нам."]);
}
?>
