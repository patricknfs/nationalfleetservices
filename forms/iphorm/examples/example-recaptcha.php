<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>iPhorm - Ajax Contact Form</title>

<link rel="stylesheet" type="text/css" href="../css/pagestyles.css" /><!-- Page styles -->
<link rel="stylesheet" type="text/css" href="../css/standard.css" /><!-- Standard form layout -->

<script type="text/javascript" src="../js/jquery-1.6.2.min.js"></script><!-- If your webpage already has the jQuery library you do not need this -->
<script type="text/javascript" src="../js/plugins.js"></script>
<script type="text/javascript" src="../js/scripts.js"></script>
</head>
<body>
<div class="outside">
    <!-- To copy the form HTML, start here -->
    <div class="iphorm-outer">
        <form class="iphorm" action="process-recaptcha.php" method="post" enctype="multipart/form-data">
            <div class="iphorm-wrapper">
                <h1>iPhorm - <a href="http://codecanyon.net/item/iphorm-simple-yet-powerful-ajax-contact-form/148273?ref=ThemeCatcher">Ajax contact form</a></h1>
                <h2>The iPhorm now supports a reCAPTCHA field.</h2>
                <div class="iphorm-inner">
                    <div class="iphorm-title">Please get in touch</div>
                    <div class="iphorm-container clearfix">
                        <!-- Begin Name element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="name">Name <span class="red">*</span></label>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="name-element" id="name" type="text" name="name" />
                            </div>
                        </div>
                        <!-- End Name element -->
                        <!-- Begin Email element -->
                        <div class="element-wrapper email-element-wrapper clearfix">
                            <label for="email">Email <span class="red">*</span></label>
                            <div class="input-wrapper phone-input-wrapper">
                                <input class="email-element iphorm-tooltip" id="email" type="text" name="email" title="We will never send you spam, we value your privacy as much as our own" />
                            </div>
                        </div>
                        <!-- End Email element -->
                        <!-- Begin Message element -->
                        <div class="element-wrapper message-element-wrapper clearfix">
                            <label for="message">Message <span class="red">*</span></label>
                            <div class="input-wrapper message-input-wrapper clearfix">
                                <textarea class="message-element" id="message" name="message" rows="7" cols="45"></textarea>
                            </div>
                        </div>
                        <!-- End Message element -->
                        <!-- Begin ReCAPTCHA element -->
                        <div class="element-wrapper recaptcha-element-wrapper clearfix">
                            <?php
                                include_once '../../iphorm/lib/recaptchalib.php';
                                echo recaptcha_get_html('YOUR_PUBLIC_KEY');
                            ?>
                        </div>
                        <!-- End ReCAPTCHA element -->
                        <!-- Begin Submit button -->
                        <div class="button-wrapper submit-button-wrapper clearfix">
                            <div class="loading-wrapper"><span class="loading">Please wait...</span></div>
                            <div class="button-input-wrapper submit-button-input-wrapper">
                                <input class="submit-element" type="submit" name="contact" value="Send" />
                            </div>
                        </div>
                        <!-- End Submit button -->
                   </div>
               </div>
           </div>
        </form>
    </div>
    <!-- To copy the form HTML, end here -->
</div>
</body>
</html>