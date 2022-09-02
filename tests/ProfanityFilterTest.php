<?php
use PHPUnit\Framework\TestCase;
use Bendzsi\Vote\ProfanityFilter;

class ProfanityFilterTest extends TestCase{

    protected function setUp(): void
    {
        $this->filter=new ProfanityFilter();
    }

    protected function tearDown(): void
    {
        $this->filter=null;
    }

    public function testAllowForBannedWords() {
        //$filter = new ProfanityFilter();
        $actual = $this->filter->isBanned('white');
        $this->assertTrue($actual); // test value

        $actual = $this->filter->isBanned('black');
        $this->assertTrue($actual);

        $actual = $this->filter->isBanned('red');
        $this->assertFalse($actual);
    }

    public function testAllowForOkWords(){
        //$filter = new ProfanityFilter();
        $actual = $this->filter->isBanned('red');
        $this->assertFalse($actual);
    }

    public function testAllowForMultipleWords(){
        //$filter = new ProfanityFilter();
        $actual = $this->filter->isBanned('white black red');
        $this->assertFalse($actual);
    }

    public function testAllowForMixedContent(){
        //$filter = new ProfanityFilter();
        $actual = $this->filter->isFiltered('white black red');
        $this->assertEquals('* * red',$actual);
        //$this->assertTrue($actual);
    }

  
    public function testAllowWithExtraStopWords(){
        $filter = new ProfanityFilter(['green']);
        $actual = $filter->isBanned('green');
        $this->assertFalse($actual);

        $actual = $filter->isBanned('white');
        $this->assertTrue($actual);
    }
}
?>