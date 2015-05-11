<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Integration\Test\Unit\Helper;

use Magento\Integration\Model\Integration;

class DataTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Magento\Integration\Helper\Data */
    protected $dataHelper;

    protected function setUp()
    {
        $helper = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->dataHelper = $helper->getObject('Magento\Integration\Helper\Data');
    }

    /**
     * @dataProvider
     */
    public function testMapResources()
    {
        $testData = require __DIR__ . '/_files/acl.php';
        $expectedData = require __DIR__ . '/_files/acl-map.php';
        $this->assertEquals($expectedData, $this->dataHelper->mapResources($testData));
    }

    public function testIsConfigType()
    {
        $integrationsData = [
            'id' => 1,
            Integration::NAME => 'TestIntegration1',
            Integration::EMAIL => 'test-integration1@magento.com',
            Integration::ENDPOINT => 'http://endpoint.com',
            Integration::SETUP_TYPE => 1,
        ];
        $this->assertTrue($this->dataHelper->isConfigType($integrationsData));
    }

    public function testIsConfigTypeFalse()
    {
        $integrationsData = [
            'id' => 1,
            Integration::NAME => 'TestIntegration1',
            Integration::EMAIL => 'test-integration1@magento.com',
            Integration::ENDPOINT => 'http://endpoint.com',
            Integration::SETUP_TYPE => 0,
        ];
        $this->assertFalse($this->dataHelper->isConfigType($integrationsData));
    }
}
