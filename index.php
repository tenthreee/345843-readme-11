<?php
require_once('helpers.php');

date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'ru_RU');

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
        'content' => 'Не могу дождаться начала финального сезона своего любимого сериала!',
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

function esc(string $str): string {
	$text = htmlspecialchars($str);

	return $text;
}

function get_relative_time (string $date): string {
    $dt_now = date_create("now");
    $dt_end = date_create($date);
    $diff = date_diff($dt_end, $dt_now);
    $diff_i = date_interval_format($diff, "%i");
    $diff_h = date_interval_format($diff, "%h");
    $diff_d = date_interval_format($diff, "%d");
    $diff_m = date_interval_format($diff, "%m");

    if ($diff_m) {
        $noun = get_noun_plural_form($diff_m, 'месяц', 'месяца', 'месяцев');
        $date = $diff_m . ' ' . $noun . ' назад';
    } elseif ($diff_d and $diff_d >= 7) {
        $weeks = (int)$diff_d / 7;
        $noun = get_noun_plural_form($weeks, 'неделя', 'недели', 'недель');
        $date = $weeks . ' ' . $noun . ' назад';
    } elseif ($diff_d and $diff_d < 7) {
        $noun = get_noun_plural_form($diff_d, 'день', 'дня', 'дней');
        $date = $diff_d . ' ' . $noun . ' назад';
    } elseif ($diff_h) {
        $noun = get_noun_plural_form($diff_h, 'час', 'часа', 'часов');
        $date = $diff_h . ' ' . $noun . ' назад';
    } else {
        $noun = get_noun_plural_form($diff_i, 'минута', 'минуты', 'минут');
        $date = $diff_i . ' ' . $noun . ' назад';
    }

    return $date;
}

function get_posts_dates (array $array): array {
    foreach ($array as $key => &$value) {
        $dt_post = generate_random_date($key);
        $value['datetime'] = $dt_post;
    }

    return $array;
}

$cards = get_posts_dates($cards);

$page_content = include_template('main.php', [
    'cards' => $cards
]);

$layout_content = include_template('layout.php', [
	'content' => $page_content,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
	'title' => 'readme: популярное'
]);

print($layout_content);
