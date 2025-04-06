<?php

  namespace Bcsapi\Traits;
  
  use Bcsapi\Facades\BCSApi;

  trait ChatsWithTelegram
  {
        public function SendMessageToTelegramChat($message){
            $Chat = BCSApi::TelegramChat();
            $Chat->SendMessage($this->IndividualID, $message);

        }
  }
