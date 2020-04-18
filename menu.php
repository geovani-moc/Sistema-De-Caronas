<?php require_once('php/common.php');?>
<div class="mdl-layout__drawer">
    <span class="mdl-layout-title">
        <span class="mdl-chip mdl-chip--contact">
            <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">A</span>
            <span class="mdl-chip__text"><?php echo $_SESSION['user']->nome?></span>
        </span>
    </span>
    <nav class="mdl-navigation">
        <a href="<?php echo base_url('historico.php'); ?>" class="mdl-navigation__link">Minhas Caronas</a>
        <a href="<?php echo base_url('carona.php')?>" class="mdl-navigation__link">Buscar Carona</a>
        <a href="<?php echo base_url('gerenciar.php')?>" class="mdl-navigation__link">Gerenciar Carona</a>
        <a href="<?php echo base_url('criar.php')?>" class="mdl-navigation__link">Criar Carona</a>
        <a href="<?php echo base_url('logout.php')?>" class="mdl-navigation__link">Logout</a>
    </nav>                    
</div>
