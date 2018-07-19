<?php
namespace Config\Dice;
class MultJsonFileLoader {
    public function load($json, \Dice\Dice $dice = null) {
        if ($dice === null) $dice = new \Dice\Dice();
        if (is_array($json)) {
			foreach ($json as $file) $dice->addRules($file);
			return $dice;
		}
        $dice->addRules($json);
        return $dice;
    }
}
