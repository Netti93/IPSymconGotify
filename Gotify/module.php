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

		public function SendMessage(string $title, string $message, int $priority = 0)
        {
            return $this->SendMessageWithExtras($title, $message, $priority);
        }

		public function SendMessageWithExtras(string $title, string $message, int $priority = 0, array $extras = [])
        {
            curl_setopt_array($ch = curl_init(), [
                CURLOPT_URL        => $this->ReadPropertyString('URL'),
                CURLOPT_POSTFIELDS => [
                    'token'     => $this->ReadPropertyString('ApplicationToken'),
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
                $this->SetStatus(201);
                return false;
            } else if (property_exists($responseObject, 'appid')) {
                $this->SetStatus(102);
                return true;
            } else if (property_exists($responseObject, 'errorCode') && $responseObject->{'errorCode'} == 401) {
                $this->SetStatus(202);
            }

            IPS_LogMessage('Gotify', $response);

            return false;
        }
	}