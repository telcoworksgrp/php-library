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

namespace TCorp\Legacy;



/**
 * Legacy helper for working with the Australian Business Registrar's
 * ABN lookup API
 */
class AbnApi
{

    /**
     * Look up the details for a given ABN using an API
     * -------------------------------------------------------------------------
     * @param  string   $abn        The ABN to lookup
     * @param string    $apikey     ApiKey/GUID for authentication
     *
     * @return object   ABN details, or False if ABN not found
     */
    public static function getABNDetails(string $abn, string $apikey)
    {
        // Initialise some local variables
        $result = new \stdClass();

        // Look up the ABN details using ABR's API
        $url = "https://abr.business.gov.au/abrxmlsearch/" .
            "AbrXmlSearch.asmx/ABRSearchByABN";

        $data = Utils::sendRequest($url, 'GET', array(
            'searchString'             => $abn,
            'includeHistoricalDetails' => 'Y',
            'authenticationGuid'       => $apikey
        ));


        // Parse the data returned by the API
        $data = new \SimpleXMLElement($data);
        $data = $data->response;

        $exception = (string) $data->exception;
        if (empty($exception)) {

            $result->statement               = (string) $data->usageStatement;
            $result->abn                     = (string) $data->businessEntity->ABN->identifierValue;
            $result->current                 = (string) $data->businessEntity->ABN->isCurrentIndicator;
            $result->asicNo                  = (string) $data->businessEntity->ASICNumber;
            $entityType                      = $data->businessEntity->entityType;
            $result->entityType              = new \stdClass;
            $result->entityType->code        = (string) $entityType->entityTypeCode;
            $result->entityType->desc        = (string) $entityType->entityDescription;
            $legalName                       = $data->businessEntity->legalName;
            $result->legalName               = new \stdClass;
            $result->legalName->firstname    = (string) $legalName->givenName;
            $result->legalName->othername    = (string) $legalName->otherGivenName;
            $result->legalName->lastname     = (string) $legalName->familyName;
            $mainName                        = $data->businessEntity->mainName;
            $result->mainName                = new \stdClass;
            $result->mainName->organisation  = (string) $mainName->organisationName;
            $result->mainName->effective     = (string) $mainName->effectiveFrom;
            $tradeName                       = $data->businessEntity->mainTradingName;
            $result->tradeName               = new \stdClass;
            $result->tradeName->organisation = (string) $tradeName->organisationName;
            $result->tradeName->effective    = (string) $tradeName->effectiveFrom;

        } else {

            $result->statement               = '';
            $result->abn                     = '';
            $result->current                 = '';
            $result->asicNo                  = '';
            $result->entityType              = new \stdClass;
            $result->entityType->code        = '';
            $result->entityType->desc        = '';
            $result->legalName               = new \stdClass;
            $result->legalName->firstname    = '';
            $result->legalName->othername    = '';
            $result->legalName->lastname     = '';
            $result->mainName                = new \stdClass;
            $result->mainName->organisation  = '';
            $result->mainName->effective     = '';
            $result->tradeName               = new \stdClass;
            $result->tradeName->organisation = '';
            $result->tradeName->effective    = '';

        }

        // Return the result
        return $result;
    }

}
