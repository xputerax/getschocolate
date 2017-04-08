Hi {{ @fname }} {{ @lname }}, <br><br>

Click the link below to reset your password: <br>
<a href="{{ @URL.'account/reset?email='.@email.'&reset_key='.@reset_key }}">
{{ @URL.'account/reset?email='.@email.'&reset_key='.@reset_key }}
</a> <br><br>

If the link doesn't work, please copy and paste the url into the address bar. <br><br>
