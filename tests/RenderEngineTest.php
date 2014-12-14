<?php

namespace protofast;

class RenderEngineTest extends \PHPUnit_Framework_TestCase
{

    /**
     * The render engine to work with, defined in the setup method.
     */
    protected $engine = null;

    /**
     * The example page to render, defined in the setup method.
     */
    protected $page = null;

    /**
     * Prepares an example page and engine to prevent code duplication.
     */
    public function setUp()
    {
        // Fake SCRIPT_FILENAME for test purposes...
        $_SERVER["SCRIPT_FILENAME"] = getcwd() . "/tests/data/example.php";

        $this->page = new HTMLPage();

        $this->engine = new RenderEngine();
    }

    /**
     * Tests if not declared variables disappear.
     */
    public function testUnsetVariablesDisappear()
    {

        $result = $this->engine->render($this->page);

        $this->assertEquals("Hello \n", $result);
    }

    /**
     * Tests if the basic search-replace works.
     */
    public function testBasicReplacement()
    {
        $this->page->replace('name', "Peter");

        $result = $this->engine->render($this->page);

        $this->assertEquals("Hello Peter\n", $result);

    }
}
