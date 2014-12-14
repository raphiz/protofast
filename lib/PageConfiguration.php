<?php
/**
 * See: PageConfiguration.
 */

namespace protofast;

/**
 * The PageConfiguration class allows to simply configure protofast.
 * It loads user specific configuration values and makes them easily accessible
 * as attributes (eg. $configuration->property)
 */
class PageConfiguration {

  /**
   * These are the preset configuration values of protofast.
   */
  private $defaults = array (
    "stylesheet_direcotry"  => "css",
    "script_direcotry"  => "js",
    "include_by_convention" => true,
    "variable_before" => "{{",
    "variable_after" => "}}",
    "base_template_name" => "base.html",
    "template_extension" => "html",
    "template_directory" => "templates",
    "unset_variables_disappear" => true
  );

  /**
   * Default constructor.
   *
   * Takes exactly ONE parameter, which is the path to the configuration file.
  * The file will be loaded immediately!
   *
   * @param string $configuration_file  the absolute/relative path to the *.ini
   *                                    configuration file.
   */
  public function __construct($configuration_file) {
    $this->configurations = $this->_load($configuration_file);
  }

  /**
   * This utility method performs the actual act of loading the configuration
   * file.
   * @param string $configuration_file the absolute/relative path to the *.ini
   *                                    configuration file.
   */
  private function _load($configuration_file){

    // Skip if the file does not exist...
    if(!file_exists($configuration_file)) {
      return $this->defaults;
    }

    // Parse the specific configuration
    $specific_configuration = parse_ini_file($configuration_file);

    // Merge specific configrations with the defaults
    return array_merge($this->defaults, $specific_configuration);
  }

  /**
   * Implentation of the get magic method. This simplifies
   * the access of the configuration values.
   * @param string $property the property to get.
   */
  public function __get($property) {
    if (array_key_exists($property, $this->defaults)) {
      return $this->configurations[$property];
    }
  }
}
