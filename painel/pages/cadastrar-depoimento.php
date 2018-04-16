<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Depoimentos</h2>

    <form method="post">
        <?php
        if(isset($_POST['acao'])){

            if(Painel::insert($_POST)){
                Painel::alert('sucesso',' Depoimento cadastrado com sucesso!');
            }else{
                Painel::alert('erro',' Campos vazios nao sao aceitos!');
            }
        }

        ?>
        <div class="form-group">
            <label>Nome do depoente:</label>
            <input type="text" name="nome">
        </div><!--form-group-->
        <div class="form-group">
            <label>Depoimento:</label>
            <textarea name="depoimento"></textarea>
        </div><!--form-group-->
        <div class="form-group">
            <label>Data:</label>
            <input formato="data" type="text" name="data">
        </div><!--form-group-->
        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="depoimentos">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->