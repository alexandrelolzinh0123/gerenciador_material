<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Material $material
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editar Material'), ['action' => 'edit', $material->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Deletar Material'), ['action' => 'delete', $material->id], ['confirm' => __('Are you sure you want to delete # {0}?', $material->id)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Material'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Adicionar Material'), ['action' => 'add']) ?> </li>
        <!-- <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="material view large-9 medium-8 columns content">
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Professor') ?></th>
            <td><?= h($material->user->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Assunto') ?></th>
            <td><?= h($material->assunto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Disciplina') ?></th>
            <td><?= h($material->disciplina) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data') ?></th>
            <td><?= h($material->data) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Material') ?></th>
            <td><a href="<?= $material->file->path.$material->file->name ?>" ><?= $material->file->name ?></td>
        </tr>
    </table>
    <div class="row">
        <h4 align="center"><?= __('Observacoes') ?></h4>
        <?= $this->Text->autoParagraph(h($material->observacoes)); ?>
    </div>
</div>
