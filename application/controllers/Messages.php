<?php

/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 10/08/18
 * Time: 21:34
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Messages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('debug');
    }

    public function index() {
        $data['title'] = 'Encrypt &amp; decrypt messages';
        $data['subtitle'] = "These messages have a 5-layer-encryption. Each layer uses the encryption-key. <br> " .
            "This key has a 2-layer-encryption (with one-way-encryption) before it's used in all other encryption layers.";

        $data['header'] = '';
        $data['footer'] = '';
        $data['message'] = '';

        $partials = array('header' => 'main_header', 'content' => 'messages', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * @return string (encrypted or decrypted message)
     */
    public function ajaxConvertMessage() {
        $convertMethod = $this->input->post('convertMethod');
        $key = $this->input->post('key');
        $message = $this->input->post('message');

        $processedKey = $this->processKey($key);
        switch ($convertMethod) {
            case "encrypt":
                $message = $this->encryptMessage($processedKey, $message);
                break;
            case "decrypt":
                $message = $this->decryptMessage($processedKey, $message);
                break;
        }
        echo $message;
    }

    /**
     * eerst key omzetten naar hash
     * vervolgens splitsen in array
     * vervolgens omzetten naar ascii-chars
     * vervolgens de ascii-chars optellen
     *
     * @param int $key
     *
     * @var int $processedKey
     * @var int $keyHash (hashed met sha1)
     * @var array $array (array om tijdelijk de karakters van de string op te slaan)
     *
     * @return int
     */
    private function processKey($key) {
        $processedKey = 0;

        $keyHash = sha1($key);
        $array = str_split($keyHash);

        foreach ($array as $char) {
            $processedKey += ord($char);
        }

        return $processedKey;
    }

    /**
     * @param int $processedKey
     * @param string $message
     *
     * @return string
     */
    private function encryptMessage($processedKey, $message) {
        $asciiArray = $this->encryption_level1($message);
        $asciiArray_withKey = $this->encryption_level2($asciiArray, $processedKey);
        $asciiArray_withKey_withWeirdChar = $this->encryption_level3($asciiArray_withKey, $processedKey);
        $asciiArray_withKey_withWeirdChar_addedElements = $this->encryption_level4($asciiArray_withKey_withWeirdChar);
        $message = $this->encryption_level5($asciiArray_withKey_withWeirdChar_addedElements);
        return $message;
    }

    /**
     * @param int $processedKey
     * @param string $message
     *
     * @return string
     */
    private function decryptMessage($processedKey, $message) {
        $asciiArray_withKey_withWeirdChar_addedElements_REVERSE = $this->decryption_level1($message);
        $asciiArray_withKey_withWeirdChar_REVERSE = $this->decryption_level2($asciiArray_withKey_withWeirdChar_addedElements_REVERSE);
        $asciiArray_withKey_REVERSE = $this->decryption_level3($asciiArray_withKey_withWeirdChar_REVERSE, $processedKey);
        $asciiArray_REVERSE = $this->decryption_level4($asciiArray_withKey_REVERSE, $processedKey);
        $message = $this->decryption_level5($asciiArray_REVERSE);
        return $message;
    }

    /**
     * @param string $message
     *
     * @return array (array met ascii karakters)
     */
    private function encryption_level1($message) {
        $array = str_split($message);
        $asciiArray = [];

        foreach ($array as $char) {
            array_push($asciiArray, ord($char));
        }
        return $asciiArray;
    }

    /**
     * @param array $asciiArray
     * @param int $processedKey
     *
     * @return array (array met de som van ascii karakters + processedkey-value)
     */
    private function encryption_level2($asciiArray, $processedKey) {
        $asciiArray_withKey = [];
        foreach ($asciiArray as $char) {
            array_push($asciiArray_withKey, ($char + $processedKey));
        }
        return $asciiArray_withKey;
    }

    /**
     * @param array $asciiArray_withKey
     * @param int $processedKey
     *
     * @return array (om de 'x' aantal elementen is er een vreemdKarakter toegevoegd,
     * waar 'x' de keyLength is, en het vreemdKarakter uit de $vreemdeKarakters-array komt van index '$teller')
     */
    private function encryption_level3($asciiArray_withKey, $processedKey) {
        $keyLength = strlen((string)$processedKey);

        // zorgen dat er een nummer is van 0-9 gebaseerd op de $processedKey
        // ($processedKey is reeds de som van de ascii-karakters)
        if ($keyLength >= 10) {
            do {
                $keyLength -= 10;
            } while ($keyLength >= 10);
        }

        // om de x elementen (x = keyLength) een raar vreemdKarakter invoegen (vreemdKarakter = positie van teller)
        $vreemdeKarakters = array(
            '0' => '#',
            '1' => '&',
            '2' => '$',
            '3' => '*',
            '4' => '€',
            '5' => '£',
            '6' => '§',
            '7' => '@',
            '8' => '~',
            '9' => '!',
        );

        $teller = 0;
        $asciiArray_withKey_withWeirdChar = [];

        foreach ($asciiArray_withKey as $item) {
            $teller++;

            // item toevoegen
            array_push($asciiArray_withKey_withWeirdChar, $item);
            if ($teller == $keyLength) {
                // vreemd karakter toevoegen
                array_push($asciiArray_withKey_withWeirdChar, $vreemdeKarakters[($teller - 1)]);
                $teller = 0;
            }
        }

        return $asciiArray_withKey_withWeirdChar;
    }

    /**
     * @param array $asciiArray_withKey_withWeirdChar
     *
     * @return array (om de 10 aantal elementen is er een vreemdKarakter toegevoegd,
     * waar het vreemdKarakter uit de $vreemdeKarakters-array komt met een random index-nummer)
     */
    private function encryption_level4($asciiArray_withKey_withWeirdChar) {
        $asciiArray_withKey_withWeirdChar_addedElements = [];
        // elke 10 elementen een vreemdKarakter toevoegen

        $vreemdeKarakters = array(
            '0' => '#',
            '1' => '&',
            '2' => '$',
            '3' => '*',
            '4' => '€',
            '5' => '£',
            '6' => '§',
            '7' => '@',
            '8' => '~',
            '9' => '!',
        );

        $teller = 0;

        foreach ($asciiArray_withKey_withWeirdChar as $item) {
            $teller++;
            array_push($asciiArray_withKey_withWeirdChar_addedElements, $item);

            if ($teller == 10) {
                // vreemd karakter toevoegen
                // dit is gebaseerd op een random nummer omdat bij het decrypten we de positie weten van de array
                $randomInt = rand(0, 9);
                array_push($asciiArray_withKey_withWeirdChar_addedElements, $vreemdeKarakters[$randomInt]);
                $teller = 0;
            }
        }
        return $asciiArray_withKey_withWeirdChar_addedElements;
    }

    /**
     * converts array to string with delimiters 'a-z'
     *
     * @param array $asciiArray_withKey_withWeirdChar_addedElements
     *
     * @return string
     */
    private function encryption_level5($asciiArray_withKey_withWeirdChar_addedElements) {
        // convert array to string
        $message = "";
        foreach ($asciiArray_withKey_withWeirdChar_addedElements as $int) {
            $randomLetter = chr(rand(97, 122));
            $message .= $randomLetter . $int;
        }
        return $message;
    }

    /**
     * de string opsplitsen in een array, gesplitst met delimiter 'a-z'
     *
     * @param string $message
     *
     * @return array
     */
    private function decryption_level1($message) {
        $arrayString = preg_split('/[a-z]+/', $message);
        $asciiArray_withKey_withWeirdChar_addedElements_REVERSE = array_filter($arrayString); // haal empty values eruit
        return $asciiArray_withKey_withWeirdChar_addedElements_REVERSE;
    }

    /**
     * om de 10 elementen het vreemd karakter eruit halen
     *
     * @param array $asciiArray_withKey_withWeirdChar_addedElements_REVERSE
     *
     * @return array
     */
    private function decryption_level2($asciiArray_withKey_withWeirdChar_addedElements_REVERSE) {
        $asciiArray_withKey_withWeirdChar_REVERSE = [];
        $teller = 0;

        foreach ($asciiArray_withKey_withWeirdChar_addedElements_REVERSE as $item) {
            $teller++;
            if ($teller != 11) {
                // index is één meer omdat dit een extra element werd toegevoegd bij encryption
                array_push($asciiArray_withKey_withWeirdChar_REVERSE, $item);
            }
            else {
                $teller = 0;
            }
        }
        return $asciiArray_withKey_withWeirdChar_REVERSE;
    }

    /**
     * om de 'x' aantal elementen het vreemd karakter eruit halen
     *
     * @param array $asciiArray_withKey_withWeirdChar_REVERSE
     * @param int $processedKey
     *
     * @return array
     */
    private function decryption_level3($asciiArray_withKey_withWeirdChar_REVERSE, $processedKey) {
        $keyLength = strlen((string)$processedKey);

        // zorgen dat er een nummer is van 0-9 gebaseerd op de $processedKey
        // ($processedKey is reeds de som van de ascii-karakters)
        if ($keyLength >= 10) {
            do {
                $keyLength -= 10;
            } while ($keyLength >= 10);
        }

        $asciiArray_withKey_REVERSE = [];
        $teller = 0;

        foreach ($asciiArray_withKey_withWeirdChar_REVERSE as $item) {
            $teller++;

            if ($teller != $keyLength + 1) {
                // item toevoegen
                array_push($asciiArray_withKey_REVERSE, $item);
            }
            else {
                $teller = 0;
            }
        }

        return $asciiArray_withKey_REVERSE;
    }

    /**
     * voor elk element in de array de processedKey-waarde eruit halen
     *
     * @param array $asciiArray_withKey_REVERSE
     * @param int $processedKey
     *
     * @return array
     */
    private function decryption_level4($asciiArray_withKey_REVERSE, $processedKey) {
        $asciiArray_REVERSE = [];
        foreach ($asciiArray_withKey_REVERSE as $char) {
            array_push($asciiArray_REVERSE, ($char - $processedKey));
        }
        return $asciiArray_REVERSE;
    }

    /**
     * de array omzetten naar een string
     *
     * @param array $asciiArray_REVERSE
     *
     * @return string
     */
    private function decryption_level5($asciiArray_REVERSE) {
        $message = "";
        foreach ($asciiArray_REVERSE as $char) {
            $message .= chr($char);
        }

        return $message;
    }


}