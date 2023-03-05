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

        private function BuildMessageURL()
        {
            return rtrim($this->ReadPropertyString('URL'), '/').'/message?token='.$this->ReadPropertyString('ApplicationToken');
        }

        public function SendTestMessage()
        {
            return $this->SendMessageWithExtras($this->Translate('Test message'), $this->Translate('This is a test message from your Symcon instance'));
        }

        public function SendMessage(string $title, string $message, int $priority = 0)
        {
            return $this->SendMessageWithExtras($title, $message, $priority);
        }

        public function SendImage(string $title, int $imageId, int $priority = 0, string $notificationUrl = null)
        {
            $image = IPS_GetMediaContent($imageId);
            $message = "![" . $imageId . "](data:image/jpeg;base64," . $image . ")"
            $extras = array("client::display" => array("contentType" => "text/markdown"));

            if(!empty($notificationUrl))
            {
                $extras["client::notification"] = array("click" => array("url" => $notificationUrl));
            }

            return $this->SendMessageWithExtras($title, $message, $priority, $extras);
        }

        public function SendImageFromUrl(string $title, string $url, int $priority = 0, string $notificationUrl = null)
        {
            $message = "![Image](" . $url . ")"
            $extras = array("client::display" => array("contentType" => "text/markdown"));
            return $this->SendMessageWithExtras($title, $message, $priority, $extras);
        }

        public function SendMessageWithExtras(string $title, string $message, int $priority = 0, array $extras = [])
        {
            $postfields = [
                'title'     => $title,
                'message'   => $message,
                'priority'  => $priority
            ];

            if(!empty($extras))
            {
                $postfields['extras'] = $extras;
            }

            curl_setopt_array($ch = curl_init(), [
                CURLOPT_URL        => $this->BuildMessageURL(),
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
                CURLOPT_POST       => true,
                CURLOPT_POSTFIELDS => json_encode($postfields),
                CURLOPT_SAFE_UPLOAD    => true,
                CURLOPT_RETURNTRANSFER => true,
            ]);
            $response = curl_exec($ch);

            // Check for errors and display the error message
            if (!$response) {
                $errorArr = [
                    'error'            => curl_strerror(curl_errno($ch)),
                    'errorCode'        => curl_getinfo($ch, CURLINFO_RESPONSE_CODE),
                    'errorDescription' => curl_error($ch),
                ];
                $this->LogMessage(json_encode($errorArr), KL_ERROR);
                $this->SetStatus(201);

                return false;
            }

            curl_close($ch);

            $responseObject = json_decode($response);
            if (property_exists($responseObject, 'appid')) {
                $this->SetStatus(102);

                return true;
            } elseif (property_exists($responseObject, 'errorCode') && $responseObject->{'errorCode'} == 404) {
                $this->SetStatus(202);
            } elseif (property_exists($responseObject, 'errorCode') && $responseObject->{'errorCode'} == 401) {
                $this->SetStatus(203);
            }

            $this->LogMessage($response, KL_ERROR);

            return false;
        }
    }
