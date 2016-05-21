<?php

namespace PhpTabs\Test;

use PhpTabs\PhpTabs;

class PhpTabsGuitarPro5Test extends \PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->filename = 'testSimpleTab.gp5';
    $this->tablature = new PhpTabs(__DIR__ . '/samples/' . $this->filename);
  }

  public function tearDown()
  {
    unset($this->tablature);
  }

  /**
   * Tests read mode with a simple tablature
   * Guitar Pro 5
   */
  public function testReadModeWithSimpleGuitarPro5Tab()
  {
    # Errors
    $this->assertEquals(false, $this->tablature->hasError());
    $this->assertEquals(null, $this->tablature->getError());
    
    # Meta attributes
    $this->assertEquals('Testing name', $this->tablature->getName());
    $this->assertEquals('Testing artist', $this->tablature->getArtist());
    $this->assertEquals('Testing album', $this->tablature->getAlbum());
    $this->assertEquals('Testing author', $this->tablature->getAuthor());
    $this->assertEquals('Testing copyright', $this->tablature->getCopyright());
    $this->assertEquals('Testing writer', $this->tablature->getWriter());
    $this->assertEquals("Testing comments line 1\nTesting comments line 2"
      , $this->tablature->getComments());
    $this->assertEquals('', $this->tablature->getDate());       #Not supported by Guitar Pro 5
    $this->assertEquals('', $this->tablature->getTranscriber());#Not supported by Guitar Pro 5

    # Tracks
    $this->assertEquals(1, $this->tablature->countTracks());
    $this->assertContainsOnlyInstancesOf('PhpTabs\\Model\\Track', $this->tablature->getTracks());
    $this->assertEquals(null, $this->tablature->getTrack(42));
    $this->assertInstanceOf('PhpTabs\\Model\\Track', $this->tablature->getTrack(0));

    # Channels
    $this->assertEquals(1, $this->tablature->countChannels());
    $this->assertContainsOnlyInstancesOf('PhpTabs\\Model\\Channel', $this->tablature->getChannels());
    $this->assertEquals(null, $this->tablature->getChannel(42));
    $this->assertInstanceOf('PhpTabs\\Model\\Channel', $this->tablature->getChannel(0));

    # Instruments
    $this->assertEquals(1, $this->tablature->countInstruments());
    $expected = array(
      0 => array (
        'id'   => 24,
        'name' => 'Nylon Str Guitar'
      )
    );
    $this->assertArraySubset($expected, $this->tablature->getInstruments());
    $this->assertEquals(null, $this->tablature->getInstrument(42));
    $this->assertArraySubset($expected[0], $this->tablature->getInstrument(0));

    # MeasureHeaders
    $this->assertEquals(69, $this->tablature->countMeasureHeaders());
    $this->assertContainsOnlyInstancesOf('PhpTabs\\Model\\MeasureHeader', $this->tablature->getMeasureHeaders());
    $this->assertEquals(null, $this->tablature->getMeasureHeader(72));
    $this->assertInstanceOf('PhpTabs\\Model\\MeasureHeader', $this->tablature->getMeasureHeader(0));
    
    $this->assertInstanceOf('PhpTabs\\Component\\Tablature', $this->tablature->getTablature());
  }
}