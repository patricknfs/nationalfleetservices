<?php

define('IPHORM_ROOT', realpath(dirname(__FILE__)));
require_once IPHORM_ROOT . '/common.php';

/** SETTINGS **/

/**
 * Success message, displayed when the form is successfully submitted
 */
$successMessage = '
<div class="success-message">

<h1>Thank You %custname%</h1>

<p>Your quote request has been submitted.</p>

<h2>What next?</h2>

<ul>
<li>A member of the National Fleet Services sales team will be in touch shortly</li>
</ul>

<br />

<p>In the meantime should you have any questions about leasing take a look at our products page or call <b>0121 45 45 645</b> and speak to one of our in house experts.</p>

</div>
';

/**
 * Configure the recipients of the notification email message.  You can add
 * multiple email addresses by adding one on each line inside the array
 * enclosed in quotes, separated by commas. E.g.
 *
 * $notificationRecipients = array(
 *     'recipient1@example.com',
 *     'recipient2@example.com'
 * );
 */
 


switch($_POST['countySelect']) {

    case 'PE':
	case 'LE':
	case 'NN':
	case 'GB':
	case 'MK':
	case 'SG':
	case 'OX':
	case 'HP':
	case 'LU':
	case 'AL':
		 
        $notificationRecipients = array(
            'samwestley@gmail.com',
			'sam.westley@nationalfleetservices.net'
    );
    break;
	
	
	case 'B':
	case 'CV':
	case 'WR':
	case 'HR':
		 
        $notificationRecipients = array(
            'samwestley@gmail.com',
			'sam.westley@nationalfleetservices.net'
        );
        break;
		
		
	case 'NE':
	case 'CA':
	case 'DL':
	case 'DH':
	case 'TS':

        $notificationRecipients = array(
            'samwestley@gmail.com',
			'sam.westley@nationalfleetservices.net'
        );
        break;
		
		
	case 'YO':
	case 'HG':
	case 'LS':
	case 'WF':
	case 'HU':
	case 'DN':
	case 'S':
	case 'LN':
	case 'NG':
	case 'DE':

        $notificationRecipients = array(
            'samwestley@gmail.com',
			'sam.westley@nationalfleetservices.net'
        );
        break;
		

	case 'LL':
	case 'SY':
	case 'TF':
	case 'ST':
	case 'WS':
	case 'WV':
	case 'DY':

        $notificationRecipients = array(
            'samwestley@gmail.com',
			'sam.westley@nationalfleetservices.net'
        );
        break;
		

	case 'GL':
	case 'NP':
	case 'CF':
	case 'BS':
	case 'SN':
	case 'CB':
	case 'BA':
	case 'TA':
	case 'SP':
	case 'DT':
	case 'BH':
	case 'EX':
	case 'TQ':
	case 'PL':
	case 'TR':

        $notificationRecipients = array(
            'samwestley@gmail.com',
			'sam.westley@nationalfleetservices.net'
        );
        break;
		

	case 'LA':
	case 'BD':
	case 'BB':
	case 'PR':
	case 'L':
	case 'WN':
	case 'BL':
	case 'OL':
	case 'HX':
	case 'HD':
	case 'M':
	case 'WA':
	case 'CH':
	case 'CW':
	case 'SK':

		$notificationRecipients = array(
            'samwestley@gmail.com',
			'sam.westley@nationalfleetservices.net'
        );
        break;
		
		
    default:
        // These will be the recipients if the subject does not match any above
        $notificationRecipients = array(
            'samwestley@gmail.com',
            'sam.westley@nationalfleetservices.net'
        );
        break;
}

/**
 * Set the "From" address of the emails. You should set this to the contact
 * email address of your website. Some hosts require that the email
 * address is one that is hosted on their servers.
 *
 * You can set this to be an email address string e.g. 
 *
 * $emailFrom = 'info@yourcompany.com';
 *
 * Or you can also include a name with your email address using an array e.g.
 *
 * $emailFrom = array('info@yourcompany.com' => 'Your company');
 */
 
$emailFrom = 'no_reply@nationalfleetservices.net';

/**
 * The subject of the notification email message. %name% will be replaced
 * with the form submitted value for the name field.
 */
$notificationSubject = 'Webform Enquiry - %name% %company%';

