<?php

class ModelAccountAddress extends Model {

    public $_mail_chimp_columns = array(
        "payment_customer_type" => "varchar",
        "payment_cad_name" => "varchar",
        "payment_cad_dob" => "date",
        "payment_cad_cpf" => "varchar",
        "payment_cad_rg" => "varchar",
        "payment_cad_telefone" => "varchar",
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
    );

    public function addAddress($data) {
        $mail_chimp_columns = $this->getMailChimpFields($data);

        $columns = array();
        foreach ($mail_chimp_columns as $column => $value) {
            if (is_array($value)) {
                $value = implode(",", $value);
            }
            if ($column == "payment_corop_isento") {
                $columns [] = $column . " = " . $value;
            } else {
                $columns [] = $column . " = '" . $value . "'";
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
                $value = implode(",", $value);
            }
            if ($column == "payment_corop_isento") {
                $columns [] = $column . " = " . $value;
            } else {
                $columns [] = $column . " = '" . $value . "'";
            }
        }
        $column_string = "";
        if (!empty($columns)) {
            $column_string = "," . implode($columns, ",");
        }
        $this->db->query("UPDATE " . DB_PREFIX . "address SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', company_id = '" . $this->db->escape(isset($data['company_id']) ? $data['company_id'] : '') . "', tax_id = '" . $this->db->escape(isset($data['tax_id']) ? $data['tax_id'] : '') . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', city = '" . $this->db->escape($data['city']) . "', zone_id = '" . (int) $data['zone_id'] . "', country_id = '" . (int) $data['country_id'] . $column_string . "' WHERE address_id  = '" . (int) $address_id . "' AND customer_id = '" . (int) $this->customer->getId() . "'");

        if (!empty($data['default'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int) $address_id . "' WHERE customer_id = '" . (int) $this->customer->getId() . "'");
        }
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

        return $new_data;
    }

    public function deleteAddress($address_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE address_id = '" . (int) $address_id . "' AND customer_id = '" . (int) $this->customer->getId() . "'");
    }

    public function getAddress($address_id) {
        $address_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int) $address_id . "' AND customer_id = '" . (int) $this->customer->getId() . "'");

        if ($address_query->num_rows) {
            $country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int) $address_query->row['country_id'] . "'");

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
        }

        return $address_data;
    }

    public function getTotalAddresses() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $this->customer->getId() . "'");

        return $query->row['total'];
    }

}
?>

