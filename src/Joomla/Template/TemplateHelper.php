<?php
/**
 * =============================================================================
 *
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 * =============================================================================
 */

namespace TCorp\Joomla\Template;

use \ScssPhp\ScssPhp\Compiler AS SCSSCompiler;



/**
 * Helper class for working with Joomla template extensions
 */
class TemplateHelper
{


    public static function compileSCSS(string $inputFile, string $outputFile)
    {
        // Load the SCSS code from file
        $scss = file_get_contents($inputFile);

        // Compile the SCSS to CSS
        $compiler = new SCSSCompiler();
        $compiler->setFormatter('ScssPhp\ScssPhp\Formatter\Compact');
        $css = $compiler->compile($scss);

        // save the generated CSS to file
        file_put_contents($outputFile, $css);
    }

}
