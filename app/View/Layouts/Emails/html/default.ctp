<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts.Email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title><?php echo $title_for_layout; ?></title>
	<style>
		body {margin:0; padding:0; background-color:#dddddd; color:#777777; font-family:Arial, Helvetica, sans-serif; font-size:12px; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; width:100% !important;}
		h1, h2 {color:#333333 !important; padding:0px 0px 10px 0px; margin:0px 0px 10px 0px;}
		p {margin:0 0 14px 0; padding:0;}
		img {border:0; -ms-interpolation-mode: bicubic; max-width:100%;}
		a img {border:none;}
		table td {border-collapse:collapse;}
		.highlighted {color:#0c87c7;}
	
	
	 .btn {
	    color: white;
	    display: inline-block;
	    font-size: 18px;
	    font-weight: normal;
	    margin-left: 10px;
	    margin-top: 40px;
	    padding: 12px 20px;
	    text-decoration: none;
	    text-transform: uppercase;
		background-color: #1e90ff;
	}
	
	
		/* Clients specific styles */
		.ReadMsgBody {width: 100%;}
		.ExternalClass {width: 100%;}
		.yshortcuts {color: #777777;}
		.yshortcuts a span {color: #777777; border-bottom: none !important; background: none !important; text-decoration:none !important;}
		/* / Clients specific styles */
	
		/* Media queries */
		@media only screen and (max-width: 640px) {
			table[class=row] {width:580px !important;}
			img[class=wideImage], img[class=banner] {width:100% !important; height:auto !important; max-width:100%;}
		}
		@media only screen and (max-width: 610px) {
			table[class=row] {width:570px !important;}
			td[class=container] {padding:0px !important;}
		}
		@media only screen and (max-width: 540px) {
			table[class=row] {width:510px !important;}
			td[class=oneFromFour] {font-size:14px !important; line-height:15pt !important;}
		}
		@media only screen and (max-width: 480px) {
			table[class=row] {width:450px !important;}
			td[class=oneFromTwo], td[class=twoColumns] {display:block; width:100% !important; padding-right:0px !important; padding-left:0px !important;}
			td[class=column] {display:block; width:390px !important; padding-right:30px !important; padding-left:30px !important;}
			td[class=website] {display:block; width:390px !important; padding:15px 30px 15px 30px !important; text-align:center;}
			td[class=socialIcons] {display:block; width:390px !important; padding:0px 30px 15px 30px !important; text-align:center !important;}
			img[class=phoneIcon] {display:none !important;}
			img[class=wideImage] {width:auto !important;}
			table[class=quoteContainer] {width:190px !important;}
		}
		@media only screen and (max-width: 360px) {
			table[class=row] {width:340px !important;}
			td[class=column], td[class=website], td[class=socialIcons] {width:280px !important;}
			td[class=logo] {display:block; width:280px !important; padding-bottom:30px !important; padding-right:30px !important; padding-left:30px !important;}
			td[class=phone] {display:block; width:280px !important; padding:9px 30px 13px 30px !important; text-align:left !important; background-color:#f4f4f4;}
			td[class=phone2] {display:block; width:280px !important; padding:8px 30px 8px 30px !important; text-align:left !important; border-top:1px solid #f4f4f4;}
			div[class=phoneNumber] {display:inline-block; margin-left:3px !important; font-size:12px !important; line-height:100% !important;}
			div[class=phoneNumber] img.vspace {display:none !important;}
			td[class=icon] {padding-top:10px !important; padding-bottom:10px !important;}
			table[class=quoteContainer] {width:140px !important;}
			table[class=quoteContainer] td {font-size:12px !important; line-height:15pt !important;}
			td[class=footer] {padding:0px 0px 25px 0px !important; text-align:left !important;}
		}
		@media only screen and (max-width: 320px) {
			table[class=row] {width:300px !important;}
			td[class=column], td[class=website], td[class=socialIcons], td[class=logo], td[class=phone], td[class=phone2] {width:240px !important;}
			table[class=quoteContainer] {width:100% !important; border-bottom:1px solid #eeeeee; margin-bottom:20px;}
			table[class=quoteContainer] td {padding-left:0px !important;}
			td[class=quoteAuthor] {padding-bottom:20px !important;}
		}
		@media only screen and (max-width: 240px) {
			table[class=row] {width:220px !important;}
			td[class=column], td[class=logo], td[class=phone], td[class=phone2] {width:160px !important;}
			td[class=oneFromFour] {display:block; width:100% !important; padding-right:0px !important; padding-left:0px !important;}
			td[class=website], td[class=socialIcons] {width:220px !important; padding-right:0px !important; padding-left:0px !important;}
			td[class=website] {font-size:18px !important;}
			img[class=wideImage] {width:100% !important;}
			table[class=iconContainer], table[class=imgContainer] {width:100% !important;}
			td[class=icon], td[class=authorPicture] {padding-right:0px !important; padding-bottom:20px !important; text-align:center;}
			td[class=icon] img, td[class=authorPicture] img {display:inline !important;}
		}
		/* / Media queries */
	
	</style>
	
	
</head>
<body>

	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; background-color:#dddddd;">
    <tr>
        <td class="container" style="padding-left:15px; padding-right:15px;">

			<!-- Start of logo, phone and banner -->
			<table class="row" width="610" bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; text-align:left; border-spacing:0; max-width:100%;">
                <tr>
                    <td width="100%" colspan="2" bgcolor="#dddddd" style="padding-top:30px; padding-bottom:5px; line-height:100%; -webkit-text-size-adjust:none;">
                       
                    </td>
                </tr>
                <tr>
                    <td width="50%" height="5" valign="top" style="font-size:2px; line-height:0px;"><img alt="" src="images/borderTopLeft.png" width="5" height="5" align="left" vspace="0" hspace="0" border="0" style="display:block; margin:0;" /></td>
                    <td width="50%" height="5" valign="top" style="font-size:2px; line-height:0px;"><img alt="" src="images/borderTopRight.png" width="5" height="5" align="right" vspace="0" hspace="0" border="0" style="display:block; margin:0;" /></td>
                </tr>
                <tr>
                	<td width="100%" colspan="2">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; text-align:left; border-spacing:0; max-width:100%; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#777777;">
                            <tr>
                                <td class="logo" width="50%" style="padding-top:25px; padding-right:15px; padding-bottom:30px; padding-left:30px; font-family:'Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:24px; line-height:100%; color:#0c87c7; font-weight:normal;">
                                    <div style="margin-top:0px; margin-bottom:0px !important; padding:0px; line-height:100%;">
                                    	<img alt="Logo" src="http://tiviastore.com/app/webroot/img/fulllogo.png" border="0" vspace="0" hspace="0" style="display:block; max-width:100%; height:auto !important;" />
                                    </div>
                                </td>

                                <td class="phone" width="50%" style="padding-top:17px; padding-right:30px; padding-bottom:22px; padding-left:15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#777777; text-align:right;">
                                    <img class="phoneIcon" alt="" src="http://softwaredev.com.ve/imagenes/phoneIcon.png" height="40" width="50" border="0" vspace="0" hspace="0" align="right" style="display:block;" />
                                    Contáctenos
                                    <div class="phoneNumber" style="margin-top:0px; margin-bottom:0px; padding:0px; font-size:14px; line-height:24px; font-weight:300; color:#777777; font-family:'Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif;"><img class="vspace" alt="" height="5" src="images/blank.gif" width="5" vspace="0" hspace="0" border="0" style="display:block;" />
                                        +58 286-9530303
                                    </div>
                              </td>
                            </tr>
                        </table>
                    </td>
                </tr>
               <tr>
                    <td width="100%" colspan="2" bgcolor="#dddddd" valign="top" style="padding-bottom:20px; font-size:2px; line-height:0px; text-align:center;"></td>
                </tr>
            </table>
			<!-- End of logo, phone and banner -->

			<!-- Start of letter layout with purchase now button -->
            <table class="row" width="610" bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; text-align:left; border-spacing:0; max-width:100%;">
                <tr>
                    <td width="50%" height="5" valign="top" style="font-size:2px; line-height:0px;"><img alt="" src="images/borderTopLeft.png" width="5" height="5" align="left" vspace="0" hspace="0" border="0" style="display:block; margin:0;" /></td>
                    <td width="50%" height="5" valign="top" style="font-size:2px; line-height:0px;"><img alt="" src="images/borderTopRight.png" width="5" height="5" align="right" vspace="0" hspace="0" border="0" style="display:block; margin:0;" /></td>
                </tr>
                <tr>
                    <td width="100%" colspan="2" style="padding-right:30px; padding-bottom:25px; padding-left:30px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:12px; line-height:15pt; color:#777777; text-align:center;">

						<?php echo $this->fetch('content'); ?>

                    </td>
                </tr>
                <tr>
                    <td width="50%" height="5" valign="bottom" style="font-size:2px; line-height:0px;"><img alt="" src="images/borderBottomLeft.png" width="5" height="5" align="left" vspace="0" hspace="0" border="0" style="display:block; margin:0;" /></td>
                    <td width="50%" height="5" valign="bottom" style="font-size:2px; line-height:0px;"><img alt="" src="images/borderBottomRight.png" width="5" height="5" align="right" vspace="0" hspace="0" border="0" style="display:block; margin:0;" /></td>
                </tr>
                <tr>
                    <td width="100%" colspan="2" bgcolor="#dddddd" valign="top" style="padding-bottom:20px; font-size:2px; line-height:0px; text-align:center;"></td>
                </tr>
            </table>
			<!-- End of letter layout with purchase now button -->

			<!-- Start of footer -->
            <table class="row" width="610" bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; text-align:left; border-spacing:0; max-width:100%;">
                <tr>
                    <td width="50%" height="5" valign="top" style="font-size:2px; line-height:0px;"><img alt="" src="images/borderTopLeft.png" width="5" height="5" align="left" vspace="0" hspace="0" border="0" style="display:block; margin:0;" /></td>
                    <td width="50%" height="5" valign="top" style="font-size:2px; line-height:0px;"><img alt="" src="images/borderTopRight.png" width="5" height="5" align="right" vspace="0" hspace="0" border="0" style="display:block; margin:0;" /></td>
                </tr>
                <tr>
                	<td width="100%" colspan="2">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; text-align:left; border-spacing:0; max-width:100%; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#777777;">
                            <tr>
                                <td class="website" width="50%" valign="top" style="padding-top:23px; padding-right:15px; padding-bottom:20px; padding-left:30px; font-family:'Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:24px; line-height:100%; color:#0c87c7; font-weight:300;">
                                    <a style="text-decoration:none; color:#0c87c7;" href="#">tiviastore.com</a>
                                </td>

                                <td class="socialIcons" width="50%" style="padding-top:20px; padding-right:30px; padding-bottom:18px; padding-left:15px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#777777; text-align:right;">
									<a href="#"><img alt="Facebook" src="http://softwaredev.com.ve/imagenes/facebookIcon.png" border="0" vspace="0" hspace="0" /></a>&nbsp;&nbsp;
                                    <a href="#"><img alt="Twitter" src="http://softwaredev.com.ve/imagenes/twitterIcon.png" border="0" vspace="0" hspace="0" /></a>&nbsp;&nbsp;
                                    <a href="#"><img alt="Google Plus" src="http://softwaredev.com.ve/imagenes/googlePlusIcon.png" border="0" vspace="0" hspace="0" /></a>&nbsp;&nbsp;
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="50%" height="5" valign="bottom" style="font-size:2px; line-height:0px;"><img alt="" src="images/borderBottomLeft.png" width="5" height="5" align="left" vspace="0" hspace="0" border="0" style="display:block; margin:0;" /></td>
                    <td width="50%" height="5" valign="bottom" style="font-size:2px; line-height:0px;"><img alt="" src="images/borderBottomRight.png" width="5" height="5" align="right" vspace="0" hspace="0" border="0" style="display:block; margin:0;" /></td>
                </tr>
                <tr>
                    <td width="100%" colspan="2" bgcolor="#dddddd" valign="top" style="padding-bottom:20px; font-size:2px; line-height:0px; text-align:center;"><img alt="" src="images/shadow_610.png" height="10" width="610" border="0" vspace="0" hspace="0" style="width:100% !important; height:10px !important;" /></td>
                </tr>
                <tr>
                    <td class="footer" width="100%" colspan="2" bgcolor="#dddddd" style="padding:0px 30px 25px 30px; font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:13pt; color:#777777; text-align:center; -webkit-text-size-adjust:none;">

                        Derechos reservados <img alt="©" src="images/copyright.png" border="0" height="10" width="10" /> 2014 <a style="text-decoration:underline; color:#0c87c7;" href="http://gifky.com">tiviastore.com</a> <br/>

                    </td>
                </tr>
            </table>
			<!-- End of footer -->
        </td>
    </tr>
</table>

</body>
</html>