<?php
/**
 * Copyright 2011, Brandon Plasters (http://brandonplasters.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2011, Brandon Plasters (http://brandonplasters.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

class SwfSessionComponent extends Object {

	/**
	 * Restore session from POST fields if possible.
	 *
	 * This is required because flash plugin uses a different
         * session (id and user agent) from the application one.
	 *
	 * @param Object &$controller pointer to calling controller
	 */
	public function initialize(&$controller) {
		if (!empty($_POST[Configure::read('Session.cookie')])) {
			//Restore session for our application and not session used by Flash plugin.
			$controller->Session->id($_POST[Configure::read('Session.cookie')]);
			//Required if application is configured to check session user agent.
			if (Configure::read('Session.checkAgent')) {
				$controller->Session->write('Config.userAgent', $_POST['userAgent']);
			}
		}
	}
		
}
?>
	