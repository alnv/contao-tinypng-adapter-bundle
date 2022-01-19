<?php

namespace Alnv\TinypngAdapterBundle\Library;

class Cronjob {

    public function executeQueue() {

        $objQueue = \Alnv\TinypngAdapterBundle\Models\TinypngQueueModel::findAll([
            'column' => ['tl_tinypng_queue.compressed!=?'],
            'value' => ['1'],
            'limit' => 3,
            'order' => 'tstamp ASC'
        ]);

        if (!$objQueue) {
            return null;
        }

        while ($objQueue->next()) {

            $objResult = \Alnv\TinypngAdapterBundle\Library\TinyPngAdapter::compressAndReplace($objQueue->uuid);

            if (!$objResult) {
                continue;
            }

            $objQueue->tstamp = time();
            $objQueue->compressed = '1';
            $objQueue->save();
        }
    }
}