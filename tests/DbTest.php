<?php

use PHPUnit\Framework\TestCase;
use Bendzsi\Vote\Db;

class DbTest extends TestCase
{
    public function testConnect()
    {
        $this->expectException(Exception::class);
        $db=new Db('a','b','c','d');
    }
}

?>