<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key  = '464600459:AAHwZtlB9YJDAoC3L9hlb0n7_iETIi6n1nc';
$bot_username = 'perstick_bot';
$hook_url = 'https://alistorm.ru/stickers';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Set webhook
    $result = $telegram->setWebhook($hook_url);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    // echo $e->getMessage();
}