<?php
/**
 * See: PageConfiguration.
 */

namespace protofast;

/**
 * The PageConfiguration class allows to simply configure protofast.
 * It loads user specific configuration values and makes them easily accessible
 * as attributes (eg. $configuration->property)
 *
 * @property string stylesheet_direcotry The directory that contains the stylesheets.
 * This is mainly used for loading by convention.
 * @property string script_direcotry The directory that contains the scripts.
 * This is mainly used for loading by convention.
 * @property boolean include_by_convention if set to true, the HTMLPage will automatically
 * include stylesheets/scripts with the same name as the script from the coresponding directories.
 * @property string variable_before Declars how a variable is introduced in the template.
 * @property string variable_after Declars how a variable declaration ends in the template.
 * @property string base_template_name the name of the base template to use as root for all templates.
 * @property string template_extension the extension of all template names.
 * @property string template_directory the directory rellative to the called scipt to look for templates
 * (without trailing slashes)
 * @property string unset_variables_disappear if set to true, all unset variables will be removed from the
 * template when it is rendered.
 */
class PageConfiguration
{

    /**
     * The loaded configuration.
     */
    private $configurations = null;

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
    public function __construct($configuration_file)
    {
        $this->configurations = $this->load($configuration_file);
    }

    /**
     * This utility method performs the actual act of loading the configuration
     * file.
     * @param string $configuration_file the absolute/relative path to the *.ini
     *                                    configuration file.
     */
    private function load($configuration_file)
    {

        // Skip if the file does not exist...
        if (!file_exists($configuration_file)) {
            return $this->defaults;
        }

        // Parse the user configuration
        $user_configuration = parse_ini_file($configuration_file);

        // Merge user configrations with the defaults
        return array_merge($this->defaults, $user_configuration);
    }

    /**
     * Implentation of the get magic method. This simplifies
     * the access of the configuration values.
     * @param string $property the property to get.
     */
    public function __get($property)
    {
        if (array_key_exists($property, $this->defaults)) {
            return $this->configurations[$property];
        }
    }
}