/**
 * Whether or not to send the notification email. You may wish to disable this if you are
 * saving the form data to the database for example. true or false
 */
$sendNotificationEmail = true;

/**
 * The file containing the HTML body of the notification email.
 */
$notificationHtml = '/emails/email-html.php';

/**
 * The file containing the plain text body of the notification email
 */
$notificationPlain = '/emails/email-plain.php';

/**
 * Whether or not to send an autoreply email. true or false
 */
$sendAutoreply = false;

/**
 * The subject of the autoreply email
 */
$autoreplySubject = 'Thanks for your enquiry, %name%';

/**
 * The file containing the HTML body of the autoreply email
 */
$autoreplyHtml = '/emails/autoreply-html.php';

/**
 * The file containing the plain text body of the autoreply email
 */
$autoreplyPlain = '/emails/autoreply-plain.php';

/**
 * Redirect the user when the form is successfully submitted by entering a URL here.
 *
 * By default, users are not redirected. Only users with JavaScript disabled will be
 * redirect this way. To redirect users with JavaScript enabled, see the documentation. E.g.
 *
 * $redirect = 'http://www.example.com/thanks.html';
 */
$redirect = 'http://www.nationalfleetservices.net/thanks.php';

/**
 * Whether or not to save the form data to a database. true or false
 *
 * You can configure the database settings further down in this file.
 */
$saveToDatabase = false;

/**
 * Whether or not to save uploaded files to the server. true or false
 */
$saveUploads = false;

/**
 * The path to save any uploaded files. Must be writable.
 */
$saveUploadPath = IPHORM_ROOT . '/uploads';

/** END SETTINGS **/

/** FORM ELEMENT CONFIGURATION **/

$custname = new iPhorm_Element('custname', 'Name');
$custname->addFilter('trim');
$custname->addValidator('required');
$form->addElement($custname);

$company = new iPhorm_Element('company', 'Company');
$company->addFilter('trim');
$form->addElement($company);

$email = new iPhorm_Element('email', 'Email address');
$email->addFilter('trim');
$email->addValidators(array('required', 'email'));
$form->addElement($email);

$telephone = new iPhorm_Element('telephone', 'Telephone');
$telephone->addFilter('trim');
$custname->addValidator('required');
$telephone->addValidator('stringLength', array('min' => 10, 'max' => 12));
$form->addElement($telephone);

$countySelect = new iPhorm_Element('countySelect', 'County');
$countySelect->addFilter('trim');
$countySelect->addValidator('required');
$form->addElement($countySelect);

$make = new iPhorm_Element('make', 'Make');
$make->addFilter('trim');
$make->addValidator('required');
$form->addElement($make);

$model = new iPhorm_Element('model', 'Model');
$model->addFilter('trim');
$model->addValidator('required');
$form->addElement($model);


$leaseSelect = new iPhorm_Element('leaseSelect', 'Lease Type');
$leaseSelect->addFilter('trim');
$leaseSelect->addValidator('required');
$form->addElement($leaseSelect);

$contractSelect = new iPhorm_Element('contractSelect', 'Contract Length');
$contractSelect->addFilter('trim');
$contractSelect->addValidator('required');
$form->addElement($contractSelect);

$mileageSelect = new iPhorm_Element('mileageSelect', 'Mileage');
$mileageSelect->addFilter('trim');
$mileageSelect->addValidator('required');
$form->addElement($mileageSelect);

$maintSelect = new iPhorm_Element('maintSelect', 'Maintenance');
$maintSelect->addFilter('trim');
$maintSelect->addValidator('required');
$form->addElement($maintSelect);


$dnotes = new iPhorm_Element('dnotes', 'Notes');
$dnotes->addFilter('trim');
$form->addElement($dnotes);

$corp = new iPhorm_Element('corp', 'Source');
$corp->addFilter('trim');
$form->addElement($corp);

/** END FORM ELEMENT CONFIGURATION **/

