<?php
/**
 * StatusNet, the distributed open-source microblogging tool
 *
 * A version stamp for the API
 *
 * PHP version 5
 *
 * LICENCE: This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  API
 * @package   StatusNet
 * @author    Evan Prodromou <evan@status.net>
 * @author    Zach Copley <zach@status.net>
 * @copyright 2009 StatusNet, Inc.
 * @license   http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License version 3.0
 * @link      http://status.net/
 */

if (!defined('STATUSNET')) {
    exit(1);
}

require_once INSTALLDIR . '/lib/apiprivateauth.php';

/**
 * Returns a version number for this version of StatusNet, which
 * should make things a bit easier for upgrades.
 * URL: http://identi.ca/api/statusnet/version.(xml|json)
 * Formats: xml, js
 *
 * @category API
 * @package  StatusNet
 * @author   Evan Prodromou <evan@status.net>
 * @author   Zach Copley <zach@status.net>
 * @license  http://www.fsf.org/licensing/licenses/agpl-3.0.html GNU Affero General Public License version 3.0
 * @link     http://status.net/
 */

class ApiStatusnetVersionAction extends ApiPrivateAuthAction
{
    /**
     * Take arguments for running
     *
     * @param array $args $_REQUEST args
     *
     * @return boolean success flag
     *
     */

    function prepare($args)
    {
        parent::prepare($args);
        return true;
    }

    /**
     * Handle the request
     *
     * @param array $args $_REQUEST data (unused)
     *
     * @return void
     */

    function handle($args)
    {
        parent::handle($args);

        switch ($this->format) {
        case 'xml':
            $this->initDocument('xml');
            $this->element('version', null, STATUSNET_VERSION);
            $this->endDocument('xml');
            break;
        case 'json':
            $this->initDocument('json');
            print '"'.STATUSNET_VERSION.'"';
            $this->endDocument('json');
            break;
        default:
            $this->clientError(
                _('API method not found.'),
                404,
                $this->format
            );
            break;
        }
    }

    /**
     * Return true if read only.
     *
     * MAY override
     *
     * @param array $args other arguments
     *
     * @return boolean is read only action?
     */

    function isReadOnly($args)
    {
        return true;
    }

}

