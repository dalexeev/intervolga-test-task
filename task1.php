<?php

$a = '<p>&lt;Lorem&gt; ipsum&amp;dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>';

$link = '/article?id=1&lalala';


// Возвращает позицию последних $n слов в $string.
// Если в строке меньше $n слов, то возвращает 0.
function get_last_n_words_pos(string $string, int $n): int {
	assert($n > 0);
	
	$offset = 0;
	$strlen = mb_strlen($string);
	for ($i = 0; $i < $n; $i++) {
		$pos = mb_strrpos($string, ' ', $offset);
		if ($pos === false) {
			$pos = 0;
			break;
		}
		$pos += 1;
		$offset = $pos - $strlen - 2;
	}
	
	return $pos;
}


const BRIEF_LIMIT = 180;

$brief = html_entity_decode(strip_tags($a));
/* Чтобы не сломать разметку, используется самый простой вариант - удалить её.
Чтобы сохранить разметку потребуется более сложный код, учитывающий HTML.
Чтобы избежать нарушение &-последовательности при обрезании строки,
а также для более точного учёта количества видимых символов,
временнно преобразуем &-последовательности в соответствующие символы. */

if (mb_strlen($brief) > BRIEF_LIMIT) {
	$brief = mb_substr($brief, 0, BRIEF_LIMIT) . '…';
}

$brief = htmlspecialchars($brief);

$pos = get_last_n_words_pos($brief, 2);
$lbrief = mb_substr($brief, 0, $pos);
$rbrief = mb_substr($brief, $pos);
$link = htmlspecialchars($link);

echo "$lbrief<a href=\"$link\">$rbrief</a>";
