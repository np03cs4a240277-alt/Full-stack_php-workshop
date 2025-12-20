<?php

function escape($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

function isLowStock($stock) {
    return $stock < 5;
}
