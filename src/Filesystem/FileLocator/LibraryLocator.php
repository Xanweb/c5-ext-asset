<?php
namespace Xanweb\ExtAsset\Filesystem\FileLocator;

use Concrete\Core\Filesystem\FileLocator\AbstractLocation;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Concrete\Core\Support\Facade\Application;

defined('VENDOR_DIR') or define('VENDOR_DIR', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__DIR__, 5)));

class LibraryLocator extends AbstractLocation
{
    protected $path;

    protected $url;

    /**
     * LibraryLocator constructor.
     *
     * @param string $libraryName example: 'xanweb/glidejs'
     */
    public function __construct($libraryName)
    {
        $this->path = VENDOR_DIR . '/' . $libraryName;
        $this->url = Application::getApplicationRelativePath();
        $this->url .= '/' . ltrim(UrlGenerator::getRelativePath(DIR_BASE . '/', $this->path), '/');
    }

    public function getCacheKey()
    {
        return ['vendor', 'c5-ext-asset'];
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getURL()
    {
        return $this->url;
    }
}
