<div class="row">
    <div class="form-group col-md-12 mb-4">
        <label for="name">Nome</label>
        <input type="text" required name="name" class="form-control" placeholder="Nome da categoria" value="<?php echo old('name', $category['name'] ?? null); ?>">
        <?php echo validation_show_error('name'); ?>
    </div>

    <div class="col-md-12">
        <div class="alert alert-info text-dark">
            <strong>Exemplo de preenchimento de valores:</strong>
            <ul>
                <li>Para R$8.00 informe 800</li>
                <li>Para R$18.99 informe 1899</li>
                <li>Para R$100 informe 10000</li>
            </ul>
        </div>
    </div>


    <div class="form-group col-md-3 mb-4">
        <label for="price_hour">Preço por hora</label>
        <input type="number" required name="price_hour" class="form-control" placeholder="Preço por hora" value="<?php echo old('price_hour', $category['price_hour'] ?? null); ?>">
        <?php echo validation_show_error('price_hour'); ?>
    </div>

    <div class="form-group col-md-3 mb-4">
        <label for="price_day">Preço por dia</label>
        <input type="number" required name="price_day" class="form-control" placeholder="Preço por dia" value="<?php echo old('price_day', $category['price_day'] ?? null); ?>">
        <?php echo validation_show_error('price_day'); ?>
    </div>

    <div class="form-group col-md-3 mb-4">
        <label for="price_month">Preço por mês</label>
        <input type="number" required name="price_month" class="form-control" placeholder="Preço por mês" value="<?php echo old('price_month', $category['price_month'] ?? null); ?>">
        <?php echo validation_show_error('price_day'); ?>
    </div>

    <div class="form-group col-md-3 mb-4">
        <label for="spots">Número de vagas</label>
        <input type="number" required name="spots" class="form-control" placeholder="Vagas" value="<?php echo old('spots', $category['spots'] ?? null); ?>">
        <?php echo validation_show_error('spots'); ?>
    </div>

</div>

<button type="submit" class="btn btn-primary btn-sm me-2">Salvar</button>

<a href="<?php echo route_to('categories'); ?>" class="btn btn-info btn-sm">Voltar</a>