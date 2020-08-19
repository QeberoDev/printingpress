<?php

use Twig\TwigFilter;

require 'vendor/autoload.php';

$loader = new Twig\Loader\FilesystemLoader('views');
$twig = new Twig\Environment($loader);

$md5Filter = new TwigFilter('md5', function($string) {
	return md5($string);
});

$twig->addFilter($md5Filter);

$lexer = new Twig\Lexer($twig, [
	'tag_block' => ['{', '}'],
	'tag_variable' => ['{{', '}}']
]);

$twig->setLexer($lexer);

echo $twig->render('hello.html', [
	'name' => 'Michle',
	'age' => 52,
	'users' => [
		[ 'name' => 'Max',  'age' => 18 ],
		[ 'name' => 'James', 'age' => 22 ],
		[ 'name' => 'Billy', 'age' => 18 ]
	]
]);