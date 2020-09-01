<?php
use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

$botman = resolve('botman');

//DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

// Create BotMan instance
//$botman = BotManFactory::create($config);


$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('My First', function ($bot) {
    $bot->reply('Your First Response');
});

$botman->hears('Look for {name}', function ($bot, $name) {
    $bot->reply('The product name: '.$name);
});


$botman->group(['driver' => [SlackDriver::class, FacebookDriver::class]], function($bot) {
    $bot->hears('keyword', function($bot) {
        // Only listens on Slack or Facebook
    });
});