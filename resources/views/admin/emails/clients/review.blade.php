<html>
<head>
    <title>Clients - Notification</title>
    <style type="text/css">
        body { margin: 0 0 0 0; font-family: Arial, Helvetica, sans-serif; line-height: 20px; color: #625750; }
        TD { padding: 15 15 15 15; line-height: 1.5; }
        .btn {
            text-decoration: none;
            color: white;
            font-weight: 400;
            border: 1px solid transparent;
            padding: 0.45rem 0.75rem;
            background-color: #f5a30b;
            border-color: #f6d57e;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
<table width="100%">
    <tr>
        <td colspan="3" align="center" style="padding: 15 15 15 15; text-align: center; background-color: #f5f5f5;"><img src="https://www.truckeasymoving.com/mkt/images/truck-easy-logo.png" width="120"></td>
    </tr>
    <tr>
        <td style="width: 10%;"></td>
        <td align="center">
     
            Hi {{ $to->firstName }}, <br><br>

            <big>We hope everything went well!</big><br>
            
            We'd really appreciate you taking a few minutes to write a review regarding your experience. We are constantly working to improve our quality of service to our customers and associates.<br><br>

            #<b>{{ $data->contractNumber }}</b><br>
            {{ $data->service }}<br><br>
                                    
            <a class="btn" href="https://clients.truckeasymoving.com/">Rate your experience</a><br><br>
                                    
            <small>
                Thanks in advance!<br>
                <b>Truck Easy Team</b>
            </small><br>
        
            
        </td>
        <td style="width: 10%;"></td>
    </tr>
    <tr>
        <td colspan="3" style="padding: 15 15 15 15; text-align: center; background-color: #f5f5f5;">
            <small style="font-size: 11px;">
                You are receiving this email because of an order you placed with Truck Easy Moving & Services<br /><br />
                <b>Truck Easy Moving & Services</b><br />
                <a href="tel:+16194319439">+1 619 431 9439</a> | <a href="mailto:info@truckeasymoving.com">info@truckeasymoving.com</a><br>
                <a href="https://www.truckeasymoving.com" target="_blank">www.truckeasymoving.com</a><br>
                © 2020 Truck Easy Moving & Services. All rights reserved.
            </small>
        </td>
    </tr>
</table>

</body>
</html>
