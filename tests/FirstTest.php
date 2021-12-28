<?php

class FirstTest extends PHPUnit_Extensions_Selenium2TestCase {
    public function setUp() {
        $this->setBrowserUrl('http://localhost:63342/phpunit-selenium/src/testingHtmlPage.html?_ijt=qjamttk5njc8i9s6jksd8b1m4v&_ij_reload');
        $this->setBrowser('chrome');

        $this->setDesiredCapabilities(['chromeOptions' => ['w3c' => false]]);
    }

    public function testTitle() {
        $this->url('');

        $this->assertEquals('HTML by Adam Morse, mrmrs.cc', $this->title());
    }

    public function testGettingElements() {
        $this->url('');
        $h1 = $this->byCssSelector('header h1');
        $this->assertContains('HTML', $h1->text());

        $h1 = $this->elements($this->using('css selector')->value('h1'));
        $this->assertEquals(16, count($h1));
        $this->assertContains('Headings', $h1[2]->text());

        $field = $this->byId('first-name');
        $this->assertSame('Adam', $field->value());

        $link = $this->byId('google-link-id');
        $this->assertSame('Google', $link->attribute('title'));
        $this->assertSame('Google', $link->text());

        $link->click();
        $this->assertEquals('Google', $this->title());
        $this->back();

        $content = $this->byTag('body')->text();
        $this->assertContains('Every html element in one place', $content);
    }
}
