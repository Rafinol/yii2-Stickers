<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key  = '464600459:AAHwZtlB9YJDAoC3L9hlb0n7_iETIi6n1nc';
$bot_username = 'perstick_bot';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e->getMessage();
}