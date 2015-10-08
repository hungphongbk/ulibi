<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no" />
    <base href="http://localhost:8000/"/>
    <title>ULIBI - @yield('title','')</title>
    <style type="text/css">
        body, #bodyTable, #bodyCell, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;font-family:Helvetica, Arial, "Lucida Grande", sans-serif;}
        table{border-collapse:collapse;}
        table[id=bodyTable] {width:100%!important;margin:auto;max-width:500px!important;color:#7A7A7A;font-weight:normal;}
        img, a img{border:0; outline:none; text-decoration:none;height:auto; line-height:100%;}
        a {text-decoration:none !important;border-bottom: 1px solid;}
        h1, h2, h3, h4, h5, h6{color:#5F5F5F; font-weight:normal;
            font-family: Helvetica, sans-serif; font-size:20px; line-height:125%; text-align:Left; letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;}
        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}         table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;}         #outlook a{padding:0;}         img{-ms-interpolation-mode: bicubic;display:block;outline:none; text-decoration:none;}         body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; font-weight:normal!important;}         .ExternalClass td[class="ecxflexibleContainerBox"] h3 {padding-top: 10px !important;}                         h1{display:block;font-size:26px;font-style:normal;font-weight:normal;line-height:100%;}
        h2{display:block;font-size:20px;font-style:normal;font-weight:normal;line-height:120%;}
        h3{display:block;font-size:17px;font-style:normal;font-weight:normal;line-height:110%;}
        h4{display:block;font-size:18px;font-style:italic;font-weight:normal;line-height:100%;}
        .flexibleImage{height:auto;}
        .linkRemoveBorder{border-bottom:0 !important;}
        table[class=flexibleContainerCellDivider] {padding-bottom:0 !important;padding-top:0 !important;}
        body, #bodyTable{background-color:#E1E1E1;}
        #emailHeader{background-color:#E1E1E1;}
        #emailBody{background-color:#FFFFFF;}
        #emailFooter{background-color:#E1E1E1;}
        .textContent, .textContentLast{color:#8B8B8B; font-family:Helvetica; font-size:16px; line-height:125%; text-align:Left;}
        .textContent a, .textContentLast a{color:#205478; text-decoration:underline;}
        .nestedContainer{background-color:#F8F8F8; border:1px solid #CCCCCC;}
        .emailButton{background-color:#205478; border-collapse:separate;}
        .buttonContent{color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;}
        .buttonContent a{color:#FFFFFF; display:block; text-decoration:none!important; border:0!important;}
        .emailCalendar{background-color:#FFFFFF; border:1px solid #CCCCCC;}
        .emailCalendarMonth{background-color:#205478; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; padding-top:10px; padding-bottom:10px; text-align:center;}
        .emailCalendarDay{color:#205478; font-family:Helvetica, Arial, sans-serif; font-size:60px; font-weight:bold; line-height:100%; padding-top:20px; padding-bottom:20px; text-align:center;}
        .imageContentText {margin-top: 10px;line-height:0;}
        .imageContentText a {line-height:0;}
        #invisibleIntroduction {display:none !important;}                 span[class=ios-color-hack] a {color:#275100!important;text-decoration:none!important;}         span[class=ios-color-hack2] a {color:#205478!important;text-decoration:none!important;}
        span[class=ios-color-hack3] a {color:#8B8B8B!important;text-decoration:none!important;}
        .a[href^="tel"], a[href^="sms"] {text-decoration:none!important;color:#606060!important;pointer-events:none!important;cursor:default!important;}
        .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {text-decoration:none!important;color:#606060!important;pointer-events:auto!important;cursor:default!important;}
        @media only screen and (max-width: 480px){
            body{width:100% !important; min-width:100% !important;}                                     table[id="emailHeader"], table[id="emailBody"], table[id="emailFooter"], table[class="flexibleContainer"] {width:100% !important;}
            td[class="flexibleContainerBox"], td[class="flexibleContainerBox"] table {display: block;width: 100%;text-align: left;}
            td[class="imageContent"] img {height:auto !important; width:100% !important; max-width:100% !important;}
            img[class="flexibleImage"]{height:auto !important; width:100% !important;max-width:100% !important;}
            img[class="flexibleImageSmall"]{height:auto !important; width:auto !important;}
            table[class="flexibleContainerBoxNext"]{padding-top: 10px !important;}
            table[class="emailButton"]{width:100% !important;}
            td[class="buttonContent"]{padding:0 !important;}
            td[class="buttonContent"] a{padding:15px !important;}
        }
        @media only screen and (-webkit-device-pixel-ratio:.75){
        }
        @media only screen and (-webkit-device-pixel-ratio:1){
        }
        @media only screen and (-webkit-device-pixel-ratio:1.5){
        }
        @media only screen and (min-device-width : 320px) and (max-device-width:568px) {
        }
    </style>
</head>
<body bgcolor="#E1E1E1" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
<center style="background-color:#E1E1E1;">
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;">
        <tr>
            <td align="center" valign="top" id="bodyCell">
                <table bgcolor="#FFFFFF"  border="0" cellpadding="0" cellspacing="0" style="max-width: 700px" id="emailBody">
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:#FFFFFF;background-color: transparent;" bgcolor="#3498db">
                                <tr>
                                    <td align="center" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="flexibleContainer">
                                            <tr>
                                                <td align="center" valign="top" width="100%" class="flexibleContainerCell">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td align="center" valign="top" class="textContent">
                                                                <div style="width:100%;max-height:300px;display:block;overflow: hidden;">
                                                                <img src="img/fansipan1.jpg" alt="" style="width: 100%;"></div>
                                                                <h1 style="display: block;-webkit-margin-before: 0;-webkit-margin-after: 0;padding: 30px;font-size: 60px;margin-top: -120px;color: #fff;">ULIBI</h1>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF">
                                <tr>
                                    <td align="center" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="flexibleContainer">
                                            <tr>
                                                <td align="center" valign="top" width="100%" class="flexibleContainerCell">
                                                    <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td align="center" valign="top">
                                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                    <tr>
                                                                        <td valign="top" class="textContent">
                                                                            @yield('main-content')
                                                                        </td>
                                                                    </tr>
                                                                </table>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <!-- CENTERING TABLE // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody><tr style="padding-top:0;">
                                    <td align="center" valign="top">
                                        <!-- FLEXIBLE CONTAINER // -->
                                        <table border="0" cellpadding="30" cellspacing="0" width="100%" class="flexibleContainer">
                                            <tbody><tr>
                                                <td style="padding-top:0;" align="center" valign="top" width="100%" class="flexibleContainerCell">

                                                    <!-- CONTENT TABLE // -->
                                                    @yield('ex-content1','')
                                                    <!-- // CONTENT TABLE -->

                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <!-- // FLEXIBLE CONTAINER -->
                                    </td>
                                </tr>
                                </tbody></table>
                            <!-- // CENTERING TABLE -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="flexibleContainer">
                                            <tr>
                                                <td valign="top" width="100%" class="flexibleContainerCell">
                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td align="left" valign="top" class="flexibleContainerBox" style="background-color:#5F5F5F;">
                                                                <table border="0" cellpadding="30" cellspacing="0" width="100%" style="max-width:100%;">
                                                                    <tr>
                                                                        <td align="left" class="textContent">
                                                                            <h3 style="color:#FFFFFF;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">Left Column</h3>
                                                                            <div style="text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis.</div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td align="right" valign="top" class="flexibleContainerBox" style="background-color:#3498DB;">
                                                                <table class="flexibleContainerBoxNext" border="0" cellpadding="30" cellspacing="0" width="100%" style="max-width:100%;">
                                                                    <tr>
                                                                        <td align="left" class="textContent">
                                                                            <h3 style="color:#FFFFFF;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">Right Column</h3>
                                                                            <div style="text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis.</div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</center>
</body>
</html>