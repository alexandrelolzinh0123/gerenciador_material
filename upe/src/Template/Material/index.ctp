<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Material[]|\Cake\Collection\CollectionInterface $material
  */

$loguser = $this->request->session ()->read ( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <!-- <li class="heading"><?= __('Actions') ?></li> -->
        <li id="add"><?= $this->Html->link(__('Adicionar Material'), ['action' => 'add'], ['class' => $loguser['role'] === 'Aluno' ? 'disable' : 'enabled']) ?></li>
        <!-- <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li> -->
        <!-- <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?></li> -->
    </ul>
</nav>
<div class="material index large-9 medium-8 columns content">
    <h3 align="center"><?= __('Materiais Disponibilizados') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('data') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Professor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Material') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assunto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('disciplina') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($material as $material): ?>
            <tr>
                <td><?= h($material->data) ?></td>
                <td> <?= $material->user->nome ?></td>
                <td>
                <a href="<?= $material->file->path.$material->file->name ?>" ><?= $material->file->name ?></a>
                </td>
                <td><?= h($material->assunto) ?></td>
                <td><?= h($material->disciplina) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('ver mais'), ['action' => 'view', $material->id]) ?><br>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $material->id]) ?><br>
                    <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $material->id], ['confirm' => __('Are you sure you want to delete # {0}?', $material->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
