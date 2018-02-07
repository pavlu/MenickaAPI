<?php

/**
 * MENICKA.CZ API
 * Verze: 1.0
 * ------------------------- 
 * Provozovatel: Ing. Jakub Lukáš, menicka@menicka.cz, https://www.menicka.cz
 * Autor scriptu: Václav Pavlů - Ewebovky, pavlu@ewebovky.cz, https://www.ewebovky.cz
 * 
 * Donate: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7SYEEFZ4DR8SC
 * Za dobrovolné příspěvky a zachování této hlavičky děkuji.
 */

require_once 'menicka_api.php';

$login = 'mujlogin';
$heslo = 'mojetajneheslo';

$hash = md5($heslo);

// Testovací verze
$menickaAPI = new MenickaAPI($login, $hash, 'DEV');

// Produkční verze
$menickaAPI = new MenickaAPI($login, $hash, 'PROD');

// Příklad vložení nového záznamu
$id = 856; // ID záznamu ve Vaší databázi
$typ = 2; //1 = polévka, 2 = jídlo, 3 = poznámka
$poradi = 1;
$text = 'Znojemská hovězí pečeně, rýže';
$cena = 95;
$datum = '2018-01-16';

$menickaAPI->add($id, $typ, $poradi, $text, $cena, $datum);

// Příklad úpravy záznamu
$id = 856; // ID záznamu ve Vaší databázi
$typ = 2; //1 = polévka, 2 = jídlo, 3 = poznámka
$poradi = 1;
$text = 'Znojemská hovězí pečeně, knedlík';
$cena = 100;
$datum = '2018-01-16';

$menickaAPI->update($id, $typ, $poradi, $text, $cena, $datum);

// Příklad odstranění záznamu
$menickaAPI->delete(856);