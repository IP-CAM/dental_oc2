<?php

	class PagSeguroData {

		private $sandbox;

		private $sandboxData = Array(

			'sessionURL' => "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions",
			'transactionsURL' => "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions",
			'javascriptURL' => "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"
		);

		private $productionData = Array(

			'sessionURL' => "https://ws.pagseguro.uol.com.br/v2/sessions",
			'transactionsURL' => "https://ws.pagseguro.uol.com.br/v2/transactions",
			'javascriptURL' => "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"

		);

		public function __construct($sandbox, $email, $token) {
			$this->sandbox = (bool)$sandbox;
                        if(!$sandbox){
                            $this->productionData['credentials'] = array(
                                'email' => $email,
                                'token' => $token,
                            );
                        }else{
                            $this->sandboxData['credentials'] = array(
                                'email' => $email,
                                'token' => $token,
                            );
                        }

		}

		private function getEnviromentData($key) {
			if ($this->sandbox) {
				return $this->sandboxData[$key];
			} else {
				return $this->productionData[$key];
			}
		}

		public function getSessionURL() {
			return $this->getEnviromentData('sessionURL');
		}

		public function getTransactionsURL() {
			return $this->getEnviromentData('transactionsURL');
		}

		public function getJavascriptURL() {
			return $this->getEnviromentData('javascriptURL');
		}

		public function getCredentials() {
			return $this->getEnviromentData('credentials');
		}

		public function isSandbox() {
			return (bool)$this->sandbox;
		}

	}

?>