<?php

namespace PhpTabsTest\Writer;

use PHPUnit_Framework_TestCase;
use PhpTabs\PhpTabs;

class GuitarPro3ReaderTest extends PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->path = '/samples/testSimpleTab.gp3';
    $this->tablature = new PhpTabs(PHPTABS_TEST_BASEDIR . $this->path);
  }

  /**
   * Convert method
   */
  public function testConvert()
  {
    # Converts to default format (not specified)
    $this->assertEquals(
      file_get_contents(PHPTABS_TEST_BASEDIR . $this->path),
      $this->tablature->convert(),
      'Default build content should be the same as file content'
    );

    # Converts to gp3 format
    $this->assertEquals(
      file_get_contents(PHPTABS_TEST_BASEDIR . $this->path),
      $this->tablature->convert('gp3'),
      'GP3 build content should be the same as file content'
    );
  }

  /**
   * Save method
   */
  public function testSave()
  {
    # Converts to default format (not specified)
    $this->assertEquals(
      file_get_contents(PHPTABS_TEST_BASEDIR . $this->path),
      $this->tablature->save(),
      'Default save content should be the same as file content'
    );
  }

  public function tearDown()
  {
    unset($this->tablature);
  }
}