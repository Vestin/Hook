<?php
require 'vendor/autoload.php';
use Vestin\Hook\Hook;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function test_on()
    {
        $return = Hook::on('app_start', function () {
            return 'start';
        });

        $this->assertTrue($return);
    }

    public function test_on_class()
    {
        $return = Hook::on('app_start', 'test\\StartTarget');
        $this->assertTrue($return);
    }

    public function test_call()
    {
        $result = Hook::call('app_start');
        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey(1, $result);
    }

    public function test_call_empty()
    {
        $result = Hook::call('done');
        $this->assertCount(0, $result);
    }

    public function test_off(){
        Hook::off('app_start');
        Hook::on('app_start',function(){
            return 'only one';
        });
        $result = Hook::call('app_start');
        $this->assertArrayHasKey(0,$result);
        $this->assertArrayNotHasKey(1,$result);
    }
}