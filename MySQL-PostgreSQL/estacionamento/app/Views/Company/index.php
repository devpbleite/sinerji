<?= $this->extend('Layouts/main') ?>

<?= $this->section('title') ?>
<?php echo $title ?? '' ?>
<?= $this->endSection() ?>

<?= $this->section('css') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $title; ?></h4>
                <?php echo form_open(route_to('company.process'), attributes: ['class' => 'form-sample']); ?>

                <div class="row">
                    <div class="form-group col-md-12 mb-4">
                        <label for="name">Nome da empresa</label>
                        <input type="text" required name="name" class="form-control" placeholder="Nome da empresa" value="<?php echo old('name', $company->name ?? null); ?>">
                        <?php echo validation_show_error('name'); ?>
                    </div>

                    <div class="form-group col-md-12 mb-4">
                        <label for="phone">Telefone da empresa</label>
                        <input type="tel" required name="phone" class="form-control" placeholder="Telefone da empresa" value="<?php echo old('phone', $company->phone ?? null); ?>">
                        <?php echo validation_show_error('phone'); ?>
                    </div>

                    <div class="form-group col-md-12 mb-4">
                        <label for="address">Endereço</label>
                        <input type="text" required name="address" class="form-control" placeholder="Endereço da empresa" value="<?php echo old('address', $company->address ?? null); ?>">
                        <?php echo validation_show_error('address'); ?>
                    </div>

                    <div class="form-group col-md-12 mb-4">
                        <label for="message">Mensagem</label>
                        <textarea class="form-control" name="message" id="message"><?php echo old('message', $company->message ?? null); ?></textarea>
                        <?php echo validation_show_error('message'); ?>
                    </div>

                </div>

                <?php if ($company->id !== null) : ?>
                    <!--Se já existir dados da empresa o form será enviado como put para update. -->
                    <?php echo form_hidden('_method', 'PUT'); ?>

                <?php endif; ?>

                <button type="submit" class="btn btn-primary btn-sm me-2">Salvar</button>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>