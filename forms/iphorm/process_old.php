<?php

define('IPHORM_ROOT', realpath(dirname(__FILE__)));
require_once IPHORM_ROOT . '/common.php';

/** SETTINGS **/

/**
 * Success message, displayed when the form is successfully submitted
 */
$successMessage = '<div class="success-message">Your message has been sent, thank you.</div>';

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
$notificationRecipients = array(
    'sam@hawkinsvehicleleasing.com'
);

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
$emailFrom = 'noreply@example.com';

/**
 * The subject of the notification email message. %name% will be replaced
 * with the form submitted value for the name field.
 */
$notificationSubject = 'Message from %salesperson%';

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
$autoreplySubject = 'Thanks for your message, %salesperson%';

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
$redirect = '';

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


$salesperson = new iPhorm_Element('salesperson', 'Salesperson');
$salesperson->addFilter('trim');
$salesperson->addValidator('required');
$form->addElement($salesperson);


$funder = new iPhorm_Element('funder', 'Funder');
$funder->addFilter('trim');
$funder->addValidator('required');
$form->addElement($funder);


$quoteno = new iPhorm_Element('quoteno', 'Quote No');
$quoteno->addFilter('trim');
$quoteno->addValidators(array('digits', 'required'));
$quoteno->addValidator('stringLength', array('min' => 5, 'max' => 10));
$form->addElement($quoteno);


$titleSelect = new iPhorm_Element('titleSelect', 'Title');
$titleSelect->addFilter('trim');
$titleSelect->addValidator('required');
$form->addElement($titleSelect);


$firstname = new iPhorm_Element('firstname', 'First Name');
$firstname->addFilter('trim');
$firstname->addValidator('required');
$form->addElement($firstname);


$surname = new iPhorm_Element('surname', 'Surname');
$surname->addFilter('trim');
$surname->addValidator('required');
$form->addElement($surname);


$hometel = new iPhorm_Element('hometel', 'Landline');
$hometel->addFilter('trim');
$hometel->addValidators(array('digits', 'required'));
$hometel->addValidator('stringLength', array('min' => 10, 'max' => 12));
$form->addElement($hometel);


$mobiletel = new iPhorm_Element('mobiletel', 'Mobile');
$mobiletel->addFilter('trim');
$mobiletel->addValidators(array('digits', 'required'));
$mobiletel->addValidator('stringLength', array('min' => 10, 'max' => 12));
$form->addElement($mobiletel);


$email = new iPhorm_Element('email', 'Email address');
$email->addFilter('trim');
$email->addValidators(array('required', 'email'));
$form->addElement($email);


$dob = new iPhorm_Element('dob', 'DOB');
$dob->addFilter('trim');
$dob->addValidator('required');
$form->addElement($dob);


$radioButton = new iPhorm_Element('radio_button', 'Gender');
$radioButton->addFilter('trim');
$radioButton->addValidator('required');
$form->addElement($radioButton);


$nationality = new iPhorm_Element('nationality', 'Nationality');
$nationality->addFilter('trim');
$nationality->addValidator('required');
$form->addElement($nationality);


$maritialSelect = new iPhorm_Element('maritialSelect', 'Maritial Status');
$maritialSelect->addFilter('trim');
$maritialSelect->addValidator('required');
$form->addElement($maritialSelect);


$residentialSelect = new iPhorm_Element('residentialSelect', 'Residential Status');
$residentialSelect->addFilter('trim');
$residentialSelect->addValidator('required');
$form->addElement($residentialSelect);


$timeatad = new iPhorm_Element('timeatad', 'Time at Address');
$timeatad->addFilter('trim');
$timeatad->addValidator('required');
$form->addElement($timeatad);


$adline1 = new iPhorm_Element('adline1', 'No & Street');
$adline1->addFilter('trim');
$adline1->addValidator('required');
$form->addElement($adline1);


$town = new iPhorm_Element('town', 'Town');
$town->addFilter('trim');
$town->addValidator('required');
$form->addElement($town);


$county = new iPhorm_Element('county', 'County');
$county->addFilter('trim');
$county->addValidator('required');
$form->addElement($county);


$postcode = new iPhorm_Element('postcode', 'Postcode');
$postcode->addFilter('trim');
$postcode->addValidator('required');
$form->addElement($postcode);


$prevtimeatad = new iPhorm_Element('prevtimeatad', 'Time at Previous Address');
$prevtimeatad->addFilter('trim');
$form->addElement($prevtimeatad);


$prevadline1 = new iPhorm_Element('prevadline1', 'Previous No & Street');
$prevadline1->addFilter('trim');
$form->addElement($prevadline1);


$prevtown = new iPhorm_Element('prevtown', 'Previous Town');
$prevtown->addFilter('trim');
$form->addElement($prevtown);


$prevcounty = new iPhorm_Element('prevcounty', 'Previous County');
$prevcounty->addFilter('trim');
$form->addElement($prevcounty);


$prevpostcode = new iPhorm_Element('prevpostcode', 'Previous Postcode');
$prevpostcode->addFilter('trim');
$form->addElement($prevpostcode);


$positiontitle = new iPhorm_Element('positiontitle', 'Position Title');
$positiontitle->addFilter('trim');
$positiontitle->addValidator('required');
$form->addElement($positiontitle);


$occupation = new iPhorm_Element('occupation', 'Occupation');
$occupation->addFilter('trim');
$occupation->addValidator('required');
$form->addElement($occupation);


