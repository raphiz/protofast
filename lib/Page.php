<?php
/**
 * Page is th
 */
namespace protofast;

/**
 * A Page is basically the configuration for the renderer to be rendered.
 */
class Page
{

    /**
    * The name of the template to
    */
    public $template_name = null;

    /**
     * A key/value array of variables to replace.  The key is the variable
     * to replace and the value the actual replacement value.
     */
    public $replace_token = array();

    /**
     * Constructor.
     * @param string $template_name (optional) if not equal to the script name, an
     *                              alternative name for the current page.
     */
    public function __construct()
    {
        //  Load the configuration
        $config_file = dirname($_SERVER["SCRIPT_FILENAME"]) . "/protofast.ini";
        $this->configuration = new PageConfiguration($config_file);
        $this->renderer = new RenderEngine($this);

        // Get the name of the actually called script (withoth the ".php" suffic)
        // and use this one as template name.
        $this->template_name = basename($_SERVER["SCRIPT_FILENAME"], ".php");

        // If a parameter is given, override the template name with it.
        if (func_num_args() == 1) {
          // Set the template name if it is given as the first argument of the constructor.
            $this->template_name = func_get_arg(0);
        }

    }

    /**
     * Replace the given variable with the given replacement.
     *
     * This will then later made available to the renderer
     * using the {@link protofast\Page::getReplaceTokens()} method.
     *
     * @param string    $variable the name of the variable to replace _without any
     * brackets_ (eg. ``myvar``, not ``{{myvar}}``).
     * @param string    $replacement the value with which the $variable shall be replaced
     */
    public function replace($variable, $replacement)
    {
        $this->replace_token[$variable] = $replacement;
    }

    /**
     * Renders the page and prints it out.
     *
     * Renders the current page using the {@link protofast\RenderEngine}  and then prints the HTML out using
     * the ``echo`` method.
     */
    public function render()
    {
        echo $this->renderer.render($this);
    }

    /**
     * Returns all replace tokens(variables in the template) for the render engine.
     * @return array an array with the variable name as key and it's replacement value as
     * string value.
     */
    public function getReplaceTokens()
    {
        return $this->replace_token;
    }
}
