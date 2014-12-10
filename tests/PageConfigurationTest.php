<?php

namespace protofast;

class PageConfigurationTest extends \PHPUnit_Framework_TestCase {

  /**
   * Verifies that the PageConfiguration class still works if the
   * configuration file does not exist.
   */
  function test_nonexisting_configuration_file(){
    $configuration = new PageConfiguration('/not/existing');
    // Nothing should blow up...
    // Now check if the default options are accessible...
    $this->assertEquals('css', $configuration->stylesheet_direcotry);
  }

  /**
   * Verifies that the PageConfiguration class merges defaults and
   * specific values properly.
   */
  function test_merging_works(){
    $configuration = new PageConfiguration('tests/example.ini');

    // Verify if the values are overridden
    $this->assertEquals('styles', $configuration->stylesheet_direcotry);
    $this->assertEquals('scripts', $configuration->script_direcotry);
    $this->assertEquals(false, $configuration->include_by_convention);

  }

}
?>
