<?php
/**
 * This file is part of the Behat popup extension.
 * (c) 2013 Vadim Kusakin <vadim.irbis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Irs\BehatPopupExtension;

use Behat\Mink\Driver\DriverInterface;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    protected function session(DriverInterface $driver = null)
    {
        if (!$driver) {
            $driver = $this->getMockBuilder('Behat\Mink\Driver\Selenium2Driver')
//             ->disableOriginalConstructor()
                ->getMock();
        }

        $selctorHandler = $this->getMock('Behat\Mink\Selector\SelectorsHandler');

        return new Session($driver, $selctorHandler);
    }

    public function testShouldExtendBehatMinkSession()
    {
        $this->assertInstanceOf('Behat\Mink\Session', $this->session());
    }

    public function testGetPopupTextShouldCallGetPopupTextOnDriver()
    {
        // prepare
        $driver = $this->getMock('Irs\BehatPopupExtension\Selenium2Driver', array('getPopupText'));
        $driver->expects($this->once())
            ->method('getPopupText');

        // act
        $this->session($driver)->getPopupText();
    }

    public function testSetPopupTextShouldCallSetPopupTextOnDriver()
    {
        // prepare
        $text = 'sdfsdfw';
        $driver = $this->getMock('Irs\BehatPopupExtension\Selenium2Driver', array('setPopupText'));
        $driver->expects($this->once())
            ->method('setPopupText')
            ->with($text);

        // act
        $this->session($driver)->setPopupText($text);
    }

    public function testAcceptPopupShouldCallAcceptPopupOnDriver()
    {
        // prepare
        $driver = $this->getMock('Irs\BehatPopupExtension\Selenium2Driver', array('acceptPopup'));
        $driver->expects($this->once())
            ->method('acceptPopup');

        // act
        $this->session($driver)->acceptPopup();
    }

    public function testDismissPopupShouldCallDismissPopupOnDriver()
    {
        // prepare
        $driver = $this->getMock('Irs\BehatPopupExtension\Selenium2Driver', array('dismissPopup'));
        $driver->expects($this->once())
            ->method('dismissPopup');

        // act
        $this->session($driver)->dismissPopup();
    }

    /**
     * @dataProvider providerPopupMethodNames
     * @expectedException Behat\Mink\Exception\UnsupportedDriverActionException
     */
    public function testPopupMethodsShouldThrowUnsupportedDriverActionExceptionOnDriverThatDoesNotImplementPopupHandlingInterface($methodName, array $args)
    {
        call_user_func_array(array($this->session(), $methodName), $args);
    }

    public function providerPopupMethodNames()
    {
        return array(
            array('getPopupText', array()),
            array('setPopupText', array('asdas')),
            array('acceptPopup', array()),
            array('dismissPopup', array()),
        );
    }
}
