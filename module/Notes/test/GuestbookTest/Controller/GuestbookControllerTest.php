<?php

namespace GuestbookTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class GuestbookControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include '/home/epi/09_buszewicz/public_html/zf/config/application.config.php'
        );
        parent::setUp();
    }
    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/guestbook');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Guestbook');
        $this->assertControllerName('Guestbook\Controller\Index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('guestbook');
    }
}
