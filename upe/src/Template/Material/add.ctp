<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Listar Material'), ['action' => 'index']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li> -->
        <!-- <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li> -->
        <!-- <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="material form large-9 medium-8 columns content">
    <?= $this->Form->create($material,['type'=>'file']) ?>
    <fieldset>
        <legend align="center"><h3><?= __('Adicionar Material') ?></h3></legend>
        <?php
            echo $this->Form->control('data');
            // echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('files_id', ['type'=>'file']);
            echo $this->Form->control('assunto');
            echo $this->Form->control('observacoes');
            echo $this->Form->control('disciplina');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
