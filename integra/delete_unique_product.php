<?php

/*
 * @author Ali Abbas
 * @purpose update all older producs according to sidicom
 */

$test_s = "CER S-BASE SBA1 (10G)";
$unique_field = 'name';

function str_replace_first($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

$testk = '(01010034) CZR DENTINA A4B (10G)';

include_once('chaveiro.php');

$sql = 'Select p.product_id,p.unique_name,p.group_name,pd.name FROM ' . $db_prefix . 'product p';
$sql.= ' INNER JOIN ' . $db_prefix . 'product_description pd on pd.product_id = p.product_id';
$sql_res = mysqli_query($conexao, $sql);
$i = 0;
$unique_product = array();
while ($row = mysqli_fetch_assoc($sql_res)) {

    $unique_product[$row['unique_name']][] = array($row['product_id'], $row['unique_name']);
}

foreach ($unique_product as $prod) {
    $i = 0;
    foreach ($prod as $delete) {
        if ($i > 0) {
            echo "<br/>-------deleted-------<br/>";
            echo "<pre>";
            print_r($delete);
            echo "</pre>";
            $sql = "DELETE FROM " . $db_prefix . "product WHERE product_id = " . (int) $delete[0];
            echo $sql;
            echo "<br/>";
            mysqli_query($conexao, $sql);
        } else {
            echo "<br/>-------actual-------<br/>";
            echo "<pre>";
            print_r($delete);
            echo "</pre>";
        }
        $i++;
    }
}