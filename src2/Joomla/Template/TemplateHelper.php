<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Joomla\Template;

use \Joomla\Registry\Registry;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Uri\Uri;


/**
 * Helper class for working with Joomla templates
 */
class TemplateHelper
{

    /**
     * The Template's name
     *
     * @var string
     */
    public $name = '';


    /**
     * Holds a copy of the template params
     *
     * @var \Joomla\Registry\Registry
     */
    public $params = null;


    /**
     * Base URL for this template
     *
     * @var string
     */
    public $baseUrl = '';


    /**
     * Holds a referance to the global document
     *
     * @var \Joomla\CMS\Document\Document
     */
    public $document = null;


    /**
     * Scripts to be rendered at the bootom of the document
     *
     * @var string[]
     */
    public $footerScripts = [];


    /**
     * Show the main component
     *
     * @var bool
     */
    public $showComponent = true;



    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param Registry  $params   Parameters belonging to the template
     */
    public function __construct(Registry $params)
    {
        // Initialise some class properties
        $this->params        = $params;
        $this->baseUrl       = Uri::base() . "templates/{$this->name}/";
        $this->document      = Factory::getDocument();
        $this->showComponent = !empty($this->document->getBuffer('component'));
    }


    /**
     * Add an external stylesheet to the document
     * -------------------------------------------------------------------------
     * @param string  $url          URL to the CSS stylesheet
     *
     * @return void
     */
    public function addStylesheet(string $url)
    {
        // Check if the URL is absolute or relative
        $absolute = preg_match('|^(https?:)?\/|i', $url);

        // Prepend baseURL if the given URL is relative
        $url = ($absolute) ? $url : $this->baseUrl . $url;

        // Add the stylesheet to the document
        $this->document->addStylesheet($url);
    }


    /**
     * Add external javascript to the document
     * -------------------------------------------------------------------------
     * @param string    $url        URL to the Javascript file
     */
    public function addHeadScript(string $url)
    {
        // Check if the URL is absolute or relative
        $absolute = preg_match('|^(https?:)?\/|i', $url);

        // Prepend baseURL if the given URL is relative
        $url = ($absolute) ? $url : $this->baseUrl . $url;

        // Add the script to the document.
        $this->document->addScript($url);
    }


    /**
     * Add external javascript to the document footer. These scripts need to
     * be rendered manually by calling the renderFooterScripts() method
     * -------------------------------------------------------------------------
     * @param string    $url        URL to the Javascript file
     */
    public function addFooterScript(string $url)
    {
        // Check if the URL is absolute or relative
        $absolute = preg_match('|^(https?:)?\/|i', $url);

        // Prepend baseURL if the given URL is relative
        $url = ($absolute) ? $url : $this->baseUrl . $url;

        // Add the script to the footer script list
        $this->footerScripts[$url] = $url;
    }


    /**
     * Render the list of footer javascripts
     * -------------------------------------------------------------------------
     * @return string
     */
    public function renderFooterScripts()
    {
        // Initialise some local variables
        $result = '';

        // Generate scripts tags
        foreach ($this->footerScripts as $url) {
            $result .= "<script src=\"{$url}\"></script>\n";
        }

        // Return the result
        return $result;
    }


	/**
	 * Initialise the template (add assets, set some values, etc)
	 * -------------------------------------------------------------------------
	 * @return void
	 */
	public function initialise()
	{
        // Set the document to HTML5
        $this->document->setHTML5(true);
    }

}
