<?php
namespace Andinger\VanillaComments\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Andreas Keßler <typo3@andikessler.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * NewsDefault
 */
class NewsDefault extends \GeorgRinger\News\Domain\Model\NewsDefault
{

    /**
     * commentsEnabled
     *
     * @var bool
     */
    protected $commentsEnabled = false;
    
    /**
     * Returns the commentsEnabled
     *
     * @return bool $commentsEnabled
     */
    public function getCommentsEnabled()
    {
        return $this->commentsEnabled;
    }
    
    /**
     * Sets the commentsEnabled
     *
     * @param bool $commentsEnabled
     * @return void
     */
    public function setCommentsEnabled($commentsEnabled)
    {
        $this->commentsEnabled = $commentsEnabled;
    }
    
    /**
     * Returns the boolean state of commentsEnabled
     *
     * @return bool
     */
    public function isCommentsEnabled()
    {
        return $this->commentsEnabled;
    }

}