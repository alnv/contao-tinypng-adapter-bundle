<?php

namespace Alnv\TinypngAdapterBundle\Models;

class TinypngQueueModel extends \Model {

    protected static $strTable = 'tl_tinypng_queue';

    public static function findByUuid($strUuid, $arrOptions=[]) {

        $strTable = static::$strTable;
        $arrColumns = ["$strTable.uuid=?"];
        $arrOptions['limit'] = 1;

        return static::findOneBy($arrColumns, [$strUuid], $arrOptions);
    }
}