<?php

namespace Utopia\Storage\Device;

use Exception;
use Utopia\Storage\Device;
use Utopia\Storage\Storage;

class Webdav extends Device
{

    const METHOD_MKCOL = 'MKCOL';

    /**
     * @var string
     */
    protected $root;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * Webdav Constructor
     *
     * @param string $url
     * @param string $root
     * @param string $username
     * @param string $password
     */
    public function __construct(string $url, string $root, string $username, string $password)
    {
        $this->url = $url;
        $this->root = $root;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Webdav Storage';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Webdav Storage';
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return Storage::DEVICE_WEBDAV;
    }

    /**
     * @param string $filename
     * @param string $prefix
     *
     * @return string
     */
    public function getPath(string $filename, string $prefix = null): string
    {
        return $this->getRoot() . DIRECTORY_SEPARATOR . $filename;
    }

        /**
     * Upload.
     *
     * Upload a file to desired destination in the selected disk.
     * return number of chunks uploaded or 0 if it fails.
     *
     * @param string $source
     * @param string $path
     * @param int chunk
     * @param int chunks
     * @param array $metadata
     *
     * @throws \Exception
     *
     * @return int
     */
    public function upload(string $source, string $path, int $chunk = 1, int $chunks = 1, array &$metadata = []): int
    {
    }

    /**
     * Create a directory at the specified path.
     *
     * Returns true on success or if the directory already exists and false on error
     *
     * @param $path
     *
     * @return bool
     */
    public function createDirectory(string $path): bool
    {
        // Basic setup
        $curl = \curl_init();
        \curl_setopt($curl, CURLOPT_USERAGENT, 'utopia-php/storage');
        \curl_setopt($ch, CURLOPT_CUSTOMREQUEST, METHOD_MKCOL); 
        \curl_setopt($ch, CURLOPT_USERPWD, "$this->username:$this->password");
        \curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // Set Path
        $fullpath = $this->url.$path;
        \curl_setopt($curl, CURLOPT_URL, $fullpath);
        $result = \curl_exec($curl);
        
        if (!$result) {
            throw new Exception(\curl_error($curl));
        }
        
        $response->code = \curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($response->code >= 400) {
            throw new Exception($response->body, $response->code);
        }

        \curl_close($curl);
        return true;
    }
}