$empstatusSelect = new iPhorm_Element('empstatusSelect', 'Employment Status');
$empstatusSelect->addFilter('trim');
$empstatusSelect->addValidator('required');
$form->addElement($empstatusSelect);


$empname = new iPhorm_Element('empname', 'Employers Name');
$empname->addFilter('trim');
$empname->addValidator('required');
$form->addElement($empname);


$coreg = new iPhorm_Element('coreg', 'Mobile');
$coreg->addFilter('trim');
$coreg->addValidators(array('required'));
$coreg->addValidator('stringLength', array('min' => 8, 'max' => 8));
$form->addElement($coreg);


$empadline1 = new iPhorm_Element('empadline1', 'Employer No & Street');
$empadline1->addFilter('trim');
$empadline1->addValidator('required');
$form->addElement($empadline1);


$emptown = new iPhorm_Element('emptown', 'Employer Town');
$emptown->addFilter('trim');
$emptown->addValidator('required');
$form->addElement($emptown);


$empcounty = new iPhorm_Element('empcounty', 'Employer County');
$empcounty->addFilter('trim');
$empcounty->addValidator('required');
$form->addElement($empcounty);


$emppostcode = new iPhorm_Element('emppostcode', 'Employer Postcode');
$emppostcode->addFilter('trim');
$emppostcode->addValidator('required');
$form->addElement($emppostcode);


$caradioButton = new iPhorm_Element('caradio_button', 'Car Allowance');
$caradioButton->addFilter('trim');
$caradioButton->addValidator('required');
$form->addElement($caradioButton);


$account = new iPhorm_Element('account', 'Account Name');
$account->addFilter('trim');
$account->addValidator('required');
$form->addElement($account);


$bank = new iPhorm_Element('bank', 'Bank Name');
$bank->addFilter('trim');
$bank->addValidator('required');
$form->addElement($bank);


$accno = new iPhorm_Element('accno', 'Account Number');
$accno->addFilter('trim');
$accno->addValidators(array('digits', 'required'));
$form->addElement($accno);


$sortno = new iPhorm_Element('sortno', 'Sort Code');
$sortno->addFilter('trim');
$sortno->addValidator('required');
$form->addElement($sortno);


$timebank = new iPhorm_Element('timebank', 'Employer Postcode');
$timebank->addFilter('trim');
$timebank->addValidator('required');
$form->addElement($timebank);


$netincome = new iPhorm_Element('netincome', 'Net Income');
$netincome->addFilter('trim');
$netincome->addValidator('required');
$form->addElement($netincome);


$partnetincome = new iPhorm_Element('partnetincome', 'Partners Net Income');
$partnetincome->addFilter('trim');
$form->addElement($partnetincome);


$mortgagerent = new iPhorm_Element('mortgagerent', 'Mortgage Rent');
$mortgagerent->addFilter('trim');
$mortgagerent->addValidator('required');
$form->addElement($mortgagerent);


$cards = new iPhorm_Element('cards', 'Cards');
$cards->addFilter('trim');
$cards->addValidators(array('digits', 'required'));
$form->addElement($cards);


$loanhire = new iPhorm_Element('loanhire', 'Loan Hire');
$loanhire->addFilter('trim');
$loanhire->addValidator('required');
$form->addElement($loanhire);


$expother = new iPhorm_Element('expother', 'Other');
$expother->addFilter('trim');
$form->addElement($expother);


$dnotes = new iPhorm_Element('dnotes', 'Notes');
$dnotes->addFilter('trim');
$form->addElement($dnotes);


$declarationCheckbox = new iPhorm_Element('declaration_checkbox', 'Declaration');
$declarationCheckbox->addFilter('trim');
$declarationCheckbox->addValidator('required');
$form->addElement($declarationCheckbox);

/**
 * Configure the CAPTCHA field
 * Filters: Trim
 * Validators: Required, Identical
 */
$captcha = new iPhorm_Element('type_the_word');                                              // Create the type_the_word (captcha) element
$captcha->addFilter('trim');                                                                 // Add the Trim filter to the element
$captcha->addValidators(array('required', array('identical', array('token' => 'light'))));   // Add the Required and Identical validators to the element
$captcha->setIsHidden(true);                                                                 // Do not show the value in the email
$form->addElement($captcha);                                                                 // Add the captcha element to the form



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
            mysql_connect('localhost', 'username', 'password');

            // Select the database
            mysql_select_db('database');

            // Set the connection encoding
            if (strtolower($form->getCharset()) == 'utf-8') {
                $utf8Query = "SET NAMES utf8";
                mysql_query($utf8Query);
            }

            // Build the query
            $query = "INSERT INTO table SET ";
            $query .= "`name` = '" . mysql_real_escape_string($form->getValue('name')) . "',";
            $query .= "`email` = '" . mysql_real_escape_string($form->getValue('email')) . "',";
            $query .= "`phone` = '" . mysql_real_escape_string($form->getValue('phone')) . "',";
            $query .= "`subject` = '" . mysql_real_escape_string($form->getValue('subject')) . "',";
            $query .= "`message` = '" . mysql_real_escape_string($form->getValue('message')) . "';";

            // Execute the query
            mysql_query($query);

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
    $response = '<notes>' . $form->jsonEncode($result) . '</notes>';
} else {
    if ((strlen($redirect) > 0) && !headers_sent()) {
        header('Location: ' . $redirect);
    }

    ob_start();
    require_once 'nojs.php';
    $response = ob_get_clean();
}

echo $response;
