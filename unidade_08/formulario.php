<?php
    // Criar objeto de conexao
    $conecta = mysqli_connect("localhost","root","","andes");
    if ( mysqli_connect_errno()  ) {
        die("Conexao falhou: " . mysqli_connect_errno());
    }

    // selecao de estados
    $select = "SELECT estadoID, nome ";
    $select .= "FROM estados ";
    $lista_estados = mysqli_query($conecta, $select);
    if(!$lista_estados) {
        die("Erro no banco");
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP com AJAX</title> 
        
        <link href="_css/estilo.css" rel="stylesheet">
    </head>

    <body>
        <main>  
            <div id="janela_formulario">
                
                <form id="formulario_transportadora">
                    <label for="nometransportadora">Nome da Transportadora</label>
                    <input type="text" name="nometransportadora" id="nometransportadora">

                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco">

                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade">

                    <select name="estados">
                        <?php
                            while($linha = mysqli_fetch_assoc($lista_estados)) {
                        ?>
                            <option value="<?php echo $linha["estadoID"];  ?>">
                                <?php echo ($linha["nome"]);  ?>
                            </option>
                        <?php
                            }
                        ?>                        
                    </select>
                    
                    <input type="submit" value="Confirmar inclusão">  
                    
                    <div id="mensagem">
                        <p></p>
                    </div>
                </form> 
                
            </div>
        </main>
        
        <script src="jquery.js"></script>
        <script>
            $('#formulario_transportadora').submit(function(e){
                e.preventDefault();
                var formulario = $(this);
                var retorno = inserirFormulario(formulario)
            } ) ;

            function inserirFormulario(dados) {
                $.ajax({
                    type:"POST",
                    data:dados.serialize(),
                    url:"inserir_transportadora.php",
                    async:false
                }).then(sucesso, falha);

                function sucesso(data) {
                    $sucesso = $.parseJSON(data) ["sucesso"];
                    $('#mensagem').show();
                    $mensagem = $.parseJSON(data) ["mensagem"];
                    if($sucesso) {
                        $('#mensagem').html($mensagem);
                    } else {
                        $('#mensagem').html($mensagem);
                    }
                 }

                function falha() {
                    console.log("falha");
                }
            }
        </script>
    </body>
</html>