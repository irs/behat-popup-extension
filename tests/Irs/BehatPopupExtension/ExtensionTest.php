<?php
/**
 * This file is part of the Behat popup extension.
 * (c) 2013 Vadim Kusakin <vadim.irbis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Irs\BehatPopupExtension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class ExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldImplementExtensionInterface()
    {
        $this->assertInstanceOf('Behat\Behat\Extension\ExtensionInterface', new Extension);
    }

    public function testLoadShouldAddPropelyConfiguredUimapSelectorToDiContainer()
    {
        // preapre
        $extension = new Extension;
        $container = new ContainerBuilder;
        $config = array();

        // act
        $extension->load($config, $container);

        // assert
        $this->assertEquals('Irs\BehatPopupExtension\Session', $container->getParameter('behat.mink.session.class'));
        $this->assertEquals(
            'Irs\BehatPopupExtension\Selenium2Driver',
            $container->getParameter('behat.mink.driver.selenium2.class')
        );
    }

    public function testShouldReturnEmptyPassList()
    {
        $extension = new Extension;

        $this->assertSame(array(), $extension->getCompilerPasses());
    }
}
