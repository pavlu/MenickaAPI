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

class MenickaAPI {
  
  public $login;
  public $hash;
  public $rezim;

  /**
   * MENICKA.CZ API
   * 
   * @param string $login Login do administrace na menicka.cz
   * @param string $hash MD5 hash hesla do administrace na menicka.cz
   * @param string $rezim DEV - Testovací verze, PROD - Produkční verze
   */
  
  public function __construct($login, $hash, $rezim = 'DEV') {
    $this->login = $login;
    $this->hash = $hash;
    
    if ($rezim === 'DEV') {
      $this->url = 'https://www.menicka.cz/api/import/test.php';
    } elseif ($rezim === 'PROD') {
      $this->url = 'https://www.menicka.cz/api/import/import.php';
    }
  }
  
  /**
   * Vložení záznamu
   * 
   * @param integer $id Interní ID záznamu, pod kterým má zákazník vedený záznam ve své DB
   * @param integer $typ 1 = polévka, 2 = jídlo, 3 = poznámka
   * @param integer $poradi Pořadí záznamu ve výpisu
   * @param string $text Text záznamu v kódování WINDOWS-1250
   * @param integer $cena Cena záznamu, např. "60", bez koncovky
   * @param string $datum Datum ve formátu YYYY-MM-DD, pokud není uvedeno, použije se dnešní datum
   * 
   * @return object() HTTP Response
   * 
   */

  public function add($id, $typ, $poradi = NULL, $text, $cena=NULL, $datum=NULL) {

    if ($datum === NULL) {
      $datum = date("Y-m-d");
    }

    $data = array(
      'login' => $this->login,
      'heslo' => $this->hash,
      'datum' => $datum,
      'id' => $id,
      'typ' => $typ,
      'poradi' => $poradi,
      'text' => $text,
      'cena' => $cena,
      'action' => 'add'
    );

    $full_url = url($this->url, array('query' => $data));

    return file_get_contents($full_url);
  }

  /**
   * Editace záznamu
   * 
   * @param integer $id Interní ID záznamu, pod kterým má zákazník vedený záznam ve své DB
   * @param integer $typ 1 = polévka, 2 = jídlo, 3 = poznámka
   * @param integer $poradi Pořadí záznamu ve výpisu
   * @param string $text Text záznamu v kódování WINDOWS-1250
   * @param integer $cena Cena záznamu, např. "60", bez koncovky
   * @param string $datum Datum ve formátu YYYY-MM-DD, pokud není uvedeno, použije se dnešní datum
   * 
   * @return object() HTTP Response
   * 
   */

  public function update($id, $typ, $poradi = NULL, $text, $cena=NULL, $datum=NULL) {

    if ($datum === NULL) {
      $datum = date("Y-m-d");
    }

    $data = array(
      'login' => $this->login,
      'heslo' => $this->hash,
      'datum' => $datum,
      'id' => $id,
      'typ' => $typ,
      'poradi' => $poradi,
      'text' => $text,
      'cena' => $cena,
      'action' => 'update'
    );

    $full_url = url($this->url, array('query' => $data));

    return file_get_contents($full_url);
  }

  /**
   * Odstranění záznamu
   * 
   * @param integer $id Interní ID záznamu, pod kterým má zákazník vedený záznam ve své DB
   * 
   * @return object() HTTP Response
   */

  public function delete($id) {

    $data = array(
      'login' => $this->login,
      'heslo' => $this->hash,
      'id' => $id,
      'action' => 'delete'
    );

    $full_url = url($this->url, array('query' => $data));

    return file_get_contents($full_url);
  }

}