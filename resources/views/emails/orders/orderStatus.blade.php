
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Email Confirmation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <style type="text/css">

    @media screen {
        @font-face {
        font-family: 'Source Sans Pro';
        font-style: normal;
        font-weight: 400;
        src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
        }
        @font-face {
        font-family: 'Source Sans Pro';
        font-style: normal;
        font-weight: 700;
        src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
        }
    }
    body,
    table,
    td,
    a {
        -ms-text-size-adjust: 100%; /* 1 */
        -webkit-text-size-adjust: 100%; /* 2 */
    }
    table,
    td {
        mso-table-rspace: 0pt;
        mso-table-lspace: 0pt;
    }
    img {
        -ms-interpolation-mode: bicubic;
    }
    a[x-apple-data-detectors] {
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        color: inherit !important;
        text-decoration: none !important;
    }
    div[style*="margin: 16px 0;"] {
        margin: 0 !important;
    }
    body {
        width: 100% !important;
        height: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    table {
        border-collapse: collapse !important;
    }
    a {
        color: #1a82e2;
    }
    img {
        height: auto;
        line-height: 100%;
        text-decoration: none;
        border: 0;
        outline: none;
    }
  </style>

</head>
<body style="background-color: #e9ecef;">

  <!-- start preheader -->
  <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
    A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
  </div>
  <table border="0" cellpadding="0" cellspacing="0" width="100%">


    <tr>
      <td align="center" bgcolor="#e9ecef">

          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
            <tr>
                <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                    <h2>Dear {{ $user->firstname }}  {{ $user->lastname }},</h2>
                    <p style="margin: 0; font-size: 27px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Order Status Update</p>
            </td>
          </tr>
        </table>

      </td>
    </tr>
    <tr>
      <td align="center" bgcolor="#e9ecef">

          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

            <tr>
                <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                <p>We are writing to inform you about a change in the status of your order with MyEbag.</p>
                <p><strong>Order Number:</strong># {{ $number }}</p>
                <p><strong>Your Order is :</strong> </p>
            </td>
          </tr>
          <tr>
            <td align="left" bgcolor="#ffffff">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                    <table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center" bgcolor="{{ $color }}" style="border-radius: 6px;">

                            {{-- // link must be here  --}}

                            <a href="http://localhost:8080/orders" target="_blank" style="display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">{{ $status }}</a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
              <p style="margin: 0;">See details <a href="http://localhost:8080/orders" target="_blank" style="text-decoration: none; ">My Orders</a></p>            </td>
          </tr>
          <td align="left" bgcolor="#ffffff" style="padding: 10px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
            <p style="margin: 0;"> <a href="https://myebag.shop" style="text-decoration: none; color:blueviolet">MyEbag</a><span style="font-family:poppins"> Orders Traking team</span></p>
          </td>
          <tr>
          </tr>
        </table>
      </td>
    </tr>


  </table>
  <!-- end body -->

</body>
</html>
