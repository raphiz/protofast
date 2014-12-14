<?php

namespace protofast;

class RenderEngineTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests if not declared variables disappear.
     */
    public function testUnsetVariablesDisappear()
    {
        // Fake SCRIPT_FILENAME for test purposes...
        $_SERVER["SCRIPT_FILENAME"] = getcwd() . "/tests/data/example.php";

        $page = new HTMLPage();

        $renderer = new RenderEngine($page);

        $result = $renderer->render($page);

        $this->assertEquals("Hello \n", $result);
    }

    /**
     * Tests if the basic search-replace works.
     */
    public function testBasicReplacement()
    {
        // Fake SCRIPT_FILENAME for test purposes...
        $_SERVER["SCRIPT_FILENAME"] = getcwd() . "/tests/data/example.php";

        $page = new HTMLPage();
        
        $page->replace('name', "Peter");

        $renderer = new RenderEngine($page);

        $result = $renderer->render($page);

        $this->assertEquals("Hello Peter\n", $result);

    }
}