// Process the form
if ($form->isValid($_POST)) {
    // Form is valid
    try {
        // Sets the character set of future emails to match the form's character set
        Swift_Preferences::getInstance()->setCharset($form->getCharset());

        // Create new transport to use PHP's mail() function
        $transport = Swift_MailTransport::newInstance();

        // You could use an SMTP server here instead
        //$transport = Swift_SmtpTransport::newInstance('yoursmtphost.com', 25)->setUsername('yourusername')->setPassword('yourpassword');

        // Create the mailer instance
        $mailer = Swift_Mailer::newInstance($transport);

        if ($sendNotificationEmail) {
            // Create the notification message
            $message = Swift_Message::newInstance();

            // Set the from address
            $message->setFrom($emailFrom);

            // Set the Reply-To header of the email as the submitted email address from the form
            $message->setReplyTo($form->getValue('email'));

            // Set the subject
            $message->setSubject($form->replacePlaceholderValues($notificationSubject));

            // Set the recipients
            foreach ($notificationRecipients as $recipient) {
                $message->addTo($recipient);
            }

            // Set the message body HTML
            ob_start();
            include IPHORM_ROOT . $notificationHtml;
            $message->setBody(ob_get_clean(), 'text/html');

            // Add a plain text part for non-HTML email readers
            ob_start();
            include IPHORM_ROOT . $notificationPlain;
            $message->addPart(ob_get_clean(), 'text/plain');

            // Add any attachments
            foreach ($form->getElements() as $element) {
                if ($element instanceof iPhorm_Element_File
                && $element->getAttach()
                && array_key_exists($element->getName(), $_FILES)
                && is_array($_FILES[$element->getName()])) {
                    $file = $_FILES[$element->getName()];
                    if (is_array($file['error'])) {
                        // Process multiple upload field
                        foreach ($file['error'] as $key => $error) {
                            if ($error === UPLOAD_ERR_OK) {
                                $pathInfo = pathinfo($file['name'][$key]);
                                $extension = strtolower($pathInfo['extension']);

                                $filenameFilter = new iPhorm_Filter_Filename();
                                $filename = str_replace(".$extension", '', $pathInfo['basename']);
                                $filename = $filenameFilter->filter($filename);
                                $filename = (strlen($filename) > 0) ? $filename . ".$extension" : 'upload' . ".$extension";

                                $attachment = Swift_Attachment::fromPath($file['tmp_name'][$key], $file['type'][$key])->setFilename($filename);
                                $message->attach($attachment);
                            }
                        }
                    } else {
                        // Process single upload field
                        if ($file['error'] === UPLOAD_ERR_OK) {
                            $pathInfo = pathinfo($file['name']);
                            $extension = strtolower($pathInfo['extension']);

                            $filenameFilter = new iPhorm_Filter_Filename();
                            $filename = str_replace(".$extension", '', $pathInfo['basename']);
                            $filename = $filenameFilter->filter($filename);
                            $filename = (strlen($filename) > 0) ? $filename . ".$extension" : 'upload' . ".$extension";

                            $attachment = Swift_Attachment::fromPath($file['tmp_name'], $file['type'])->setFilename($filename);
                            $message->attach($attachment);
                        }
                    }
                } // element exists in $_FILES
            } // foreach element

            // Send the notification message
            $mailer->send($message);
        }

        // Set the recipient as the submitted email address
        $autoreplyRecipient = $form->getValue('email');

        // Autoreply email
        if ($sendAutoreply && ($autoreplyRecipient != null)) {
            // Create the autoreply message
            $autoreply = Swift_Message::newInstance();

            // Set the from address
            $autoreply->setFrom($emailFrom);

            $autoreply->setTo($autoreplyRecipient);

            // Set the subject
            $autoreply->setSubject($form->replacePlaceholderValues($autoreplySubject));

            // Set the message body HTML
            ob_start();
            include IPHORM_ROOT . $autoreplyHtml;
            $autoreply->setBody(ob_get_clean(), 'text/html');

            // Add a plain text part for non-HTML email readers
            ob_start();
            include IPHORM_ROOT . $autoreplyPlain;
            $autoreply->addPart(ob_get_clean(), 'text/plain');

            // Send the autoreply
            $mailer->send($autoreply);
        }

        // Save uploaded files
        if ($saveUploads) {
            foreach ($form->getElements() as $element) {
                if ($element instanceof iPhorm_Element_File
                && $element->getSave()
                && array_key_exists($element->getName(), $_FILES)
                && is_array($_FILES[$element->getName()])) {
                    $savePath = $element->hasSavePath() ? $element->getSavePath() : $saveUploadPath;
                    $savePath = substr($savePath, -1) == '/' ? $savePath : $savePath . '/';
                    if (is_writeable($savePath)) {
                        $file = $_FILES[$element->getName()];
                        if (is_array($file['error'])) {
                            // Process multiple upload field
                            foreach ($file['error'] as $key => $error) {
                                if ($error === UPLOAD_ERR_OK) {
                                    $pathInfo = pathinfo($file['name'][$key]);
                                    $extension = strtolower($pathInfo['extension']);

                                    $filenameFilter = new iPhorm_Filter_Filename();
                                    $filename = $filenameFilter->filter($pathInfo['filename']) . '.' . $extension;

                                    if (file_exists($savePath . $filename)) {
                                        $filename = $form->generateFilename($savePath, $filename);
                                    }

                                    move_uploaded_file($file['tmp_name'][$key], $savePath . $filename);
                                }
                            }
                        } else {
                            // Process single upload field
                            if ($file['error'] === UPLOAD_ERR_OK) {
                                $pathInfo = pathinfo($file['name']);
                                $extension = strtolower($pathInfo['extension']); 

                                $filenameFilter = new iPhorm_Filter_Filename();
                                $filename = $filenameFilter->filter($pathInfo['filename']) . '.' . $extension;

                                if (file_exists($savePath . $filename)) {
                                    $filename = $form->generateFilename($savePath, $filename);
                                }

                                move_uploaded_file($file['tmp_name'], $savePath . $filename);
                            }
                        }
                    } // is writeable
                } // element exists in $_FILES
            } // foreach element
        }

        // Save to a MySQL database
        if ($saveToDatabase) {
            // Connect to MySQL
            mysql_connect('localhost', 'fs-admin', 'camp=Flam') or die(mysql_error());

            // Select the database
            mysql_select_db('db_fleetstreet') or die(mysql_error());

            // Set the connection encoding
            if (strtolower($form->getCharset()) == 'utf-8') {
                $utf8Query = "SET NAMES utf8";
                mysql_query($utf8Query) or die(mysql_error());
            }

            // Build the query
            $query = "INSERT INTO 'webform' SET ";
            $query .= "`custname` = '" . mysql_real_escape_string($form->getValue('custname')) . "',";
            $query .= "`company` = '" . mysql_real_escape_string($form->getValue('company')) . "',";
            $query .= "`email` = '" . mysql_real_escape_string($form->getValue('email')) . "',";
            $query .= "`telephone` = '" . mysql_real_escape_string($form->getValue('telephone')) . "',";
            $query .= "`countySelect` = '" . mysql_real_escape_string($form->getValue('countySelect')) . "',";
            $query .= "`make` = '" . mysql_real_escape_string($form->getValue('make')) . "',";
            $query .= "`model` = '" . mysql_real_escape_string($form->getValue('model')) . "',";
            $query .= "`leaseSelect` = '" . mysql_real_escape_string($form->getValue('leaseSelect')) . "',";
            $query .= "`contractSelect` = '" . mysql_real_escape_string($form->getValue('contractSelect')) . "',";
            $query .= "`mileageSelect` = '" . mysql_real_escape_string($form->getValue('mileageSelect')) . "',";			
            $query .= "`maintSelect` = '" . mysql_real_escape_string($form->getValue('maintSelect')) . "',";			
            $query .= "`dnotes` = '" . mysql_real_escape_string($form->getValue('dnotes')) . "',";

            // Execute the query
            mysql_query($query) or die(mysql_error());

            // Close the connection
            mysql_close();
        }

        // Custom code can be entered here


        // Form processed successfully, return the success message
        $result = array('type' => 'success', 'data' => $form->replacePlaceholderValues($successMessage));
    } catch (Exception $e) {
        // An exception occurred, return the error
        $result = array('type' => 'fatal', 'data' => $form->formatMessage($form->escape($e->getMessage()), 'fatal'));
    }
} else {
    // Form is not valid
    $result = array('type' => 'error', 'data' => $form->getErrors());
}

if (isset($_POST['iphorm_ajax']) && $_POST['iphorm_ajax'] == 1) {
    $response = '<textarea>' . $form->jsonEncode($result) . '</textarea>';
} else {
    if ((strlen($redirect) > 0) && !headers_sent()) {
        header('Location: ' . $redirect);
    }

    ob_start();
    require_once 'nojs.php';
    $response = ob_get_clean();
}

echo $response;
