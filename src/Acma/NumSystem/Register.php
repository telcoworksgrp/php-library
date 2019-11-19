<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Acma\NumSystem;

use \League\Flysystem\Filesystem;
use \League\Flysystem\ZipArchive\ZipArchiveAdapter;
use \League\Csv\Reader AS CsvReader;


/**
 * Class for downloading and managing the ACMA (Australian Communications
 * and Media Authority) numbering system registrar
 *
 * @see https://www.thenumberingsystem.com.au
 */
class Register
{

    /**
     * Contains a list of registar entries
     *
     * @var \TCorp\Acma\NumSystem\RegisterEntry[]
     */
    public $entries = [];



    /**
     * Download ACMA's CSV list of numbers
     * -------------------------------------------------------------------------
     * @return void
     */
    public function download()
    {
        // Download the ZIP file and save it to a tempory location
        $filename = tempnam(sys_get_temp_dir(), '');
        $url = 'https://www.thenumberingsystem.com.au/download/EnhancedFullDownload.zip';
        file_put_contents($filename, file_get_contents($url));

        // Extract the CSV file which contains the registar of numbers
        $zipReader = new Filesystem(new ZipArchiveAdapter($filename));
        $result = $zipReader->read('EnhancedFullDownload.csv');

        // Process the CSV data
        $csvReader = CsvReader::createFromString($result);
        $csvReader->setHeaderOffset(0);

        $this->entries = [];
        foreach ($csvReader as $record) {
            $this->entries[] = new RegisterEntry($record);
        }

    }

}
