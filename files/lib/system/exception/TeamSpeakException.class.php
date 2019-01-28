<?php
namespace wcf\system\exception;

/**
* TeamSpeak exception
*
* @author	Peter Lohse <hanashi@hanashi.eu>
* @copyright	Hanashi
* @license	Freie Lizenz (https://hanashi.eu/freie-lizenz/)
* @package	WoltLabSuite\Core\System\Exception
*/
class TeamSpeakException extends SystemException {
    /**
	 * Creates a new TeamSpeakException.
	 * 
	 * @param	string		$message	error message
	 */
    public function __construct($message = '') {
        parent::__construct((string)$message);

        if (ENABLE_DEBUG_MODE) {
            \wcf\functions\exception\logThrowable($this);
        }
    }
}