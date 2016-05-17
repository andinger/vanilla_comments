<?php

namespace Andinger\VanillaComments\ViewHelpers;


use GeorgRinger\News\Domain\Model\News;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CommentsViewHelper extends AbstractViewHelper
{
    /**
     * @param News $news
     * @return string
     */
    public function render(News $news)
    {
        $config = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['vanilla_comments']);
        $user = $GLOBALS['TSFE']->fe_user->user;

        $userData['name'] = $user['name'];
        $userData['uniqueid'] = $user['username'];
        $userData['client_id'] = $config['client_id'];

        $string = base64_encode(json_encode($userData));
        $timestamp = time();
        $hash = hash_hmac('sha1', $string . ' ' . $timestamp, $config['secret']);

        $vanillaSso = $string.' '.$hash.' '.$timestamp.' hmacsha1';

        $categoryId = $news->getFirstCategory() ? $news->getFirstCategory()->getVanillaForumId() : '';

        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFooterInlineCode('vanilla_comments', sprintf("var vanilla_forum_url = '%s';
var vanilla_identifier = 'news-%d';
var vanilla_sso = '%s';
var vanilla_title = '%s';
var vanilla_category_id = '%s';

(function() { var vanilla = document.createElement('script'); vanilla.type = 'text/javascript'; var timestamp = %s; vanilla.src = vanilla_forum_url + '/js/embed.js'; (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(vanilla); })();",
            $config['url'],
            $news->getUid(),
            $vanillaSso,
            $news->getTitle(),
            $categoryId,
            $timestamp
        ));

        return '<div id="vanilla-comments"></div>';
    }
}