<?php

class ModelAccountMailchimp extends Model {

    public function test() {
        $res_mail_list = $this->db->query("Select value FROM " . DB_PREFIX . "setting as t WHERE t.key IN('config_mail_chimp')");
        $res_mail_key = $this->db->query("Select value FROM " . DB_PREFIX . "setting as t WHERE t.key IN('config_mail_chimp_key')");
        $res_mail_list = $res_mail_list->row['value'];
        $res_mail_key = $res_mail_key->row['value'];

        require_once getcwd() . '/system/library/MailChimp/SubScriptMailChimp.php';

        $mailchimp = SubScriptMailChimp::getInstance($res_mail_key);


        $data['payment_profession_type'] = 'Dentista';
        $data['payment_profession_atuacao'] = 'Clinica,Dentistica,Endodontia,Periodontia';
        $email = 'itsgeniusstar@gmail.com';


        if (!empty($data['payment_profession_type'])) {

//            $list_id = $mailchimp->getPreparedListName($data['payment_profession_type']);

            $list_id = "5945821b1c";

            $add_group = array("name" => $data['payment_profession_type']);

//            $groups = $mailchimp->addGroup($list_id, $add_group);
            $groups = explode(",",$data['payment_profession_atuacao']);

            $customer = array("firstname" => "Ali", "lastname" => "Abbas");
            //$mailchimp->add_batch_subscribers($list_id, $this->customer->getEmail(), $groups['data'], $this->customer);
            $res = $mailchimp->add_batch_subscribers_with_groups($list_id, $email, $groups, $customer);
        }
    }

    public function test_add_groups() {
        $options_atuaca_dentista = array(
            "Clinica", "Dentistica",
            "Endodontia", "Estetica",
            "Ortodondia", "Periodontia",
            "Protese", "Radiologia",
        );
        $options_atuaca_técnico = array(
            "Metaloceramica", "Ceramica sobre Zirconia",
            "Ceramica Prensada – Metal Free", "Fundicao",
            "Fresagem em CAD/CAM", "Trabalhos em Resina",
            "PPR – Protese Parcial Removivel", "Protese Total",
            "Placas (Bruxismo ou Injetada)", "Implantes",
            "Encaixes (ERA, ORING ou TRILHO)",
        );

        $res_mail_list = $this->db->query("Select value FROM " . DB_PREFIX . "setting as t WHERE t.key IN('config_mail_chimp')");
        $res_mail_key = $this->db->query("Select value FROM " . DB_PREFIX . "setting as t WHERE t.key IN('config_mail_chimp_key')");
        $res_mail_list = $res_mail_list->row['value'];
        $res_mail_key = $res_mail_key->row['value'];

        require_once getcwd() . '/system/library/MailChimp/SubScriptMailChimp.php';

        $mailchimp = SubScriptMailChimp::getInstance($res_mail_key);

        $groups = array_merge($options_atuaca_dentista, $options_atuaca_técnico);

        foreach ($options_atuaca_dentista as $group) {
            $group1 = array("name" => $group);
            $res = $mailchimp->addGroup("363969f8e1", $group1);
            echo "<pre>";
            print_r($res);
            echo "</pre>";
        }
        foreach ($options_atuaca_técnico as $group) {
            $group1 = array("name" => $group);
            $res = $mailchimp->addGroup("4ed6814bb9", $group1);
            echo "<pre>";
            print_r($res);
            echo "</pre>";
        }
    }

}
