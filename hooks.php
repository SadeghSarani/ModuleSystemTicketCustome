<?php

use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaPrimaryNavbar', 1, function (MenuItem $primaryNavbar) {
    $primaryNavbar->addChild('Add New Ticket')
        ->setUri('http://localhost/whmcs/index.php?m=supportSystem')
        ->setOrder(70);
});
