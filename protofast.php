<?php
/**
* Protofast - Quickly create a HTML mocks without duplicating code
*
* Version: 1.0.0
*
* Website: https://github.com/raphiz/protofast
*
* License: MIT (http://opensource.org/licenses/MIT)
*
* Copyright (c) 2014 Raphael Zimmermann
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*/

class HTMLPage {

  private $configuration = array (
    "stylesheet_direcotry"  => "css",
    "script_direcotry"  => "js",
    "include_by_convention" => true,
    "variable_before" => "{{",
    "variable_after" => "}}",
    "base_template_name" => "base.html",
    "template_extension" => ".html",
    "template_directory" => "templates"
  );

  // The directory in which the HTML templates are located.
  private $template_dir = NULL;

  // The name of the template to
  private $template_name = NULL;

  // A key/value array of variables to replace.  The key is the variable
  // to replace and the value the actual replacement value.
  private $replace_token = array();

  // A list of Additional stylesheets
  private $additional_stylesheets = array();

  // A list of Additional script
  private $additional_scripts = array();


  // Constructor
  // Takes one optional parameter: the template name
  function __construct() {
    // Read the protofast configuration
    $config_file = dirname($_SERVER["SCRIPT_FILENAME"]) . "/protofast.ini";
    if(file_exists($config_file)) {
      $user_configuration = parse_ini_file($config_file);
      $this->configuration = array_merge($this->configuration, $user_configuration);
    }
    // Evaluate the direcory, in which the templates are located.
    // This is the "templates" direcory relative from the actually called script.
    $this->template_dir = dirname($_SERVER["SCRIPT_FILENAME"]) . "/" . $this->configuration['template_directory']. "/";

    if (func_num_args() == 1) {
      // Set the template name if it is given as the first argument of the constructor.
      $this->template_name = func_get_arg(0);
    } else {
      // Get the name of the actually called script (withoth the ".php" suffic) and use this one as
      // template name.
      $this->template_name = basename($_SERVER["SCRIPT_FILENAME"], ".php");
    }

  }

  // Sets the replacement for the PAGE_TITLE variable.
  function setTitle($title) {
    $this->replace('PAGE_TITLE', $title);
  }

  // Adds the given path in the stylesheet section.
  function addStylesheet($path) {
    array_push($this->additional_stylesheets, $path);
  }

  // Adds the given script in the script section.
  function addScript($path) {
    array_push($this->additional_scripts, $path);
  }

  // replace the given variable with the given replacement.
  function replace($variable, $replacement){
    $this->replace_token[$variable] = $replacement;
  }


  function render(){
    // Clone the $this->replace_token into a local variable
    // in order to be reproducable
    $replacements = $this->replace_token;

    // Add stylesheet and script replacement variables to the replacements
    $replacements['ADDITIONAL_STYLESHEETS'] = $this->generate_additional_stylesheet_html();
    $replacements['ADDITIONAL_SCRIPTS'] = $this->generate_additional_scripts_html();

    // read the base and the specific template from the template directory
    $base_template = file_get_contents($this->template_dir . $this->configuration['base_template_name']);
    $content_template = file_get_contents($this->template_dir . $this->template_name . $this->configuration['template_extension']);

    // Replace the content variable in the base template with the specific template
    $base_template = $this->do_replace($base_template, "CONTENT", $content_template);

    // Replace all other variables
    foreach ($replacements as $variable => $value) {
      $base_template = $this->do_replace($base_template, $variable, $value);
    }

    // Print it out!
    echo $base_template;
  }

  function do_replace($template, $variable, $replacement) {
    $full_variable_name = $this->configuration['variable_before'] . $variable . $this->configuration['variable_after'];
    return str_replace($full_variable_name, $replacement, $template);
  }

  function generate_additional_stylesheet_html(){
    // If a stylesheet with the same name exists, include it.
    if ($this->configuration['include_by_convention']){
      // TODO: eventually allow less/sass values here...
      $path = $this->configuration['stylesheet_direcotry'] . "/" . basename($_SERVER["SCRIPT_FILENAME"], ".php") . ".css";
      if(file_exists($path) && in_array($path, $this->additional_stylesheets) == false){
        array_push($this->additional_stylesheets, $path);
      }
    }

    $html = "";
    foreach ($this->additional_stylesheets as $path){
      $html .= '<link rel="stylesheet" type="text/css" href="' . $path . '">';
    }
    return $html;
  }

  function generate_additional_scripts_html(){
    // If a script with the same name exists, include it.
    if ($this->configuration['include_by_convention']){
      // TODO: eventually allow dart etc. values here...
      $path = $this->configuration['script_direcotry'] . "/" . basename($_SERVER["SCRIPT_FILENAME"], ".php") . ".js";
      if(file_exists($path) && in_array($path, $this->additional_scripts) == false){
        array_push($this->additional_scripts, $path);
      }
    }

    $html = "";
    foreach ($this->additional_scripts as $path){
      $html .= '<script src="' . $path . '"></script>';
    }
    return $html;
  }

}
?>
