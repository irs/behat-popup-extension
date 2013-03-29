<?php
/**
 * This file is part of the Behat popup extension.
 * (c) 2013 Vadim Kusakin <vadim.irbis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Irs\BehatPopupExtension;

use Behat\Mink\Exception\ExpectationException;

/**
 * Base context for feature that uses TAF UI maps
 *
 */
trait PopupContext
{
    /**
     * @Given /^(?:|I )press ok on alert$/
     * @Given /^(?:|I )press ok on confirmation$/
     * @Given /^(?:|I )press ok on input popup$/
     */
    public function acceptPopup()
    {
        $this->getMink()->getSession()->acceptPopup();
    }

    /**
     * @Given /^(?:|I ) press cancel on confirmation$/
     * @Given /^(?:|I ) press cancel on input popup$/
     */
    public function dismissPopup()
    {
        $this->getMink()->getSession()->dismissPopup();
    }

    /**
     * @Given /^(?:|I ) type "([^"]*)" into input popup$/
     */
    public function typeInput($text)
    {
        $this->getSession()->setPopupText($text);
    }

    /**
     * @Given /^the alert message should contain "([^"]*)"$/
     * @Given /^the confirmation message should contain "([^"]*)"$/
     * @Given /^the prompt message should contain "([^"]*)"$/
     */
    public function assertPopupContains($text)
    {
        if (false === strpos($this->getMink()->getSession()->getPopupText(), $text)) {
            throw new ExpectationException(
                "Popup window does not contain '$text' but should contain.",
                $this->getMink()->getSession()
            );
        }
    }

    /**
     * @Given /^the alert message should not contain "([^"]*)"$/
     * @Given /^the confirmation message should not contain "([^"]*)"$/
     * @Given /^the prompt message should not contain "([^"]*)"$/
     */
    public function assertPopupNotContains($text)
    {
        if (false !== strpos($this->getMink()->getSession()->getPopupText(), $text)) {
            throw new ExpectationException(
                "Popup window contains '$text' but should not contain.",
                $this->getMink()->getSession()
            );
        }
    }
}
