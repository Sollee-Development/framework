<?php
namespace Config\Dice;
class MultJsonFileLoader {
    private $diceJsonLoader;

    public function __construct(\Dice\Loader\Json $diceJsonLoader) {
        $this->diceJsonLoader = $diceJsonLoader;
    }

    public function load($json, \Dice\Dice $dice = null) {
        if (is_array($json)) {
			foreach ($json as $file) $dice = $this->load($file, $dice);
			return $dice;
		}
		return $this->diceJsonLoader->load($json, $dice);
    }
}
