![Ewebovky logo](https://scontent-vie1-1.xx.fbcdn.net/v/t1.0-9/300307_143851005784634_13358189_n.jpg?oh=dc3fba62bc1c46640de3bee5a15cd9a8&oe=5ADA83DB)

# MenickaAPI

![Logo Menicka.cz](http://www.menicka.cz/files/podpora/dennimenu_small.png)

API pro import denního menu z Vašeho webu na https://www.menicka.cz

## Autor
Václav Pavlů - Ewebovky
pavlu@ewebovky.cz
https://www.ewebovky.cz

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7SYEEFZ4DR8SC)

## Inicializace

```php
require_once 'menicka_api.php';

$login = 'mujlogin';
$heslo = 'mojetajneheslo';

$hash = md5($heslo);
```
> Pokud heslo načítáte z databáze vašeho systému, doporučuji uložit ho přímo jako MD5 hash. Neukládejte heslo v čitelné podobě. 

### Testovací verze

```php
$menickaAPI = new MenickaAPI($login, $hash, 'DEV');
```

### Produkční verze

```php
$menickaAPI = new MenickaAPI($login, $hash, 'PROD');
```
## Struktura proměnných

Proměnná | typ | Popis
------------ | ------------- | ---------
**$id** | integer | Interní ID záznamu, pod kterým má zákazník vedený záznam ve své DB
**$typ** | integer | 1 = polévka, 2 = jídlo, 3 = poznámka
**$poradi** | integer | Pořadí záznamu ve výpisu
**$text** | string | Text záznamu v kódování WINDOWS-1250
**$cena** | integer | Cena záznamu, např. "60", bez koncovky
**$datum** | string | Datum ve formátu YYYY-MM-DD, pokud není uvedeno, použije se dnešní datum

### Příklad odesílaných dat

```php
$id = 856;
$typ = 2;
$poradi = 1;
$text = 'Znojemská hovězí pečeně, rýže';
$cena = 95;
$datum = '2018-01-16';
```

## Vložení nového záznamu

```php
$menickaAPI->add($id, $typ, $poradi, $text, $cena, $datum);
```

## Úprava stávajícího záznamu

```php
$menickaAPI->update($id, $typ, $poradi, $text, $cena, $datum);
```
## Odstranění záznamu

```php
$menickaAPI->delete($id);
```
