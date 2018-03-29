<?php
class Email{
	var $toEmail;
	var $fromEmail;
	var $ccEmail;
	var $bccEmail;
	var $mailSubject;
	var $mailMessage;
	var $emailHeader;
	var $attachment;
	
	function Email($to, $from='', $subject='', $msg='', $cc='', $bcc='', $attc=0){
		$this->toEmail = trim($to);
		$this->fromEmail = trim($from);
		$this->mailSubject = trim($subject);
		$this->mailMessage = trim($msg);
		$this->ccEmail = trim($cc);
		$this->bccEmail = trim($bcc);
		$this->attachment = trim($attc);
		$this->emailHeader = '';
		
		$this->setEmailHeader();
	}
	
	function setEmailHeader(){
		$emailHeaders = "";
		$emailHeaders .= "From: " . $this->fromEmail;
		if($this->ccEmail!=''){
			$emailHeaders .= "Cc: " . $this->ccEmail;
		}
		if($this->bccEmail!=''){
			$emailHeaders .= "Bcc: " . $this->bccEmail;
		}
		
		if($this->attachment){
			
		}else{
			$emailHeaders .= "MIME-Version: 1.0\n";
			$emailHeaders .= "X-Mailer: PHP 4.x\n";
			$emailHeaders .= "Content-type: text/html; charset=iso-8859-1 \n";
			$emailHeaders .= "Content-Transfer-Encoding: 7bit";
		}
		$this->emailHeader = $emailHeaders;
	}

	function sendEmail(){
		$emailSent = @mail($this->toEmail, $this->mailSubject, $this->mailMessage, $this->emailHeader);
		if($emailSent){
			return true;
		}else{
			return false;
		}
	}
	
}
?>