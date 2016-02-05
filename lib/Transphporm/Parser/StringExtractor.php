<?php
/* @description     Transformation Style Sheets - Revolutionising PHP templating    *
 * @author          Tom Butler tom@r.je                                             *
 * @copyright       2015 Tom Butler <tom@r.je> | https://r.je/                      *
 * @license         http://www.opensource.org/licenses/bsd-license.php  BSD License *
 * @version         1.0                                                             */
namespace Transphporm\Parser;
class StringExtractor {
	private $str;
	private $stringTable;

	public function __construct($str) {
		$parts = $this->extractStrings($str);
		$this->str = $parts[0];
		$this->stringTable = $parts[1];
	}

	private function extractStrings($str) {
		$pos = 0;
		$num = 0;
		$strings = [];
		while (($pos = strpos($str, '"', $pos+1)) !== false) {
			$end = strpos($str, '"', $pos+1);
			while ($str[$end-1] == '\\') $end = strpos($str, '"', $end+1);
			$strings['$+STR' . ++$num] = substr($str, $pos, $end-$pos+1);
			$str = substr_replace($str, '$+STR' . $num, $pos, $end-$pos+1);
		}

		return [$str, $strings];
	}

	public function rebuild($str) {
		return str_replace(array_keys($this->stringTable), array_values($this->stringTable), $str);
	}

	public function __toString() {
		return $this->str;
	}
}