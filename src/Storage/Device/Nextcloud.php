<?php

namespace Utopia\Storage\Device;

use Utopia\Storage\Device\Webdav;
use Utopia\Storage\Storage;

class Nextcloud extends Webdav
{
    /**
     * Nextcloud Constructor
     *
     * @param string $url
     * @param string $root
     * @param string $username
     * @param string $password
     */
    public function __construct(string $url, string $root, string $username, string $password)
    {
        $url = $url."/remote.php/dav/files/".$username;
        parent::__construct($url, $root, $username, $password);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Nextcloud Storage';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Nextcloud Storage';
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return Storage::DEVICE_NEXTCLOUD;
    }
}