<?php
require_once('helpers.php');

$is_auth = rand(0, 1);

$user_name = 'Триша';

$cards = [
    [
        'title' => 'Цитата',
        'type' => 'post-quote',
        'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
        'user_name' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg'
    ],
    [
        'title' => 'Игра престолов',
        'type' => 'post-text',
        'content' => '<b>Не могу дождаться начала финального сезона своего любимого сериала!</b> Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала!',
        'user_name' => 'Владик',
        'avatar' => 'userpic.jpg'
    ],
    [
        'title' => 'Наконец, обработал фотки!',
        'type' => 'post-photo',
        'content' => 'rock-medium.jpg',
        'user_name' => 'Виктор',
        'avatar' => 'userpic-mark.jpg'
    ],
    [
        'title' => 'Моя мечта',
        'type' => 'post-photo',
        'content' => 'coast-medium.jpg',
        'user_name' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg'
    ],
    [
        'title' => 'Лучшие курсы',
        'type' => 'post-link',
        'content' => 'www.htmlacademy.ru',
        'user_name' => 'Владик',
        'avatar' => 'userpic.jpg'
    ]
];

function cut_text (string $text, int $num_letters = 300): string {
    $text = esc($text);
    $num = mb_strlen($text);

    if ($num > $num_letters) {
        $words = explode(" ", $text);
        $words_letters = 0;

        foreach ($words as $value) {
          $words_letters += mb_strlen($value) + 1;
          $new_words;

          if ($words_letters >= $num_letters) {
              break;
          }

          $new_words[] = $value;
          $text = implode(" ", $new_words);
          $text .= "...";
        }
    }

    return $text;
}

function esc($str) {
	$text = htmlspecialchars($str);

	return $text;
}

$page_content = include_template('main.php', ['cards' => $cards]);
$layout_content = include_template('layout.php', [
	'content' => $page_content,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
	'title' => 'readme: популярное'
]);

print($layout_content);
?>
