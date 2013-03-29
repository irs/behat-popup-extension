<?php
/**
 * This file is part of the Behat popup extension.
 * (c) 2013 Vadim Kusakin <vadim.irbis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Irs\BehatPopupExtension;

/**
 * Selenium2 driver with popup handling capabilities
 *
 */
class Selenium2Driver extends \Behat\Mink\Driver\Selenium2Driver implements PopupHandlingInterface
{
    /**
     * Rreturns text of opened popup window
     *
     * @see \Irs\BehatUimapExtension\Driver\PopupHandlingInterface::getPopupText()
     */
    public function getPopupText()
    {
        return $this->getWebDriverSession()->alert_text();
    }

    /**
     * Fills in text into popup
     *
     * @see \Irs\BehatUimapExtension\Driver\PopupHandlingInterface::setPopupText()
     */
    public function setPopupText($text)
    {
        $this->getWebDriverSession()->postAlert_text($text);
    }

    /**
     * Accepts popup
     *
     * @see \Irs\BehatUimapExtension\Driver\PopupHandlingInterface::acceptPopup()
     */
    public function acceptPopup()
    {
        $this->getWebDriverSession()->accept_alert();
    }

    /**
     * Dismisses popup
     *
     * @see \Irs\BehatUimapExtension\Driver\PopupHandlingInterface::dismissPopup()
     */
    public function dismissPopup()
    {
        $this->getWebDriverSession()->dismiss_alert();
    }
}
