<?php
/**
 * See class RenderEngine.
 */
namespace protofast;

/**
 * Renders a page. This could be replaced with twig or a similar render engine.
 */
class RenderEngine
{

    /**
     * Renders the given page.
     *
     * This method performs the actuall rendering. This would be the right
     * Place to interact with template engines etc.
     *
     * @param \protofast\Page $page the page to render.
     */
    public function render($page)
    {
        $template = $this->readTemplate($page);
        $declarations = $this->findAllDeclarations($page->configuration, $template);
        $tokens = $page->getReplaceTokens();

        for ($i = 0; $i < count($declarations[0]); $i++) {
            $full_variable_name = $declarations[0][$i];
            $name = $declarations[1][$i];

            if (array_key_exists($name, $tokens)) {
              // Replace the variable with it's value if it's declared
                $template = str_replace($full_variable_name, $tokens[$name], $template);
            } elseif ($page->configuration->unset_variables_disappear) {
              // Replace the variable with an empty string if it does not exist.
                $template = str_replace($full_variable_name, "", $template);
            }
        }

         // Return the processed string.
         return $template;
    }

    /**
     * Finds all variable declarations in the given template string and returns them
     * in an array,
     *
     * @param \protofast\PageConfiguration $configuration The configuration of the page to render.
     * @param string $template the full template string to render
     *
     * @return An array that contains all matches as well as two groups (see preg_match_all):
     * The first group is the full variable name with the start/end markers (eg. {{myvar}}))
     * whereas the second group only consists of the variable name, (eg. myvar).
     */
    private function findAllDeclarations($configuration, $template)
    {
        // Evaluate the regexp to search for variables in the template string.
        $pattern = sprintf(
            "(%s([a-zA-Z_-]*)%s)",
            $configuration->variable_before,
            $configuration->variable_after
        );

        // Find all variables in the template string
        preg_match_all($pattern, $template, $result);

        return $result;
    }

    /**
     * Returns the template for the given page.
     *
     * Returns the template of the given page as string. The template is loaded
     * from the file system - relative from the called script file.
     *
     * @param \protofast\Page $page the page to get the template for.
     */
    private function readTemplate($page)
    {
      // Evaluate the direcory, in which the templates are located.
      // This is the "templates" direcory relative from the actually called script.
        $template_path = sprintf(
            "%s/%s/%s.%s",
            dirname($_SERVER["SCRIPT_FILENAME"]),
            $page->configuration->template_directory,
            $page->template_name,
            $page->configuration->template_extension
        );
        return file_get_contents($template_path);
    }
}
