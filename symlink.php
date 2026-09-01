<?php

$target = '/home/crelupqy/adv.crelogics.com/storage/app/public';
$link   = '/home/crelupqy/adv.crelogics.com/public/storage';

if (symlink($target, $link)) {
    echo "SYMLINK CREATED SUCCESSFULLY";
} else {
    echo "SYMLINK FAILED";
}
