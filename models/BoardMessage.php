<?php
/**
 * Description of BoardMessage
 *
 * @author boneff
 */
class BoardMessage {
   const MISS  = ' *** Miss *** ';
   const HIT   = ' *** Hit *** ';
   const SUNK  = ' *** Sunk *** ';
   const NONE  = '';
   
   private $lastMessage;
   
   public function __construct() {
       $this->lastMessage = '';
   }
   
   public function getLastMessage() {
       return $this->lastMessage;
   }

   public function setLastMessage($lastMessage) {
       $this->lastMessage = $lastMessage;
   }

}
