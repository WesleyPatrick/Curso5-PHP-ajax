<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP com AJAX</title>
    </head>

    <body>
            <h1 class="curso"></h1>

            <script src="jquery.js"></script>
            <script>
                $('h1.curso').load('dados.txt');
            </script>
    </body>
</html>