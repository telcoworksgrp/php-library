<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Acma\NumSystem;

use \League\Flysystem\Filesystem;
use \League\Flysystem\ZipArchive\ZipArchiveAdapter;


/**
 * Helper class for working with ACMA's "Numbering System"
 */
class Helper
{


    /**
     * Download and ACMA's register of numbers from thier website, extract
     * the data and return a RAW CSV file
     * -------------------------------------------------------------------------
     * @return string   A raw CSV file containing the register of numbers
     */
    public static function downloadRegisterOfNumbers()
    {
        // Download the ZIP file and save it to a tempory location
        $tempFilename = tempnam(sys_get_temp_dir());
        $url = 'https://www.thenumberingsystem.com.au/download/' .
            'EnhancedFullDownload.zip';
        file_put_contents($tempFilename, file_get_contents($url));

        // Extract the CSV file which contains the registar of numbers
        $zipReader = new Filesystem(new ZipArchiveAdapter($zipFilename));
        $result = $zipReader->read('EnhancedFullDownload.csv');

        // Return the result
        return $result;
    }


}
