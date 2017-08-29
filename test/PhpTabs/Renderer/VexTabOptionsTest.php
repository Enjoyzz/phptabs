<?php

namespace PhpTabsTest\Renderer;

use Exception;
use PHPUnit_Framework_TestCase;
use PhpTabs\PhpTabs;
use PhpTabs\Music\Track;

/**
 * Tests the options stack of vextab renderer
 */
class VexTabOptionsTest extends PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->filename  = 'testSimpleTab.gp3';
    $this->tablature = new PhpTabs(PHPTABS_TEST_BASEDIR . '/samples/' . $this->filename);
  }

  /**
   * Tests for getOption() method
   */
  public function testGetOption()
  {
    // Available options
    // This test includes boolean to string transformation
    $options = [
      // Renderer options
      'measures_per_stave'  => 1,

      // Global options
      'space'               => 16,        # An integer
      'scale'               => 0.8,       # A float or an integer
      'stave-distance'      => 20,        # An integer
      'width'               => 500,       # An integer, in pixel

      'font-size'           => 12,        # An integer
      'font-face'           => 'times',   # A string
      'font-style'          => 'italic',  # A string

      'tab-stems'           => true,      # A boolean, default: false
      'tab-stem-direction'  => 'down',    # A string up|down, default: up
      'player'              => false,     # A boolean, default: false

      // Tabstaves options
      'notation'            => true,       # A boolean, default: false
      'tablature'           => true,       # A boolean, default: true
    ];

    $renderer = $this->tablature
      ->getRenderer('vextab')
      ->setOptions($options);

    # Check values
    foreach ($options as $name => $value) {
      if ($value === true) {
//        $value = 'true';
      } elseif ($value === false) {
//        $value = 'false';
      }

      $this->assertEquals(
        $value,
        $renderer->getOption($name),
        sprintf(
          "Name: %s, given: %s, expected: %s", 
          $name,
          $renderer->getOption($name),
          $value
        )
      );
    }
  }

  /**
   * Tests for getOptions() method
   */
  public function testGetOptions()
  {
    // Available options
    // This test includes boolean to string transformation
    $options = [
      // Renderer options
      'measures_per_stave'  => 1,

      // Global options
      'space'               => 16,        # An integer
      'scale'               => 0.8,       # A float or an integer
      'stave-distance'      => 20,        # An integer
      'width'               => 500,       # An integer, in pixel

      'font-size'           => 12,        # An integer
      'font-face'           => 'times',   # A string
      'font-style'          => 'italic',  # A string

      'tab-stems'           => 'true',    # A boolean, default: false
      'tab-stem-direction'  => 'down',    # A string up|down, default: up
      'player'              => 'false',   # A boolean, default: false

      // Tabstaves options
      'notation'            => 'true',    # A boolean, default: false
      'tablature'           => 'true',    # A boolean, default: true
    ];

    $renderer = $this->tablature
      ->getRenderer('vextab')
      ->setOptions($options);

    $this->assertEquals(
      $options,
      $renderer->getOptions()
    );
  }

  public function tearDown()
  {
    unset($this->tablature);
  }
}