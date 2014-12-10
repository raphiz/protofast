<?php

namespace protofast;

class ProtofastTest extends \PHPUnit_Framework_TestCase {

  /**
   * Verifies that the relevant default attributes are set properly if no
   * arguments are passed to the HTMLPage constructor
   */
  function test_attributes_with_nonargs_constructor(){
    $page = new HTMLPage();
    // Verify the template directory.
    // This is in vendor/bin since this is the "server script name"
    $this->assertEquals('vendor/bin/templates/', $page->template_dir);

    // By default, the "server script name" is taken as name for the template
    $this->assertEquals('phpunit', $page->template_name);

  }

  /**
   * Verifies that the relevant default attributes are set properly if no
   * arguments are passed to the HTMLPage constructor
   */
  function test_attributes_with_nonargs_constructor(){
    $page = new HTMLPage();
    // Verify the template directory.
    // This is in vendor/bin since this is the "server script name"
    $this->assertEquals('vendor/bin/templates/', $page->template_dir);

    // By default, the "server script name" is taken as name for the template
    $this->assertEquals('phpunit', $page->template_name);

  }

}
?>
