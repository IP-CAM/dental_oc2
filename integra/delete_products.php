<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('chaveiro.php');
//$db_prefix = 'eworxes_';
$joins_table = array(
    $db_prefix . "product_attribute",
    $db_prefix . "product_config_options",
    $db_prefix . "product_description",
    $db_prefix . "product_discount",
    $db_prefix . "product_filter",
    $db_prefix . "product_image",
    $db_prefix . "product_option",
    $db_prefix . "product_option_value",
    $db_prefix . "product_profile",
    $db_prefix . "product_recurring",
    $db_prefix . "product_related",
    $db_prefix . "product_reward",
    $db_prefix . "product_special",
    $db_prefix . "product_to_category",
    $db_prefix . "product_to_download",
    $db_prefix . "product_to_layout",
    $db_prefix . "product_to_store",
);

//$sql = "Delete  " . $db_prefix . "product ," . implode(",", $joins_table) . " ";
//foreach ($joins_table as $join) {
//    $sql.=" INNER JOIN " . $join . " ON " . $join . ".product_id = " . $db_prefix . "product." . "product_id <br/>";
//}
//
//echo $sql;

echo "<br/>-----------------------------------<br/>";

$sub_sql = "SELECT product_id FROM " . $db_prefix . "product";
$sql = "";
foreach ($joins_table as $join) {
    $sql.=" DELETE FROM " . $join . " WHERE product_id IN($sub_sql);<br/>";
}

$sql.=" DELETE FROM ".$db_prefix."product; ";
echo $sql;
