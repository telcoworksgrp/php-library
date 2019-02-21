<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Acma;

use \League\Flysystem\Filesystem;
use \League\Flysystem\ZipArchive\ZipArchiveAdapter;
use \League\Csv\Reader AS CsvReader;


/**
 * Helper class for working with ACMA's "Numbering System"
 */
class NumSystem
{


    /**
     * Download, extract, parse and then return ACMA's register of numbers from
     * thier website. This method may take allot of time to complete. Caching
     * the result is recommended. ACMA updated the register of numbers once
     * every day at midnight.
     * -------------------------------------------------------------------------
     * @return string   A very large array of records parsed from the data.
     */
    public static function downloadRegisterOfNumbers()
    {
        // Download the ZIP file and save it to a tempory location
        $filename = tempnam(sys_get_temp_dir(), '');
        $url = 'https://www.thenumberingsystem.com.au/download/EnhancedFullDownload.zip';
        file_put_contents($filename, file_get_contents($url));

        // Extract the CSV file which contains the registar of numbers
        $zipReader = new Filesystem(new ZipArchiveAdapter($filename));
        $result = $zipReader->read('EnhancedFullDownload.csv');

        // Parse the CSV data
        $csvReader = CsvReader::createFromString($result);
        $csvReader->setHeaderOffset(0);
        $result = iterator_to_array($csvReader->getRecords());

        // Return the result
        return $result;
    }


}
