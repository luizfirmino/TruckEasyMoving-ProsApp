<html>
<head>
    <title>Pros - E-mail Reminder</title>
</head>
<body>

Hey {{ $to->firstName }}, <br><br>

This is a reminder that you have a job pending confirmation,<br><br>
<big>{{ $data->firstName }}</big><br>
{{ $data->service }}<br>
{{ $data->dateScheduleFormated }}<br><br>
    
Please, click on the link below to see more details and confirm or pass on the job.<br><br>

<a href="https://pros.truckeasymoving.com/jobUpcoming/{{ $data->orderId }}/">Confirm the details</a>

</body>
    
</html>