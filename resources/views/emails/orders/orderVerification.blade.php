<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Verification</title>
    <style type="text/css">
        html {
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }

        @media only screen and (max-device-width:660px),
        only screen and (max-width:660px) {
            .em-mob-width-100perc {
                width: 100% !important;
                max-width: 100% !important;
            }

            .em-mob-width-91perc {
                width: 91% !important;
                max-width: 91% !important;
            }
        }

        @media screen {
            .Montserrat400 {
                font-family: "Montserrat", Arial, sans-serif !important;
                font-weight: 400 !important;
            }
        }
    </style>
    <style em="styles">
        @media only screen and (max-device-width:660px),
        only screen and (max-width:660px) {
            .em-mob-width-100perc {
                width: 100% !important;
                max-width: 100% !important;
            }

            .em-mob-width-91perc {
                width: 91% !important;
                max-width: 91% !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
    <div style="">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-size: 1px; line-height: normal;">
            <tr em="group">
                <td align="center" bgcolor="AFB7FF" style="background-color: #ffffff;">

                    <table cellpadding="0" cellspacing="0" width="100%" border="0"
                        style="max-width: 800px; min-width: 320px; width: 100%;">
                        <tr em="block" class="empty-structure">
                            <td align="center" bgcolor="CCD1FF">

                                <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0"
                                    style="max-width: 660px;">
                                    <tr>
                                        <td align="center" valign="top">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td height="30"></td>
                                                </tr>
                                            </table>

                                            <div style="display: inline-block; width: 100%; max-width: 660px; vertical-align: top;"
                                                class="em-mob-width-100perc">
                                                <table width="602" border="0" cellspacing="0" cellpadding="0"
                                                    style="width: 91%; max-width: 602px;" class="em-mob-width-91perc">
                                                    <tr>
                                                        <td align="left">
                                                            <div em="atom">
                                                                <table cellpadding="0" cellspacing="0" border="0"
                                                                    width="100%">
                                                                    <tr>
                                                                        <td height="10"></td>
                                                                    </tr>
                                                                </table>
                                                                <div
                                                                    style="font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 16px; line-height: 24px; color: #333333;">
                                                                    <span style="color: #082846;"><strong><span
                                                                                style="font-size: 22px;">Dear
                                                                                {{ $data['user']->lastname }}
                                                                                {{ $data['user']->firstname }},</span></strong></span><br><br><span
                                                                        style="color: #082846;">Thank you for your
                                                                        recent purchase from MyEbag. We're
                                                                        thrilled that you chose us.</span><br><br><span
                                                                        style="color: #082846;">Here are the details of
                                                                        your order:</span><br><br><span
                                                                        style="color: #082846;"><strong>Order
                                                                            Number
                                                                            #{{ $data['order_details']->id }}</strong>:
                                                                    </span><br><br>
                                                                    {{-- <span style="color: #082846;"><strong>Date</strong>:
                                                                        {{ year($data['order_details']->created_at) }}</span><br> --}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr em="block">
                            <td align="center" bgcolor="CCD1FF">
                                <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%"
                                    style="max-width: 660px;">
                                    <tr>
                                        <td align="center" bgcolor="#FFFFFF">
                                            <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                width="91%">
                                                <tr>
                                                    <td align="left">
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                            width="100%">
                                                            <tr>
                                                                <td height="20"></td>
                                                            </tr>
                                                        </table>
                                                        <table align="center" cellpadding="0" cellspacing="0"
                                                            border="0" width="100%">
                                                            <tr>
                                                                <td valign="top"
                                                                    style="border-bottom: 1px solid #c0c0c0;">&nbsp;
                                                                </td>
                                                                <td valign="top"
                                                                    style="border-bottom: 1px solid #c0c0c0;">&nbsp;
                                                                </td>
                                                                <td valign="top" align="right"
                                                                    style="border-bottom: 1px solid #c0c0c0;">
                                                                    <div style="line-height: normal; font-size: 14px; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"
                                                                        ui="" helvetica="" neue=""
                                                                        font-size:="" line-height:="" color:=""
                                                                        white-space:="" padding:="">Quantity</div>
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        border="0" width="100%">
                                                                        <tr>
                                                                            <td height="15"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td valign="top" align="right"
                                                                    style="border-bottom: 1px solid #c0c0c0;">
                                                                    <div
                                                                        style="line-height: normal; font-size: 14px; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: line-height: color: white-space: padding:">
                                                                        Price/piece</div>
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        border="0" width="100%">
                                                                        <tr>
                                                                            <td height="20"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            @foreach ($data['order_details']->order_items as $item)
                                                                <tr em="atom">
                                                                    <td width="13%"
                                                                        style="border-bottom: 1px solid #c0c0c0;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            border="0" width="100%">
                                                                            <tr>
                                                                                <td height="20"></td>
                                                                            </tr>
                                                                        </table>
                                                                        <div style="line-height: normal; font-size: 14px; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"
                                                                            ui="" helvetica=""
                                                                            neue="" font-size:=""
                                                                            line-height:="" color:=""
                                                                            width="50%">
                                                                            {{ $item->product_variation->product->name }}
                                                                        </div>
                                                                    </td>
                                                                    <td
                                                                        style="border-bottom: 1px solid #c0c0c0; padding: 0 10px;">

                                                                    </td>
                                                                    <td align="right"
                                                                        style="border-bottom: 1px solid #c0c0c0; padding: 0 10px;">

                                                                        <div style="line-height: normal; font-size: 14px; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"
                                                                            ui="" helvetica=""
                                                                            neue="" font-size:=""
                                                                            line-height:="" color:="">
                                                                            {{ $item->quantity }}
                                                                        </div>
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            border="0" width="100%">
                                                                            <tr>
                                                                                <td height="20"></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td align="right"
                                                                        style="border-bottom: 1px solid #c0c0c0; padding: 0 10px;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            border="0" width="100%">
                                                                            <tr>
                                                                                <td height="20"></td>
                                                                            </tr>
                                                                        </table>
                                                                        <div style="line-height: normal; font-size: 14px; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"
                                                                            ui="" helvetica=""
                                                                            neue="" font-size:=""
                                                                            line-height:="" color:="">
                                                                            {{ $item->product_variation->price }}$
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                border="0" width="100%">
                                                                                <tr>
                                                                                    <td height="20"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                        <table align="center" cellpadding="0" cellspacing="0"
                                                            border="0" width="100%">
                                                            <tr>
                                                                <td align="right">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        border="0" width="100%">
                                                                        <tr>
                                                                            <td height="10"></td>
                                                                        </tr>
                                                                    </table>
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        {{-- shipping price --}}
                                                                        {{-- <tr>
                                                                        <td align="right">
                                                                            <div style="line-height: normal; font-size: 14px; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"
                                                                                ui="" helvetica=""
                                                                                neue="" font-size:=""
                                                                                line-height:="" color:="">
                                                                                Shipment:<table cellpadding="0"
                                                                                    cellspacing="0" border="0"
                                                                                    width="100%">
                                                                                    <tr>
                                                                                        <td height="10"></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                        <td width="50">&nbsp;</td>
                                                                        <td align="right">
                                                                            <div style="line-height: normal; font-size: 14px; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"
                                                                                ui="" helvetica=""
                                                                                neue="" font-size:=""
                                                                                line-height:="" color:="">
                                                                                $XX.XX<table cellpadding="0"
                                                                                    cellspacing="0" border="0"
                                                                                    width="100%">
                                                                                    <tr>
                                                                                        <td height="10"></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                    </tr> --}}



                                                                        {{-- discount  --}}
                                                                        {{-- <tr>
                                                                        <td align="right">
                                                                            <div style="line-height: normal; font-size: 14px; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"
                                                                                ui="" helvetica=""
                                                                                neue="" font-size:=""
                                                                                line-height:="" color:="">
                                                                                Discount:<table cellpadding="0"
                                                                                    cellspacing="0" border="0"
                                                                                    width="100%">
                                                                                    <tr>
                                                                                        <td height="10"></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                        <td width="50">&nbsp;</td>
                                                                        <td align="right">
                                                                            <div style="line-height: normal; font-size: 14px; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"
                                                                                ui="" helvetica=""
                                                                                neue="" font-size:=""
                                                                                line-height:="" color:="">
                                                                                -$XX.XX<table cellpadding="0"
                                                                                    cellspacing="0" border="0"
                                                                                    width="100%">
                                                                                    <tr>
                                                                                        <td height="10"></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                    </tr> --}}
                                                                        <tr>
                                                                            <td align="right">
                                                                                <div
                                                                                    style="font-family: font-family-4remove-0, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 21px; color: #333333;">
                                                                                    <st></st><strong
                                                                                        style="line-height: 21px; color: #082846;font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">Shipment:
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            border="0"
                                                                                            width="100%">
                                                                                            <tr>
                                                                                                <td height="10">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </strong>
                                                                                </div>
                                                                            </td>
                                                                            <td width="50">&nbsp;</td>
                                                                            <td align="right">
                                                                                <div style="font-family: font-family-4remove-0, -apple-system, "
                                                                                    ui="" helvetica=""
                                                                                    neue="" font-size:=""
                                                                                    line-height:="" color:="">
                                                                                    <st></st><strong
                                                                                        style="line-height: 21px; color: #082846; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px">
                                                                                        5$
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            border="0"
                                                                                            width="100%">
                                                                                            <tr>
                                                                                                <td height="10">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </strong>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="right">
                                                                                <div
                                                                                    style="font-family: font-family-4remove-0, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 21px; color: #333333;">
                                                                                    <st></st><strong
                                                                                        style="line-height: 21px; color: #082846;font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">Total:
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            border="0"
                                                                                            width="100%">
                                                                                            <tr>
                                                                                                <td height="10">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </strong>
                                                                                </div>
                                                                            </td>
                                                                            <td width="50">&nbsp;</td>
                                                                            <td align="right">
                                                                                <div style="font-family: font-family-4remove-0, -apple-system, "
                                                                                    ui="" helvetica=""
                                                                                    neue="" font-size:=""
                                                                                    line-height:="" color:="">
                                                                                    <st></st><strong
                                                                                        style="line-height: 21px; color: #082846; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px">
                                                                                        {{ $data['order_details']->total }}$
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            border="0"
                                                                                            width="100%">
                                                                                            <tr>
                                                                                                <td height="10">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </strong>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="right">
                                                                                <div style="line-height: normal; font-size: 14px; font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"
                                                                                    ui="" helvetica=""
                                                                                    neue="" font-size:=""
                                                                                    line-height:="" color:="">
                                                                                    Paid:<table cellpadding="0"
                                                                                        cellspacing="0" border="0"
                                                                                        width="100%">
                                                                                        <tr>
                                                                                            <td height="10"></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </td>
                                                                            <td width="50">&nbsp;</td>
                                                                            <td align="right">
                                                                                <div style="font-family: font-family-4remove-0, -apple-system, "
                                                                                    ui="" helvetica=""
                                                                                    neue="" font-size:=""
                                                                                    line-height:="" color:="">
                                                                                    @if ($data['payment_details']->status == true)
                                                                                        Completed
                                                                                    @else
                                                                                        Not paid
                                                                                    @endif
                                                                                    <table cellpadding="0"
                                                                                        cellspacing="0" border="0"
                                                                                        width="100%">
                                                                                        <tr>
                                                                                            <td height="10"></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </td>
                                                                        </tr>

                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td height="20"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr em="block" class="empty-structure">
                            <td align="center" bgcolor="CCD1FF">
                                <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0"
                                    style="max-width: 660px;">
                                    <tr>
                                        <td align="center" valign="top">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                            </table>
                                            <div style="display: inline-block; width: 100%; max-width: 660px; vertical-align: top;"
                                                class="em-mob-width-100perc ">
                                                <table width="602" border="0" cellspacing="0" cellpadding="0"
                                                    style="width: 91%; max-width: 602px;" class="em-mob-width-91perc">
                                                    <tr>
                                                        <td align="left">
                                                            <div em="atom">
                                                                <table cellpadding="0" cellspacing="0" border="0"
                                                                    width="100%">
                                                                    <tr>
                                                                        <td height="10"></td>
                                                                    </tr>
                                                                </table>
                                                                <div
                                                                    style="font-family: system-ui, -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 16px; line-height: 24px; color: #333333;">
                                                                    <span style="color: #082846;"><strong>Shipping Address</strong>:
                                                                        {{ $data['address']->adress_line1 }}
                                                                        {{ $data['address']->city }} {{ $data['address']->postal_code }}
                                                                    </span><br><br>
                                                                    <span
                                                                        style="color: #082846;"><strong>Payment
                                                                            Method</strong>:
                                                                        {{ $data['payment_details']->provider == 'cod' ? 'cash on delivery' : $data['payment_details']->provider }}</span><br><br><span
                                                                        style="color: #082846;">If you
                                                                        have any
                                                                        questions or concerns regarding your order,
                                                                        please feel free to reach out to us via email or
                                                                        phone, and we'll be happy to assist
                                                                        you.</span><br><br><span
                                                                        style="color: #082846;">Best
                                                                        regards,</span><br><br><span
                                                                        style="color: #082846;"> Orders Tracking
                                                                        Teams</span><br><br><span
                                                                        style="color: #082846;">MyEbag</span><br>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table cellpadding="0" cellspacing="0" border="0"
                                                    width="100%">
                                                    <tr>
                                                        <td height="20"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!--[if (gte mso 9)|(IE)]>
     </td></tr>
     </table><![endif]-->
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!--[if (gte mso 9)|(IE)]>
  </td></tr></table>
  <![endif]-->
                            </td>
                        </tr>
                        {{-- <tr em="block">
                <td align="center" valign="top" style="background: #ccd1ff;" bgcolor="#CCD1FF">
                    <div style="height: 60px; line-height: 60px; font-size: 8px;">&nbsp;</div>
                    <table cellpadding="0" cellspacing="0" border="0" width="80%"
                        style="width: 80%; min-width: 330px;">
                        <tr>
                            <td align="center">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td align="center" valign="top" width="41" style="width: 41px;">
                                            <span><a href="" target="_blank"
                                                    style="display: block; max-width: 27px;">
                                                    <img src="https://cdn.useblocks.io/1865/221025_18_JiyNwYD.png"
                                                        width="27" border="0" alt=""
                                                        style="display: block; width: 100%; max-width: 27px;">
                                                </a></span>
                                        </td>
                                        <td align="center" valign="top" width="41" style="width: 41px;">
                                            <span><a href="" target="_blank"
                                                    style="display: block; max-width: 27px;">
                                                    <img src="https://cdn.useblocks.io/1865/221025_18_ISbMfds.png"
                                                        width="27" border="0" alt=""
                                                        style="display: block; width: 100%; max-width: 27px;">
                                                </a></span>
                                        </td>
                                        <td align="center" valign="top" width="41" style="width: 41px;">
                                            <span><a href="" target="_blank"
                                                    style="display: block; max-width: 27px;">
                                                    <img src="https://cdn.useblocks.io/1865/221025_18_J0ybr5d.png"
                                                        width="27" border="0" alt=""
                                                        style="display: block; width: 100%; max-width: 27px;">
                                                </a></span>
                                        </td>
                                        <td align="center" valign="top" width="41" style="width: 41px;">
                                            <span><a href="" target="_blank"
                                                    style="display: block; max-width: 27px;">
                                                    <img src="https://cdn.useblocks.io/1865/221025_18_Db1Vz8t.png"
                                                        width="27" border="0" alt=""
                                                        style="display: block; width: 100%; max-width: 27px;">
                                                </a></span>
                                        </td>
                                    </tr>
                                </table>
                                <div style="height: 15px; line-height: 15px; font-size: 8px;">&nbsp;</div>
                                <div class="Montserrat400 "
                                    style="font-family: Arial, sans-serif; color: #082846; font-size: 14px; line-height: 20px;">
                                    You’ve received this email because you subscribed to&nbsp;get our
                                    updates.</div>
                                <div style="height: 15px; line-height: 15px; font-size: 8px;">&nbsp;</div>
                                <a href="" target="_blank" class="Montserrat400 "
                                    style="font-family: Arial, sans-serif; color: #082846; font-size: 14px; line-height: 20px; text-decoration: underline;">Unsubscribe</a>
                                <div style="height: 40px; line-height: 40px; font-size: 8px;">&nbsp;</div>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr em="block" class="empty-structure">
                <td align="center">
                    <!--[if (gte mso 9)|(IE)]>
  <table cellpadding="0" cellspacing="0" border="0" width="660"><tr><td>
  <![endif]-->
                    <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0"
                        style="max-width: 660px;">
                        <tr>
                            <td align="center" valign="top">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                    em="atom">
                                    <tr>
                                        <td height="50"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
  </td></tr></table>
  <![endif]-->
                </td>
            </tr> --}}
                    </table>
                    <!--[</tr>if (gte mso 9)|(IE)]>
    </td></tr></table>
    <![endif]-->
                </td>
            </tr>
        </table>
</body>

</html>
