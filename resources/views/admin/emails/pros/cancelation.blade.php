<html>
<head>
    <title>Pros - Reminder</title>
    <style type="text/css">
        body { margin: 0 0 0 0; font-family: Arial, Helvetica, sans-serif; line-height: 20px; color: #625750; }
        TD { padding: 15 15 15 15; line-height: 1.5; }
        a {
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
     
            Hey {{ $to->firstName }}, <br><br>

            <big>We are sorry!</big><br>
            The job below was cancelled by the customer.<br>
            Please, DO NOT do this work as previously planned, the job request has been removed from your calendar. <br><br>
            
            {{ $data->firstName }}<br>
            {{ $data->service }}<br>
            {{ $data->dateScheduleFormated }}<br><br>

            More jobs are on the way!<br><br>
        
        </td>
        <td style="width: 10%;"></td>
    </tr>
    <tr>
        <td colspan="3" style="padding: 15 15 15 15; text-align: center; background-color: #f5f5f5;">
            <small>
                <b>Truck Easy Moving & Services</b><br />
                © 2020 Truck Easy Moving & Services. All rights reserved.
            </small>
        </td>
    </tr>
</table>

</body>
</html>
