<?php
/* @description     Transformation Style Sheets - Revolutionising PHP templating    *
 * @author          Tom Butler tom@r.je                                             *
 * @copyright       2015 Tom Butler <tom@r.je> | https://r.je/                      *
 * @license         http://www.opensource.org/licenses/bsd-license.php  BSD License *
 * @version         1.0                                                             */
namespace Transphporm\Property;
class Display implements \Transphporm\Property {
	public function run($value, \DomElement $element, \Transphporm\Hook\PropertyHook $rule) {
		if ($attr = $rule->getPseudoMatcher()->attr()) $element->removeAttribute($attr);
		else if (strtolower($value[0]) === 'none') $element->setAttribute('transphporm', 'remove');
		else $element->setAttribute('transphporm', 'show');
	}
}