<?php
/**
* The focus of this file is completely on the HTMLPage class.
*/
namespace protofast;


/**
 * A HTMLPage is an extension for Page with some
 * useful predefined getters and setters for a nicer syntax, for
 * example setTitle.
 */
class HTMLPage extends Page {
  /**
   * A list of Additional stylesheets.
   */
  public $additional_stylesheets = array();

  /**
   * A list of Additional script.
   */
  public $additional_scripts = array();

  /**
   * Sets the replacement for the PAGE_TITLE variable.
   *
   * @param string $title the title of the page to set.
   */
  public function setTitle($title) {
    $this->replace('PAGE_TITLE', $title);
  }

  /**
   * Adds the given path in the stylesheet section.
   *
   * @param string $path relative or absolute path pointing to the
   *                      stylesheet.
   */
   public function addStylesheet($path) {
    array_push($this->additional_stylesheets, $path);
  }

  /**
   * Adds the given path in the scripts section.
   *
   * @param string $path relative or absolute path pointing to the
   *                      script.
   */
   public function addScript($path) {
    array_push($this->additional_scripts, $path);
  }

  /**
   * {@inheritDoc}
   */
  public function get_replace_tokens(){
      $tokens = parent::get_replace_tokens();
      $stylesheets = _generate_additional_resource('<link rel="stylesheet" type="text/css" href="%s">',
                                    $this->additional_stylesheets,
                                    $this->configuration->stylesheet_direcotry,
                                    "css"
      );

      $scripts =  _generate_additional_resource('<script src="%s"></script>',
                                    $this->additional_scripts,
                                    $this->configuration->script_direcotry,
                                    "js"
      );

      $tokens['ADDITIONAL_STYLESHEETS'] = $stylesheets;
      $tokens['ADDITIONAL_SCRIPTS'] = $scripts;

     return $tokens;
  }

  /**
   * A simple utility method to generate a string which includes additional resources (js/css) into a page.
   *
   * This utility method generates a HTML string that loads the given list of addtional resources. It might also include
   * files by convention. A file is included by convention if it exists in the given $convention_directory and ends with the
   * given $convention_extension (eg. a *.js file in the js/ directory).
   *
   * An example usage would be:
   *     _generate_additional_resource('<script src="%s"></script>',array('1.js', '2.js'), 'scripts/', 'js');
   *
   * @param string $pattern the pattern which is used for each resourc
   * @param array $additional_list the list of additional resources
   * @param string $convention_directory the directory to look for conventional matches in.
   * @param string $convention_extension the file extension to look for conventional matches.
   */
  private function _generate_additional_resource($pattern, $additional_list, $convention_directory, $convention_extension){
    // If a script with the same name exists, include it.
    if ($this->configuration->include_by_convention) {
      $path = sprintf("%s/%s.%s",
                      $convention_directory,
                      basename($_SERVER["SCRIPT_FILENAME"], ".php"),
                      $convention_extension
      );

      if(file_exists($path) && !in_array($path, $additional_list)){
        array_push($additional_list, $path);
      }
    }

    $html = "";
    foreach ($additional_list as $path){
      $html .= sprintf($pattern, $path);
    }

    return $html;
  }

}
?>
