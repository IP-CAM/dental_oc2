<?php

class ModelCatalogConfCustomerOption extends Model {

    public function add($data) {
        if (isset($data['name'])) {
            $columns [] = "numero_complemento = '" . $data['name'] . "'";
        }
        
        if (isset($data['type'])) {
            $columns [] = "field_type = '" . $data['type'] . "'";
        }


        

        $this->db->query("INSERT INTO " . DB_PREFIX . "customer_options SET " . implode($columns, ","));

    }

    public function edit($id, $data) {
         if (isset($data['name'])) {
            $columns [] = "numero_complemento = '" . $data['name'] . "'";
        }
        
        if (isset($data['type'])) {
            $columns [] = "field_type = '" . $data['type'] . "'";
        }
        
        $this->db->query("UPDATE " . DB_PREFIX . "customer_options SET " . implode($columns, ",") . " WHERE id = '" . (int) $id . "'");
    }

    public function delete($id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "customer_options WHERE id = '" . (int) $id . "'");
    }

    public function get($conf_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_options WHERE id = " . (int) $conf_id);

        return $query->row;
    }

    public function getAll($data = array(),$type = "") {
        $sql = "SELECT * FROM " . DB_PREFIX . "customer_options ad  WHERE id<>'' AND field_type = '".$type."'";

        if (!empty($data['filter_value'])) {
            $sql .= " AND ad.numero_complemento LIKE '" . $this->db->escape($data['filter_value']) . "%'";
        }



        $sort_data = array(
            'ad.numero_complemento',
                //'a.sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY  ad.numero_complemento";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotal($type) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_options WHERE field_type = '".$type."'");

        return $query->row['total'];
    }


}

?>