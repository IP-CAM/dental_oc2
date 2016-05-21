<?php

class ControllerAccountTest extends Controller {

    public function index() {
        $mail = new Mail();
        $mail->protocol = $this->config->get('config_mail_protocol');
        $mail->parameter = $this->config->get('config_mail_parameter');
        $mail->hostname = $this->config->get('config_smtp_host');
        $mail->username = $this->config->get('config_smtp_username');
        $mail->password = $this->config->get('config_smtp_password');
        $mail->port = $this->config->get('config_smtp_port');
        $mail->timeout = $this->config->get('config_smtp_timeout');
        $mail->setTo("itsgeniusstar@gmail.com");
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender("Test Email");


        $mail->setSubject(html_entity_decode("Subject issue", ENT_QUOTES, 'UTF-8'));
        $mail->setHtml("<b>ali</b>");
        $mail->setText(html_entity_decode("HII", ENT_QUOTES, 'UTF-8'));
        echo "ali..dd......";
        $mail->send();

        echo "ali........";
    }

    public function mailchimp() {
        $this->load->model('account/mailchimp');
        $this->model_account_mailchimp->test();
    }

}
