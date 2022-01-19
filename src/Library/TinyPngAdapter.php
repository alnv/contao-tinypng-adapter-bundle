<?php

namespace Alnv\TinypngAdapterBundle\Library;

class TinyPngAdapter {

    public static function addFileToQueue($strUuidOrPath) {

        $objFile = self::getFile($strUuidOrPath);

        if (!$objFile) {
            return null;
        }

        $strUuid = \StringUtil::binToUuid($objFile->uuid);
        $objQueue = \Alnv\TinypngAdapterBundle\Models\TinypngQueueModel::findByUuid($strUuid);

        if (!$objQueue) {
            $objQueue = new \Alnv\TinypngAdapterBundle\Models\TinypngQueueModel();
        }

        $objQueue->tstamp = time();
        $objQueue->uuid = $strUuid;
        $objQueue->compressed = '';

        return $objQueue->save()->row();
    }

    public static function compressAndReplace($strUuidOrPath) {

        $arrExtensions = ['png', 'jpg', 'jpeg', 'webp'];
        $strApiKey = \Config::get('tinypngApiKey');

        if (!$strApiKey) {
            return null;
        }

        $objFile = self::getFile($strUuidOrPath);

        if (!$objFile) {
            return null;
        }

        if (!in_array($objFile->extension, $arrExtensions)) {
            return null;
        }

        try {
            \Tinify\setKey($strApiKey);
            $objSource = \Tinify\fromFile(TL_ROOT . '/' . $objFile->path);
            $objSource->toFile(TL_ROOT . '/' . $objFile->path);
        } catch (\Exception $objError) {
            \System::log($objError->getMessage(), __METHOD__, TL_ERROR);
            return null;
        }

        \System::log('File '.$objFile->path.' was successfully compressed', __METHOD__, TL_ACCESS);

        $intCompressCount = \Config::get('tinypngCompressCount') ?: 0;
        $intCompressCount = $intCompressCount + 1;

        \Config::persist('tinypngCompressCount', $intCompressCount);

        return $objSource->result();
    }

    protected static function getFile($strUuidOrPath) {

        return \FilesModel::findByUuid($strUuidOrPath) ?: \FilesModel::findByPath($strUuidOrPath);
    }
}