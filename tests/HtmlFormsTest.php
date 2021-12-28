<?php

class HtmlFormsTest extends PHPUnit_Extensions_Selenium2TestCase {
    public function setUp()
    {
        $this->setBrowserUrl('http://localhost:63342/phpunit-selenium/src/testingHtmlPage.html?_ijt=ul6djeg4u27br4vn7ti7joh8qc&_ij_reload');
        $this->setBrowser('chrome');

        $this->setDesiredCapabilities(['chromeOptions' => ['w3c' => false]]);
    }

    public function testForms() {
        $this->url('');

        $this->select($this->byId('option-element'))->selectOptionByLabel('Option 2');
        $this->assertSame('option-2', $this->select($this->byId('option-element'))->selectedValue());

        $usernameInput = $this->byName('some_input_name');
        $usernameInput->value('Adam');
        $this->assertSame('Adam', $usernameInput->value());

        $radios = $this->elements($this->using('css selector')->value('input[type="radio"]'));
        $radios[0]->click();

        $this->byCssSelector('input[type="checkbox"]')->click();

        $this->byTag('textarea')->value('Some text');

        $this->clickOnElement('submit-button');
        $this->assertContains('The form was sent!', $this->source());
    }

    public function testAnother() {
        $this->assertSame('John', 'John');

//        $this->markTestIncomplete('Firefox (geckodriver) does not support this command yet.');

        $this->url('');

        $this->cookie()->add('user', 'logged-in')->set();

        $authCookie = $this->cookie()->get('user');

        $this->assertSame($authCookie, 'logged-in');
    }
}
