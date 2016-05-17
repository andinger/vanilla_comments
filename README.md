## vanilla_comments

Easily integrate embedded comments feature of Vanilla Forums into tx_news.
Supports:

* Show number of comments in ListView via ViewHelper
* Show and add comments in DetailView via ViewHelper
* Get number of comments of specific news via Webservice-Method

### ViewHelpers in Fluid-Templates

    // namespace
    {namespace vanilla=Andinger\VanillaComments\ViewHelpers}
    
    // get comments count in list view
    <vanilla:count news="{newsItem}" />
    
    // comments in detail view
    <vanilla:comments news="{newsItem}" />
    
### Service Class

    $service = Andinger\VanillaComments\Services\CountService::getInstance();
    
    // add complete news list to reduce the number of slow webservice calls
    // if $newsItem doesn't exist in $allNewsInList, 0 is returned ...
    
    $count = $service->getCount($allNewsInList, $newsItem);
    
### Install

* Install Vanilla Forum with JsConnect-Extension
* Git clone extension into Extension-Directory
* Install via Extension Manager
* Add the following line into the typo3-htaccess-file

    _RewriteRule ^routing/(.*)$ /index.php?eID=routing&route=$1 [QSA,L]_

* Configure JsConnect-Plugin in Vanilla Forum with the following SSO-Path: 

    _http://<typo3-url>/routing/vanilla_comments/sso_  

* Define Client-Id and Secret in Vanilla Forum ... Save
* Fill in Client-Id, Secret and Vanilla-Forum-URL in extension-config in TYPO3-Extension Manager
* Done

### TYPO3-Integration

* Enable/Disable comments per News-Record
* Define ID of Vanilla-Forum category in TYPO3-sys_category-Records
    
