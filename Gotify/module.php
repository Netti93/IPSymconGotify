<?php

declare(strict_types=1);
	class Gotify extends IPSModule
	{
		public function Create()
		{
			//Never delete this line!
			parent::Create();
			
            $this->RegisterPropertyString('URL', '');
            $this->RegisterPropertyString('ApplicationToken', '');	
		}

		public function Destroy()
		{
			//Never delete this line!
			parent::Destroy();
		}

		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
		}

		private BuildMessageURL() {
			return rtrim($this->ReadPropertyString('URL'), '/') . '/message?token=' . $this->ReadPropertyString('ApplicationToken');
		}

		public function SendMessage(string $title, string $message, int $priority = 0)
        {
            return $this->SendMessageWithExtras($title, $message, $priority);
        }

		public function SendMessageWithExtras(string $title, string $message, int $priority = 0, array $extras = [])
        {
            curl_setopt_array($ch = curl_init(), [
                CURLOPT_URL        => $this->BuildMessageURL(),
                CURLOPT_POSTFIELDS => [
                    'title'     => $title,
                    'message'   => $message,
					'priority'  => $priority,
					'extras'	=> json_encode($extras)
                ],
                CURLOPT_SAFE_UPLOAD    => true,
                CURLOPT_RETURNTRANSFER => true,
            ]);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response);
            if ($responseObject == null) {
                return false;
            } else if (property_exists($responseObject, 'appid')) {
                $this->SetStatus(102);
                return true;
            } else if (property_exists($responseObject, 'errorCode') && $responseObject->{'errorCode'} == 404) {
                $this->SetStatus(201);
            } else if (property_exists($responseObject, 'errorCode') && $responseObject->{'errorCode'} == 401) {
                $this->SetStatus(202);
            }

            IPS_LogMessage('Gotify', $response);

            return false;
        }
	}