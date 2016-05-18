<?php

namespace Andinger\VanillaComments\Controller;


use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class SsoController extends ActionController
{
    const EXTKEY = 'vanilla_comments';

    /**
     * @var array
     */
    protected $config;

    /**
     * @var TypoScriptFrontendController
     */
    protected $typoscriptFrontendController;

    /**
     * @var DatabaseConnection
     */
    protected $db;

    /**
     * @var array
     */
    protected $user;

    public function initializeAction()
    {
        $this->typoscriptFrontendController = $GLOBALS['TSFE'];
        $this->db = $GLOBALS['TYPO3_DB'];
        $this->config = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][self::EXTKEY]);
        $this->user = $this->typoscriptFrontendController->fe_user->user;
    }

    public function ssoAction()
    {
        $callback = !empty($_GET['callback']) ? $_GET['callback'] : null;

        $userData = [
            'name' => '',
            'uniqueid' => '',
            'photourl' => '',
            'email' => '',
            'roles' => ''
        ];

        if($this->user) {
            $userData['name'] = $this->user['name'];
            $userData['uniqueid'] = $this->user['username'];
            $userData['email'] = $this->user['email'];
            $userData['roles'] = implode(',', $this->getGroups());

            if(trim($this->config['photoUrlTemplate'])) {
                $userData['photourl'] = str_ireplace('###username###', $this->user['username'], $this->config['photoUrlTemplate']);
            }

        }

        ksort($userData);

        $userData['signature'] = md5(http_build_query($userData) . $this->config['secret']);
        $userData['client_id'] = $this->config['client_id'];

        $output = json_encode($userData);

        if($callback) {
            $output = $callback . '('.$output.')';
        }

        header('Content-Type: application/javascript');

        echo $output;
        exit();
    }

    protected function getGroups()
    {
        $groups = $this->db->exec_SELECTgetRows('title', 'fe_groups', 'uid IN ('.$this->user['usergroup'].')');

        $groupNames = array_map(function($group) {
            return $group['title'];
        }, $groups);

        $defaultRoles = explode(',', $this->config['defaultRoles']);

        if(is_array($groupNames)) {
            foreach($defaultRoles as $defaultRole) {
                $groupNames[] = trim($defaultRole);
            }
        }
        else {
            $groupNames = $defaultRoles;
        }

        return $groupNames;
    }
}