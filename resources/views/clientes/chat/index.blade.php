<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Chat cliente</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('css/cliente/chat/style.css') }}">
</head>

<body>
  <div class="containerchat">
    <h1 class="title">
    Chat del producto
  </h1>

  <div class="containermessage" id="sectionmessage">

  </div>

  <div>

    <form id="formsendmessage">
      @csrf
      <input class="chat-input"type="text" name="message" id="message">
      <input name="id" style="visibility: hidden" id="idchat" type="text" value={{ $id }}>
      <button class="btn btn-light" type="submit">Enviar</button>
    </form>
  </div>
  </div>


  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  @vite('resources/js/allchatsclientes.js')
  <script></script>
</body>

</html>
