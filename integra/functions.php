<?php

function get_first_customer($customer_id, $db_prefix, $conexao) {
    $sql = "Select a.*,c.name as country_name,c.iso_code_2 as country_code,z.name as state_name,z.code as state_code FROM " . $db_prefix . "address a ".
            " LEFT JOIN ". $db_prefix . "country c ON a.country_id = c.country_id  ".
            " LEFT JOIN ". $db_prefix . "zone z ON a.zone_id = z.zone_id  ".
            " WHERE customer_id = " . $customer_id . " Order by address_id ASC Limit 1";

//    echo $sql;
//    echo "<br/><br/>";
    $sql2 = mysqli_query($conexao, $sql);

    $num_rows2 = mysqli_num_rows($sql2); /* Número de Pedidos Encontrados */

    if ($num_rows2 > 0) {
        return mysqli_fetch_assoc($sql2);
    }

    return array();
}


function get_second_customer($customer_id, $db_prefix, $conexao) {
    $sql = "Select a.*,c.name as country_name,c.iso_code_2 as country_code,z.name as state_name,z.code as state_code FROM " . $db_prefix . "address a ".
            " LEFT JOIN ". $db_prefix . "country c ON a.country_id = c.country_id  ".
            " LEFT JOIN ". $db_prefix . "zone z ON a.zone_id = z.zone_id  ".
            " WHERE customer_id = " . $customer_id . " Order by address_id DESC Limit 1";

    $sql2 = mysqli_query($conexao, $sql);

    $num_rows2 = mysqli_num_rows($sql2); /* Número de Pedidos Encontrados */

    if ($num_rows2 > 0) {
        return mysqli_fetch_assoc($sql2);
    }

    return array();
}
