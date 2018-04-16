<?php
$usuariosOnline = Painel::listarUsuariosOnline();

$usuariosSalvos = Usuarios::usersCadastrados();

$contadorVisita = Database::conectar()->prepare("SELECT * FROM visitas");
$contadorVisita->execute();
$contadorVisita = $contadorVisita->rowCount();

$visitaHoje = Database::conectar()->prepare("SELECT * FROM visitas WHERE dia = ?");
$visitaHoje->execute(array(date('Y-m-d')));
$visitaHoje = $visitaHoje->rowCount();
?>
<div class="box-content w100">
    <h2><i class="fa fa-home"></i> Painel de Controle</h2>
    <div class="metricas">
        <div class="metricas-single">
            <h2>Usuarios Online</h2>
            <p><?php echo count($usuariosOnline); ?></p>
        </div><!--metricas-single-->
        <div class="metricas-single">
            <h2>Total de Visitas</h2>
            <p><?php echo $contadorVisita; ?></p>
        </div><!--metricas-single-->
        <div class="metricas-single">
            <h2>Visitas Hoje</h2>
            <p><?php echo $visitaHoje; ?></p>
        </div><!--metricas-single-->
    </div><!--metricas-->
    <div class="clear"></div>
</div><!--box-content-->

<div class="box-content w50 left">
    <h2><i class="fa fa-rocket"></i> Usuarios Online</h2>
    <div class="tabela_resp">
        <div class="row">
            <div class="col">
                <span>IP</span>
            </div><!--col-->
            <div class="col">
                <span>Ultima Acao</span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->
        <?php foreach($usuariosOnline as $value): ?>
        <div class="row">
            <div class="col">
                <span><?php echo $value['ip']; ?></span>
            </div><!--col-->
            <div class="col">
                <span><?php echo date('d/m/Y h:i:s',strtotime($value['ultima_acao'])); ?></span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->
        <?php endforeach; ?>
    </div><!--tabela_resp-->
</div><!--box-content-->

<div class="box-content w50 right">
    <h2><i class="fa fa-rocket"></i> Usuarios Cadastrados no Painel</h2>
    <div class="tabela_resp">
        <div class="row">
            <div class="col">
                <span>Usuario</span>
            </div><!--col-->
            <div class="col">
                <span>Permissao</span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->
        <?php foreach($usuariosSalvos as $value): ?>
            <div class="row">
                <div class="col">
                    <span><?php echo $value['usuario']; ?></span>
                </div><!--col-->
                <div class="col">
                    <span><?php echo $value['cargo']; ?></span>
                </div><!--col-->
                <div class="clear"></div>
            </div><!--row-->
        <?php endforeach; ?>
    </div><!--tabela_resp-->
</div><!--box-content-->