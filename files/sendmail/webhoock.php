<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Отримайте значення UTM-міток та інших полів з форми
    $utm_source = $_POST['utm_source'];
    $utm_medium = $_POST['utm_medium'];
    $utm_campaign = $_POST['utm_campaign'];
    $utm_content = $_POST['utm_content'];
    $utm_term = $_POST['utm_term'];
    $name = $_POST['email'];
    $phone = $_POST['phone'];

    // Визначте URL вебхука
    $webhook_url = 'https://hook.eu1.make.com/jpxlhyoc34drxai6gmyvmlsganhg2y91';

    // Створіть асоціативний масив з даними UTM та іншими полями
    $data = array(
        'utm_source' => $utm_source,
        'utm_medium' => $utm_medium,
        'utm_campaign' => $utm_campaign,
        'utm_content' => $utm_content,
        'utm_term' => $utm_term,
        'name' => $name,
        'phone' => $phone,
    );

    // Відправте POST-запит на URL вебхука з даними
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Перевірте, чи був запит успішним
    if ($response) {
        header('Location: thanks.html');
        exit;
    } else {
        echo 'Помилка при відправці даних.';
    }
}
?>
