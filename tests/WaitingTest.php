<?php

class WaitingTest extends PHPUnit_Extensions_Selenium2TestCase {
    protected function setUp()
    {
        $this->setBrowserUrl('http://localhost:63342/phpunit-selenium/src/testingHtmlPage.html?_ijt=ul6djeg4u27br4vn7ti7joh8qc&_ij_reload');
        $this->setBrowser('chrome');

        $this->setDesiredCapabilities(['chromeOptions' => ['w3c' => false]]);
    }

    public function testExplicitWait() {
        $this->url('');
        $driver = $this;
        $this->waitUntil(function() use($driver) {
            $item = $driver->byId('first-name');

            if ($item->value() === 'Adam') return true;

            return null;
        }, 4000);
        $this->assertSame('Adam', $this->byId('first-name')->value());
    }
}
