<div class="row">
    <div class="form-group col-md-12 mb-4">
        <label for="name">Nome</label>
        <input type="text"  name="name" class="form-control" placeholder="Nome do Mensalista" value="<?php echo old('name', $customer['name'] ?? null); ?>">
        <?php echo validation_show_error('name'); ?>
    </div>

    <div class="form-group col-md-4 mb-4">
        <label for="cpf">CPF</label>
        <input type="text"  name="cpf" class="form-control" placeholder="Cpf Válido" value="<?php echo old('cpf', $customer['cpf'] ?? null); ?>">
        <?php echo validation_show_error('cpf'); ?>
    </div>

    <div class="form-group col-md-4 mb-4">
        <label for="phone">Telefone</label>
        <input type="tel"  name="phone" class="form-control" value="<?php echo old('phone', $customer['phone'] ?? null); ?>">
        <?php echo validation_show_error('phone'); ?>
    </div>

    <div class="form-group col-md-4 mb-4">
        <label for="email">E-mail</label>
        <input type="email"  name="email" placeholder="algum@email.com" class="form-control" value="<?php echo old('email', $customer['email'] ?? null); ?>">
        <?php echo validation_show_error('email'); ?>
    </div>

</div>

<button type="submit" class="btn btn-primary btn-sm me-2">Salvar</button>

<a class="btn btn-primary btn-sm me-2" href="<?php echo route_to('customers'); ?>">Voltar</a>