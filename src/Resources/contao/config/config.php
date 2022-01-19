<?php

$GLOBALS['TL_MODELS']['tl_tinypng_queue'] = 'Alnv\TinypngAdapterBundle\Models\TinypngQueueModel';

$GLOBALS['TL_CRON']['minutely'][] = ['Alnv\TinypngAdapterBundle\Library\Cronjob', 'executeQueue'];
