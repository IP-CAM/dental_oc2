<?php

class ControllerProductConfProduct extends Controller {

    public $options_types = array(
        'tamanho' => 'tamanho',
        'quantitdy' => 'quantitdy',
        'cor' => 'cor',
    );

    public function options() {


        $this->load->model('catalog/product_options');
        $product_id = $this->request->get['product_id'];
        $options = array();
        $option_key = 'arcade';
        if (!empty($this->request->get['option'])) {
            $options = $this->request->get['option'];
        }
        if (!empty($this->request->get['option_key'])) {
            $option_key = $this->request->get['option_key'];
        }

        $model = $this->model_catalog_product_options;
        $options_arcade = $model->gerProductOptions($product_id, $option_key, $options);
        $option_name = $option_key;
        if (empty($options_arcade)) {
            unset($this->options_types[$this->request->get['option_key']]);
            //to save recursion
            if ($this->request->get['option_key'] == 'quantitdy') {
                unset($this->options_types['tamanho']);
            }
            foreach ($this->options_types as $option) {
                $options_arcade = $model->gerProductOptions($product_id, $option, $options);
                $option_name = $option;
                break;
            }
        }
        $data['option_name'] = $option_name;
        $data['data'] = $options_arcade;
        echo json_encode($data);
    }

    /**
     * Send Email
     */
    public function send_email() {
        $product_id = $this->request->get['product_id'];
        $email = $this->request->get['email'];

        $name = explode("@", $email);
        $name = $name[0];

        $this->load->model('catalog/product_options');
        $model = $this->model_catalog_product_options;
        $data = $model->get_product_option($product_id);

        $images = $data['images'];
        $data = $data['product'];

        $ret_data['model'] = $data['model'];
        $ret_data['desc'] = html_entity_decode($data['description']);
        $ret_data['name'] = $data['name'];
        $ret_data['image'] = $data['image'];
        $ret_data['link'] = $this->url->link('product/product' . '&product_id=' . $product_id);


        $mail = new Mail();
        $mail->protocol = $this->config->get('config_mail_protocol');
        $mail->parameter = $this->config->get('config_mail_parameter');
        $mail->hostname = $this->config->get('config_smtp_host');
        $mail->username = $this->config->get('config_smtp_username');
        $mail->password = $this->config->get('config_smtp_password');
        $mail->port = $this->config->get('config_smtp_port');
        $mail->timeout = $this->config->get('config_smtp_timeout');
       

        $content = file_get_contents(getcwd() . '/system/library/phpmailer/examples/contentss/email-8-original_1.html');
        $content = str_replace('{{$product_name}}', $ret_data['name'], $content);
        $content = str_replace('{{$product_link}}', $ret_data['link'], $content);
        $content = str_replace('{{$product_image}}', $ret_data['image'], $content);
        $content = str_replace('{{$product_desc}}', $ret_data['desc'], $content);
        $content = str_replace('{{$product_model}}', $ret_data['model'], $content);


        $mail->setTo($this->config->get('config_email'));
        $mail->setFrom($email);
        $mail->setSender($name);
        $mail->setSubject('Fora de Stock produto [' . $data['model'] . ']');
        //$mail->setHtml(html_entity_decode($content, ENT_QUOTES, 'UTF-8'));
        $mail->setHtml($content);



        //$mail->send();
//        $mail = new PHPMailer;
//        $mail->isSMTP();
//        $mail->SMTPDebug = 2;
//        $mail->Debugoutput = 'html';
//        $mail->Host = 'smtp.gmail.com';
//        $mail->Port = 587;
//
//
//        $mail->SMTPSecure = 'tls';
//        $mail->SMTPAuth = FALSE;
//        $mail->Username = "testservice2015@gmail.com";
//        $mail->Password = "abc123AB@";
//        $mail->setFrom($email, $name);
//        $mail->addReplyTo($email, $name);
//        $mail->addAddress('itsgeniusstar@gmail.com', 'Ali Abbas');
//        $mail->Subject = 'Fora de Stock produto [' . $data['model'] . ']';
//
//        $content = file_get_contents(getcwd() . '/system/library/phpmailer/examples/contentss/email-8-original_1.html');
//        $content = str_replace('{{$product_name}}', $ret_data['name'], $content);
//        $content = str_replace('{{$product_link}}', $ret_data['link'], $content);
//        $content = str_replace('{{$product_image}}', $ret_data['image'], $content);
//        $content = str_replace('{{$product_desc}}', $ret_data['desc'], $content);
//        $content = str_replace('{{$product_model}}', $ret_data['model'], $content);
//
//
//        $mail->msgHTML($content);
        //Replace the plain text body with one created manually
        //$mail->AltBody = 'O produto a seguir está fora de estoque gentilmente disponibilizar este.';
        //send the message, check for errors
        if ($mail->send()) {
            echo json_encode(array("send" => 1));
        } else {
            echo json_encode(array("send" => 0));
        }
    }

}

?>