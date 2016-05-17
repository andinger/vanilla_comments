<?php

namespace Andinger\VanillaComments\ViewHelpers;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CountViewHelper extends AbstractViewHelper
{
    protected $config;

    public function initialize()
    {
        $this->config = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['vanilla_comments']);
        if($GLOBALS['EXT']['vanilla_comments'] === null) {
            $GLOBALS['EXT']['vanilla_comments'] = [];
        }
    }


    /**
     * @param \GeorgRinger\News\Domain\Model\NewsDefault $news
     * @return string
     */
    public function render($news)
    {
        $this->includeScript();

        $text = $news->getCommentsEnabled() ? 'no_comments' : 'comments_disabled';

        return '<span vanilla-identifier="news-'.$news->getUid().'">'.$this->translate($text).'</span>';
    }

    protected function includeScript()
    {
        if(!array_key_exists('scriptAlreadyIncluded', $GLOBALS['EXT']['vanilla_comments'])) {
            $GLOBALS['EXT']['vanilla_comments']['scriptAlreadyIncluded'] = true;

            /** @var PageRenderer $pageRenderer */
            $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
            $pageRenderer->addJsFooterInlineCode('vanilla_comments_count', sprintf("
var vanilla_forum_url = '%s';
var vanilla_comments_none = '%s';
var vanilla_comments_singular = '%s';
var vanilla_comments_plural = '%s';
    
(function() { var vanilla_count = document.createElement('script'); vanilla_count.type = 'text/javascript'; vanilla_count.src = vanilla_forum_url + '/js/count.js'; (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(vanilla_count); })();",
                $this->config['url'],
                $this->translate('no_comments'),
                $this->translate('one_comment'),
                $this->translate('num_comments')
            ));
        }
    }

    protected function translate($key)
    {
        return LocalizationUtility::translate($key, 'vanilla_comments');
    }
}