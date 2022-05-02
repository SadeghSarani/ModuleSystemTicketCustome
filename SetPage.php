<?php

namespace supportSystem;

class SetPage
{
    public static function setPage($list, $services)
    {
        return array(
            'pagetitle' => 'Addon Module',
            'breadcrumb' => array('index.php?m=demo' => 'Demo Addon'),
            'templatefile' => 'views/client/clientTicket',
            'requirelogin' => true, # accepts true/false
            'vars' => array(
                'data' => $list,
                'service' => $services['products']['product'],
            ),
        );
    }
}