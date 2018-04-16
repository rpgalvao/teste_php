<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Serviços</h2>

    <form method="post">
        <?php
        if(isset($_POST['acao'])){

            if(Painel::insert($_POST)){
                Painel::alert('sucesso',' Serviço cadastrado com sucesso!');
            }else{
                Painel::alert('erro',' Campos vazios não são aceitos!');
            }
        }

        ?>
        <div class="form-group">
            <label>Descrição do Serviço:</label>
            <textarea name="servico"></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="servicos">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->