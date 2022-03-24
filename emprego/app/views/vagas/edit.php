<?php require APPROOT . '/views/inc/header.php';?>
<main>
    <section class="mt-3">
        <a href="<?php echo URLROOT ?>/vagas">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>
    <h2 class="mt-2">Editar vaga</h2>

    <form action="<?php echo URLROOT; ?>/vagas/edit/<?php echo $data->id;?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Título</label>
            <input type="text" class="form-control" name="titulo" value="<?php echo $data->titulo; ?>">
        </div>

        <div class="form-group mt-3">
            <label>Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="5"><?php echo $data->descricao; ?></textarea>
        </div>

        <div class="form-group mt-3">
            <label>Status</label>
            <div>
                
                <div class="form-check form-check-inline p-0">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="s" checked="true"> Ativo
                    </label>
                </div>
                
                <div class="form-check form-check-inline p-0">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="n" <?php echo ($data->ativo == 'n') ? 'checked' : ''?>> Inativo
                    </label>
                </div>
            
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
        

    </form>

</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>

