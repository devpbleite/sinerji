<div class="row">
    <div class="form-group col-md-12 mb-4">
        <label for="plate">Placa</label>
        <input type="text" name="plate" class="form-control" placeholder="Número da placa" value="<?php echo old('plate', $car['plate'] ?? null); ?>">
        <?php echo validation_show_error('plate'); ?>
    </div>

    <div class="form-group col-md-12 mb-4">
        <label for="vehicle">Descrição do veículo</label>
        <input type="text" name="vehicle" class="form-control" placeholder="Ex: Kia Sorento Branca 2024" value="<?php echo old('vehicle', $car['vehicle'] ?? null); ?>">
        <?php echo validation_show_error('vehicle'); ?>
    </div>
</div>
<?php echo form_hidden('customer_id', (string) $customer_id) ?>

<button type="submit" class="btn btn-primary btn-sm me-2">Salvar</button>

<a class="btn btn-primary btn-sm me-2" href="<?php echo route_to('customers.cars', (string) $customer_id); ?>">Voltar</a>