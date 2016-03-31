<?php

class ModelAccountAddress extends Model {

    public $_mail_chimp_columns = array(
        "payment_customer_type" => "varchar",
        "payment_cad_name" => "varchar",
        "payment_numero" => "varchar",
        "payment_complemento" => "varchar",
        "payment_cad_dob" => "date",
        "payment_cad_cpf" => "varchar",
        "payment_cad_rg" => "varchar",
        "payment_cad_telefone" => "varchar",
        "payment_cad_area_code" => "varchar",
        "payment_cad_celular" => "varchar",
        "payment_cad_gender" => "varchar",
        "payment_corop_name" => "varchar",
        "payment_corop_trade_name" => "varchar",
        "payment_corop_responsible_name" => "varchar",
        "payment_corop_cnpg" => "varchar",
        "payment_corop_telefone" => "varchar",
        "payment_corop_responsible_cell" => "varchar",
        "payment_corop_state_registration" => "varchar",
        "payment_corop_isento" => "boolean",
        "payment_profession_type" => "varchar",
        "payment_profession_cro" => "varchar",
        "payment_profession_tdp" => "varchar",
        "payment_profession_graduacao" => "varchar",
        "payment_profession_instituica" => "varchar",
        "payment_profession_matricula" => "varchar",
        "payment_profession_ensino" => "varchar",
        "payment_profession_atuacao" => "varchar",
        "payment_news_letter" => "boolean",
    );
    public $area_codes = '{
    "Ananindeua": "91",
    "Ilheus": "73",
    "Rio de Janeiro": "21",
    "Anapolis": "62",
    "Itaquaquecetuba": "11",
    "Salvador": "71",
    "Aparecida de Goiania": "62",
    "Joinville": "47",
    "Santa Maria": "55",
    "Aracaju": "79",
    "Joao Pessoa": "83",
    " Santarem": "91",
    "Bauru": "14",
    "Juiz de Fora": "32",
    "Santo Andre": "11",
    "Belem": "91",
    "Limeira": "19",
    "Santos": "13",
    "Belo Horizonte": "31",
    "Londrina": "43",
    "Sao Bernardo Campo": "11",
    "Boa Vista": "95",
    "Macapa": "96",
    "Sao Goncalo": "21",
    "Brasilia": "61",
    "Maceio": "82",
    "Sao Joao de Meriti": "21",
    "Campinas": "19",
    "Manaus": "92",
    "Sao Jose Campos": "12",
    "Campo Grande": "67",
    "Maringa": "44",
    "Sao Jose de Rio Preto": "17",
    "Canoas": "51",
    "Maua": "11",
    "Sao Luis": "98",
    "Carapicuiba": "11",
    "Montes Claros": "38",
    "Sao Paulo": "11",
    "Cariacica": "27",
    "Mogi das Cruzes": "11",
    "Sao Vicente": "13",
    "Caxias do Soul": "54",
    "Natal": "84",
    "Serra": "27",
    "Contagem": "31",
    "Niteroi": "21",
    "Sorocaba": "15",
    "Cuiaba": "65",
    "Nova Iguacu": "21",
    "Taubate": "12",
    "Curitiba": "41",
    "Olinda": "81",
    "Teresina": "86",
    "Diadema": "11",
    "Paulista": "81",
    "Uberlandia": "34",
    "Duque de Caxias": "21",
    "Pelotas": "53",
    "Uberaba": "34",
    "Feira de Santana": "75",
    "Petropolis": "24",
    "Varzea Grande": "65",
    "Florianopolis": "48",
    "Piracicaba": "19",
    "Vila Velha": "27",
    "Fortaleza": "85",
    "Porto Alegre": "51",
    "Vitoria": "27",
    "Foz do Iguacu": "45",
    "Porto Velho": "69",
    "Vitoria da Conquista": "77",
    "Franca": "16",
    "Recife": "81",
    "Volta Redonda": "24",
    "Goiania": "62",
    "Ribeirao Preto": "16",
    "Guarulhos": "11",
    "Rio Branco": "68"
}';

    public function addAddress($data) {
        $mail_chimp_columns = $this->getMailChimpFields($data);

        $columns = array();
        foreach ($mail_chimp_columns as $column => $value) {
            if (is_array($value)) {

                $new_arr = array();
                foreach ($value as $valk) {
                    $new_arr[] = utf8_encode($valk);
                }
                $value = implode(",", ($new_arr));

                $columns [] = $column . " = '" . $this->db->escape($value) . "'";
            } else {
                if ($column == "payment_corop_isento") {
                    $columns [] = $column . " = " . $this->db->escape(utf8_encode($value));
                } else {
                    $columns [] = $column . " = '" . $this->db->escape(utf8_encode($value)) . "'";
                }
            }
        }
        $column_string = "";
        if (!empty($columns)) {
            $column_string = "," . implode($columns, ",");
        }




        $sql = "INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int) $this->customer->getId() . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', company_id = '" . $this->db->escape(isset($data['company_id']) ? $data['company_id'] : '') . "', tax_id = '" . $this->db->escape(isset($data['tax_id']) ? $data['tax_id'] : '') . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', city = '" . $this->db->escape($data['city']) . "', zone_id = '" . (int) $data['zone_id'] . "', country_id = '" . (int) $data['country_id'] . "'" . $column_string;


        $this->db->query($sql);


        $address_id = $this->db->getLastId();

        if (!empty($data['default'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int) $address_id . "' WHERE customer_id = '" . (int) $this->customer->getId() . "'");
        }

        return $address_id;
    }

    public function editAddress($address_id, $data) {
        $columns = array();
        $mail_chimp_columns = $this->getMailChimpFields($data);

        foreach ($mail_chimp_columns as $column => $value) {
            if (is_array($value)) {

                $new_arr = array();
                foreach ($value as $valk) {
                    $new_arr[] = utf8_encode($valk);
                }
                $value = implode(",", ($new_arr));

                $columns [] = $column . " = '" . $this->db->escape($value) . "'";
            } else {
                if ($column == "payment_corop_isento") {
                    $columns [] = $column . " = " . $this->db->escape(utf8_encode($value));
                } else {
                    $columns [] = $column . " = '" . $this->db->escape(utf8_encode($value)) . "'";
                }
            }
        }
        $column_string = "";
        if (!empty($columns)) {
            $column_string = "," . implode($columns, ",");
        }
        $queryUp = "UPDATE " . DB_PREFIX . "address SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', company_id = '" . $this->db->escape(isset($data['company_id']) ? $data['company_id'] : '') . "', tax_id = '" . $this->db->escape(isset($data['tax_id']) ? $data['tax_id'] : '') . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', city = '" . $this->db->escape($data['city']) . "', zone_id = '" . (int) $data['zone_id'] . "', country_id = '" . (int) $data['country_id'] . "'" . $column_string . " WHERE address_id  = '" . (int) $address_id . "' AND customer_id = '" . (int) $this->customer->getId() . "'";

        $this->db->query($queryUp);

        if (!empty($data['default'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int) $address_id . "' WHERE customer_id = '" . (int) $this->customer->getId() . "'");
        }
    }

    /**
     * 
     * @param type $address_id
     * @param type $data
     */
    public function editMailChimpAddress($address_id, $data) {
        $columns = array();
        $mail_chimp_columns = $this->getMailChimpFields($data);

        foreach ($mail_chimp_columns as $column => $value) {
            if (is_array($value)) {

                $new_arr = array();
                foreach ($value as $valk) {
                    $new_arr[] = utf8_encode($valk);
                }
                $value = implode(",", ($new_arr));

                $columns [] = $column . " = '" . $this->db->escape($value) . "'";
            } else {
                if ($column == "payment_corop_isento") {
                    $columns [] = $column . " = " . $this->db->escape(utf8_encode($value));
                } else {
                    $columns [] = $column . " = '" . $this->db->escape(utf8_encode($value)) . "'";
                }
            }
        }
        $column_string = "";
        if (!empty($columns)) {
            $column_string = implode($columns, ",");
        }
        $queryUp = "UPDATE " . DB_PREFIX . "address SET " . $column_string . " WHERE address_id  = '" . (int) $address_id . "' AND customer_id = '" . (int) $this->customer->getId() . "'";

        $this->db->query($queryUp);

        if (!empty($data['default'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int) $address_id . "' WHERE customer_id = '" . (int) $this->customer->getId() . "'");
        }
        return $address_id;
    }

    /*
     * get mail chimp fields 
     */

    public function getMailChimpFields($data) {
        $columns = array_keys($this->_mail_chimp_columns);
        $new_data = array();
        foreach ($data as $key => $val) {
            if (in_array($key, $columns)) {
                $new_data[$key] = $val;
            }
        }

        if (!empty($new_data['payment_corop_isento']) && $new_data['payment_corop_isento'] == "on") {
            $new_data['payment_corop_isento'] = 1;
        } else {
            $new_data['payment_corop_isento'] = 0;
        }
        if (!empty($new_data['payment_news_letter']) && $new_data['payment_news_letter'] == "on") {
            $new_data['payment_news_letter'] = 1;
        } else {
            $new_data['payment_news_letter'] = 0;
        }

        return $new_data;
    }

    public function deleteAddress($address_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE address_id = '" . (int) $address_id . "' AND customer_id = '" . (int) $this->customer->getId() . "'");
    }

    /**
     * get Current user Max id
     * @return type
     */
    public function getMaxAddressId() {
        $sql = "SELECT MAX(address_id) as id FROM  " . DB_PREFIX . "address WHERE customer_id = " . $this->customer->getId();
        $address_query = $this->db->query($sql);
        return $address_query->row;
    }

    public function getAddress($address_id) {
        $sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int) $address_id . "' AND customer_id = '" . (int) $this->customer->getId() . "'";

        $address_query = $this->db->query($sql);

        if ($address_query->num_rows) {

            $sub_sql = "SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int) $address_query->row['country_id'] . "'";

            $country_query = $this->db->query($sub_sql);

            if ($country_query->num_rows) {
                $country = $country_query->row['name'];
                $iso_code_2 = $country_query->row['iso_code_2'];
                $iso_code_3 = $country_query->row['iso_code_3'];
                $address_format = $country_query->row['address_format'];
            } else {
                $country = '';
                $iso_code_2 = '';
                $iso_code_3 = '';
                $address_format = '';
            }

            $zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int) $address_query->row['zone_id'] . "'");

            if ($zone_query->num_rows) {
                $zone = $zone_query->row['name'];
                $zone_code = $zone_query->row['code'];
            } else {
                $zone = '';
                $zone_code = '';
            }

            $address_data = array(
                'firstname' => $address_query->row['firstname'],
                'lastname' => $address_query->row['lastname'],
                'company' => $address_query->row['company'],
                'company_id' => $address_query->row['company_id'],
                'tax_id' => $address_query->row['tax_id'],
                'address_1' => $address_query->row['address_1'],
                'address_2' => $address_query->row['address_2'],
                'postcode' => $address_query->row['postcode'],
                'city' => $address_query->row['city'],
                'zone_id' => $address_query->row['zone_id'],
                'zone' => $zone,
                'zone_code' => $zone_code,
                'country_id' => $address_query->row['country_id'],
                'country' => $country,
                'iso_code_2' => $iso_code_2,
                'iso_code_3' => $iso_code_3,
                'address_format' => $address_format
            );

            $columns = array_keys($this->_mail_chimp_columns);
            foreach ($columns as $col) {
                if (isset($address_query->row[$col])) {
                    $address_data[$col] = $address_query->row[$col];
                }
            }

            return $address_data;
        } else {
            return false;
        }
    }

    public function getAddresses() {
        $address_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $this->customer->getId() . "'");

        foreach ($query->rows as $result) {
            $country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int) $result['country_id'] . "'");

            if ($country_query->num_rows) {
                $country = $country_query->row['name'];
                $iso_code_2 = $country_query->row['iso_code_2'];
                $iso_code_3 = $country_query->row['iso_code_3'];
                $address_format = $country_query->row['address_format'];
            } else {
                $country = '';
                $iso_code_2 = '';
                $iso_code_3 = '';
                $address_format = '';
            }

            $zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int) $result['zone_id'] . "'");

            if ($zone_query->num_rows) {
                $zone = $zone_query->row['name'];
                $zone_code = $zone_query->row['code'];
            } else {
                $zone = '';
                $zone_code = '';
            }

            $address_data[$result['address_id']] = array(
                'address_id' => $result['address_id'],
                'firstname' => $result['firstname'],
                'lastname' => $result['lastname'],
                'company' => $result['company'],
                'company_id' => $result['company_id'],
                'tax_id' => $result['tax_id'],
                'address_1' => $result['address_1'],
                'address_2' => $result['address_2'],
                'postcode' => $result['postcode'],
                'city' => $result['city'],
                'zone_id' => $result['zone_id'],
                'zone' => $zone,
                'zone_code' => $zone_code,
                'country_id' => $result['country_id'],
                'country' => $country,
                'iso_code_2' => $iso_code_2,
                'iso_code_3' => $iso_code_3,
                'address_format' => $address_format
            );

            foreach (array_keys($this->_mail_chimp_columns) as $field) {
                $address_data[$result['address_id']][$field] = $result[$field];
            }
        }

        return $address_data;
    }

    public function getTotalAddresses() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $this->customer->getId() . "'");

        return $query->row['total'];
    }

}
?>

