<?php

///////////////////////////////////////////////////////////////
//
// SugarCRM7 Filter fields definitions
//
///////////////////////////////////////////////////////////////

//clients/base/filters/operators/operators.php
//clients/base/api/FilterApi.php
//clients/base/layouts/filter/filter.js
//clients/base/layouts/filterpanel/filterpanel.js

$viewdefs['base']['filter']['operators'] = array(    
'multienum' => array(
        '$contains' => 'LBL_OPERATOR_CONTAINS', // is any of
        '$not_contains' => 'LBL_OPERATOR_NOT_CONTAINS',
    ),
    'enum' => array(
        '$in' => 'LBL_OPERATOR_CONTAINS', // is any of
        '$not_in' => 'LBL_OPERATOR_NOT_CONTAINS',
    ),
);