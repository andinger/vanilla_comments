<?php

namespace Andinger\VanillaComments\Services;


use GeorgRinger\News\Domain\Model\News;

class CountService
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var CountService
     */
    static $instance = null;

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if(self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getCount(News $news, $allNewsItems=null)
    {
        if($allNewsItems !== null) {
            $this->fetchCounts($allNewsItems);
        }

        $newsId = $news->getUid();

        return array_key_exists($newsId, $this->data) ? $this->data[$newsId] : 0;
    }

    /**
     * @param News[] $allNewsItems
     * @return array
     */
    public function fetchCounts($allNewsItems)
    {
        if(empty($this->data)) {
            $getParams = '';

            foreach ($allNewsItems as $news) {
                $getParams .= 'vanilla_identifier[]=news-' . $news->getUid() . '&';
            }

            $config = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['vanilla_comments']);
            $url = $config['url'] . '/discussions/getcommentcounts.json?' . $getParams;

            $arrContextOptions=array(
                'ssl'=>array(
                    'verify_peer'=>false,
                    'verify_peer_name'=>false,
                ),
            );

            $response = json_decode(file_get_contents($url, false, stream_context_create($arrContextOptions)), true);

            if (array_key_exists('CountData', $response)) {
                foreach ($response['CountData'] as $newsId => $count) {
                    $this->data[str_replace('news-', '', $newsId)] = $count;
                }
            }
        }
    }
}