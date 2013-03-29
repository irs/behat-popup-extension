<?php
/**
 * This file is part of the Behat popup extension.
 * (c) 2013 Vadim Kusakin <vadim.irbis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Irs\BehatPopupExtension;

use Behat\Mink\Exception\UnsupportedDriverActionException;

/**
 * Session with support of popup handling
 *
 */
class Session extends \Behat\Mink\Session
{
    /**
     * Returns text of current popup
     *
     * @throws UnsupportedDriverActionException If driver does not sypport popup handling
     */
    public function getPopupText()
    {
        if (!$this->getDriver() instanceof PopupHandlingInterface) {
            throw new UnsupportedDriverActionException('Driver %s does not support popup handling.', $this->getDriver());
        }

        return $this->getDriver()->getPopupText();
    }

    /**
     * Fill in current popup
     *
     * @throws UnsupportedDriverActionException If driver does not sypport popup handling
     */
    public function setPopupText($text)
    {
        if (!$this->getDriver() instanceof PopupHandlingInterface) {
            throw new UnsupportedDriverActionException('Driver %s does not support popup handling.', $this->getDriver());
        }

        $this->getDriver()->setPopupText($text);
    }

    /**
     * Accepts current popup
     *
     * @throws UnsupportedDriverActionException If driver does not sypport popup handling
     */
    public function acceptPopup()
    {
        if (!$this->getDriver() instanceof PopupHandlingInterface) {
            throw new UnsupportedDriverActionException('Driver %s does not support popup handling.', $this->getDriver());
        }

        $this->getDriver()->acceptPopup();
    }

    /**
     * Cancels current popup
     *
     * @throws UnsupportedDriverActionException If driver does not sypport popup handling
     */
    public function dismissPopup()
    {
        if (!$this->getDriver() instanceof PopupHandlingInterface) {
            throw new UnsupportedDriverActionException('Driver %s does not support popup handling.', $this->getDriver());
        }

        $this->getDriver()->dismissPopup();
    }
}
