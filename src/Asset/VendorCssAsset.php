<?php
namespace Xanweb\ExtAsset\Asset;

use Concrete\Core\Filesystem\FileLocator;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Asset\CssAsset as CoreCssAsset;
use Xanweb\ExtAsset\Filesystem\FileLocator\LibraryLocator;

class VendorCssAsset extends CoreCssAsset
{
    protected $libraryName;

    public function getAssetType()
    {
        return 'vendor-css';
    }

    public function getOutputAssetType()
    {
        return 'css';
    }

    public function register($filename, $args, $libraryName = false)
    {
        parent::register($filename, $args);

        if (!is_string($libraryName)) {
            throw new \Exception('Invalid css Library');
        }

        $this->libraryName = $libraryName;
    }

    public function mapAssetLocation($path)
    {
        if ($this->isAssetLocal()) {
            $app = Application::getFacadeApplication();
            $locator = $app->make(FileLocator::class);
            $locator->addLocation(new LibraryLocator($this->libraryName));
            $r = $locator->getRecord($path);
            $this->setAssetPath($r->file);
            $this->setAssetURL($r->url);
        } else {
            $this->setAssetURL($path);
        }
    }
}
