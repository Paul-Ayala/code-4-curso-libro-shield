<?= $this->extend('Layouts/web') ?>
<?= $this->section('contenido') ?>
<?php foreach ($usuarios as $user) : ?>
    <div class="card bg-light mt-4">
        <div class="card-header">
        <?= $user->username ?>
        </div>
        <div class="card-body">
            ...
        </div>
        <div class="card-footer">
            <a href="<?= route_to('usuario.show', $user->id)?>" class="btn btn-primary">Grupos y permisos</a>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection() ?>