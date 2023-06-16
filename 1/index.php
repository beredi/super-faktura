<?php

for ($i = 1; $i <= 100; $i++) {
    if ($i % 15 === 0) {
        echo "SuperFaktura\n";
    } elseif ($i % 3 === 0) {
        echo "Super\n";
    } elseif ($i % 5 === 0) {
        echo "Faktura\n";
    } else {
        echo $i . "\n";
    }
}

?>
