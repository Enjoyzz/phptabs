<?php

namespace PhpTabsTest\Reader;

use PHPUnit_Framework_TestCase;
use PhpTabs\PhpTabs;

class PhpTabsMidiTest extends PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->filename = 'testSimpleMidi.mid';
    $this->tablature = new PhpTabs(PHPTABS_TEST_BASEDIR . '/samples/' . $this->filename);
  }

  /**
   * Tests read mode with a simple file
   * MIDI format
   */
  public function testReadModeWithSimpleMidiFile()
  {
    # Errors
    $this->assertEquals(false, $this->tablature->hasError());
    $this->assertEquals(null, $this->tablature->getError());
    
    # Meta attributes
    $this->assertEquals('', $this->tablature->getName());       #Not supported by Midi
    $this->assertEquals('', $this->tablature->getArtist());     #Not supported by Midi
    $this->assertEquals('', $this->tablature->getAlbum());      #Not supported by Midi
    $this->assertEquals('', $this->tablature->getAuthor());     #Not supported by Midi
    $this->assertEquals('', $this->tablature->getCopyright());  #Not supported by Midi
    $this->assertEquals('', $this->tablature->getWriter());     #Not supported by Midi
    $this->assertEquals('', $this->tablature->getComments());   #Not supported by Midi
    $this->assertEquals('', $this->tablature->getDate());       #Not supported by Midi
    $this->assertEquals('', $this->tablature->getTranscriber());#Not supported by Midi

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

    # MeasureHeaders
    $this->assertEquals(1, $this->tablature->countMeasureHeaders());
    $this->assertContainsOnlyInstancesOf('PhpTabs\\Model\\MeasureHeader', $this->tablature->getMeasureHeaders());
    $this->assertEquals(null, $this->tablature->getMeasureHeader(42));
    $this->assertInstanceOf('PhpTabs\\Model\\MeasureHeader', $this->tablature->getMeasureHeader(0));

    # Instruments
    $this->assertEquals(1, $this->tablature->countInstruments());
    $expected = array(
      0 => array (
        'id'   => 0,
        'name' => 'Piano'
      )
    );
    $this->assertArraySubset($expected, $this->tablature->getInstruments());
    $this->assertEquals(null, $this->tablature->getInstrument(42));
    $this->assertArraySubset($expected[0], $this->tablature->getInstrument(0));
    
    $this->assertInstanceOf('PhpTabs\\Component\\Tablature', $this->tablature->getTablature());
  }

  public function tearDown()
  {
    unset($this->tablature);
  }
}