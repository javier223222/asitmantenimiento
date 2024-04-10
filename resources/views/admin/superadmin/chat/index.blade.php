<!DOCTYPE html>
<head>
  <title>Pusher Test</title>

</head>
<body>

 <input id="idchat" type="text" value={{$id}}>

 <form action="{{route("broadcast")}}" method="post">
    @csrf
    <input type="text" name="message" id="message">
    <input name="id" type="text" value={{$id}}>

    <button type="submit">Enviar</button>
 </form>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
  @vite('resources/js/allchats.js')
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
  let id=document.getElementById("idchat").value
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;


    var pusher = new Pusher('f5a37d38fd2093fcda1f', {
      cluster: 'us2'
    });


    var channel = pusher.subscribe('my-chat'+id);
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>

</body>
