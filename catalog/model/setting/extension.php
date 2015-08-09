<?php

class ModelSettingExtension extends Model {

    function getExtensions($type) {
        $sql = "SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $this->db->escape($type) . "'";
       
        $query = $this->db->query($sql);

        return $query->rows;
    }

}

?>