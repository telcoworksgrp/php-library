<?php
/**
 * =============================================================================
 * @package     Telcoworks Group PHP Library
 * @author      David Plath <webmaster@telcoworksgrp.com.au>
 * @copyright   Copyright (c) 2020 Telcoworks Group. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TelcoworksGrp\Acma\NumSystem;

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
     * @var \TelcoworksGrp\Acma\NumSystem\RegisterEntry[]
     */
    public $entries = [];



    /**
     * Download ACMA's CSV list of numbers
     * -------------------------------------------------------------------------
     * @return void
     */
    public function download()
    {
        // Download the data archive to a tempory location
        $archiveUrl = "https://www.thenumberingsystem.com.au/download/EnhancedFullDownload.zip";
        $archiveFilename = tempnam(sys_get_temp_dir(), '');
        file_put_contents($archiveFilename, file_get_contents($archiveUrl));

        // Extract the csv file from the archive
        $csvFilename = tempnam(sys_get_temp_dir(), '');
        $archive = new \ZipArchive();
        $archive->open($archiveFilename);
        file_put_contents($csvFilename, $archive->getFromName('EnhancedFullDownload.csv'));

        // Parse the CSV file
        $csvReader = CsvReader::createFromPath($csvFilename, 'r');
        $csvReader->setHeaderOffset(0);

        $this->entries = [];
        foreach ($csvReader as $record) {
            if (in_array($record['Prefix'], [1300,1800])) {
                $this->entries[] = new RegisterEntry($record);
            }
        }
    }

}
