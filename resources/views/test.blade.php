<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 id="tes">Test</h1>
    @vite('resources/js/app.js')
    <script>

        setTimeout(() => {
            window.Echo.channel('testing').
            listen('App\\Events\\testWebsocket', (e) => {
                console.log(e)

            })
        }, 200);




    </script>
</body>


</html>
