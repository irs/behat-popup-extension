<?php
/**
 * This file is part of the Behat popup extension.
 * (c) 2013 Vadim Kusakin <vadim.irbis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Irs\BehatPopupExtension;

use Behat\Mink\Mink;
use Behat\Mink\Driver\DriverInterface;
use Behat\Mink\Selector\SelectorsHandler;

class UimapContextTest extends \PHPUnit_Framework_TestCase
{
    protected function contextWithDriver(DriverInterface $driver)
    {
        $selectorsHandler = new SelectorsHandler;
        $sessionName = 'mocked';
        $mink = new Mink(array($sessionName => new Session($driver, $selectorsHandler)));
        $mink->setDefaultSessionName($sessionName);

        return new ContextTester($mink);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function driverMock()
    {
        return $this->getMock('Irs\BehatPopupExtension\Selenium2Driver');
    }

    public function testAcceptPopup()
    {
        // preapre
        $driver = $this->driverMock();
        $driver->expects($this->once())
            ->method('acceptPopup');

        // act
        $this->contextWithDriver($driver)->acceptPopup();
    }

    /**
     * @expectedException Behat\Mink\Exception\ExpectationException
     */
    public function testAssertPopupContainsShouldThrowExceptionIfAlertDoesNotContainTest()
    {
        // prepare
        $driver = $this->driverMock();
        $driver->expects($this->once())
            ->method('getPopupText')
            ->will($this->returnValue('sdfsdf'));

        // act
        $this->contextWithDriver($driver)->assertPopupContains('oqiwjio');
    }

    public function testAssertPopupContainsShouldNotThrowExceptionIfAlertContainsTest()
    {
        // prepare
        $driver = $this->driverMock();
        $driver->expects($this->once())
            ->method('getPopupText')
            ->will($this->returnValue('sdfsdf'));

        // act
        $this->contextWithDriver($driver)->assertPopupContains('fsd');
    }

    public function testAssertPopupNotContainsShouldNotThrowExceptionIfAlertDoesNotContainTest()
    {
        // prepare
        $driver = $this->driverMock();
        $driver->expects($this->once())
            ->method('getPopupText')
            ->will($this->returnValue('sdfsdf'));

        // act
        $this->contextWithDriver($driver)->assertPopupNotContains('oqiwjio');
    }

    /**
     * @expectedException Behat\Mink\Exception\ExpectationException
     */
    public function testAssertPopupNotContainsShouldThrowExceptionIfAlertContainsTest()
    {
        // prepare
        $driver = $this->driverMock();
        $driver->expects($this->once())
            ->method('getPopupText')
            ->will($this->returnValue('sdfsdf'));

        // act
        $this->contextWithDriver($driver)->assertPopupNotContains('fsd');
    }


    public function testDismissPopup()
    {
        // prepare
        $driver = $this->driverMock();
        $driver->expects($this->once())
            ->method('dismissPopup');

        // act
        $this->contextWithDriver($driver)->dismissPopup();
    }
}

class ContextTester
{
    use PopupContext;

    private $mink;

    public function __construct(Mink $mink)
    {
        $this->mink = $mink;
    }

    protected function getMink()
    {
        return $this->mink;
    }
}
