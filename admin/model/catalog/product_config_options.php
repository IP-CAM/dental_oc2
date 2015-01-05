<?php

class ModelCatalogProductConfigOptions extends Model {

    public function addRecord($data) {
        $columns [] = "arcade = '" . $data['arcade'] . "'";
        $columns [] = "tamanho = '" . $data['tamanho'] . "'";
        $columns [] = "cor = '" . $data['cor'] . "'";
        $columns [] = "product_id = '" . $data['product_id'] . "'";
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "product_config_options SET ".implode($columns,","));

        $conf_arcade = $this->db->getLastId();
    }

    public function editRecord($conf_id, $data) {
        $columns [] = "arcade = '" . $data['arcade'] . "'";
        $columns [] = "tamanho = '" . $data['tamanho'] . "'";
        $columns [] = "cor = '" . $data['cor'] . "'";
        $columns [] = "product_id = '" . $data['product_id'] . "'";
        $this->db->query("UPDATE " . DB_PREFIX . "product_config_options SET ".implode($columns,",")." WHERE id = '" . (int) $conf_id . "'");
    }

    public function deleteRecord($conf_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_config_options WHERE id = '" . (int) $conf_id . "'");
    }

    public function getRecord($conf_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_config_options WHERE id = " . (int) $conf_id);
       
        return $query->row;
    }

    public function getRecords($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "product_config_options ad  WHERE id<>'' ";

        if (!empty($data['filter_value'])) {
            $sql .= " AND ad.arcade LIKE '" . $this->db->escape($data['filter_value']) . "%'";
        }



        $sort_data = array(
            'ad.arcade',
                //'a.sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY  ad.arcade";
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

    public function getTotalRecord() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_config_options");

        return $query->row['total'];
    }

    protected function getLanguages() {
        $res = $this->db->query("Select * FROM " . DB_PREFIX . "language WHERE code <>'en'");
        $array = array();
        foreach ($res->rows as $row) {
            $array[$row['code']] = "value_" . $row['code'];
        }
        return $array;
    }

}

?>