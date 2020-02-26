<?php
namespace Xanweb\ExtAsset\Asset;

use Concrete\Core\Asset\AssetList as CoreAssetList;

class VendorAssetManager
{
    public static function register($assetType, $assetHandle, $filename, $libraryName, $args = [])
    {
        $al = CoreAssetList::getInstance();
        $defaults = [
            'position' => false,
            'local' => true,
            'version' => false,
            'combine' => -1,
            'minify' => -1, // use the asset default
        ];

        // overwrite all the defaults with the arguments
        $args = array_merge($defaults, $args);

        if ($assetType === 'vendor-javascript') {
            $o = new VendorJavascriptAsset($assetHandle);
        } elseif ($assetType === 'vendor-css') {
            $o = new VendorCssAsset($assetHandle);
        } else {
            throw new \Exception(t('Unsupported asset type `%s`', $assetType));
        }

        $o->register($filename, $args, $libraryName);
        $al->registerAsset($o);

        return $o;
    }

    public static function registerMultiple(array $assets)
    {
        foreach ($assets as $assetHandle => $assetTypes) {
            foreach ($assetTypes as $assetType => $assetSettings) {
                array_splice($assetSettings, 1, 0, $assetHandle);
                call_user_func_array([self::class, 'register'], $assetSettings);
            }
        }
    }

    /**
     * @param string $assetGroupHandle
     * @param array $assetHandles
     * @param bool $customClass
     */
    public static function registerGroup($assetGroupHandle, $assetHandles, $customClass = false)
    {
        $al = CoreAssetList::getInstance();
        $al->registerGroup($assetGroupHandle, $assetHandles, $customClass);
    }

    /**
     * @param array $asset_groups
     */
    public static function registerGroupMultiple(array $asset_groups)
    {
        $al = CoreAssetList::getInstance();
        $al->registerGroupMultiple($asset_groups);
    }
}
