<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Conatct Us Email</h2>
    <p><strong>Email: </strong>{{ $data['email'] }}</p>
    <p><strong>Name: </strong>{{ $data['name'] }}, Last Name: {{ $data['surname'] }}</p>
    <p><strong>Need: </strong>{{ $data['need'] }}</p>
    <h3>Message:</h3>
    <textarea rows="8" cols="64" disabled>{{ $data['message'] }}</textarea>
  </body>
</html>