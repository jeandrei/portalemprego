<?php require APPROOT . '/views/inc/header.php';?>
<main>
  
    <h2 class="mt-2">Excluir vaga</h2>

    <form action="<?php echo URLROOT; ?>/vagas/delete/<?php echo $data['id'];;?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <p>Você deseja realmente excluir a vaga?<strong><?php echo $data->titulo; ?></strong></p>
        </div>

        <div class="form-group mt-3">
        
        <a href="<?php echo URLROOT ?>/vagas">
            <button type="button" class="btn btn-success">Cancelar</button>
        </a>
        
            <button type="submit" name="delete" id="delete" class="btn btn-danger">Excluir</button>
        </div>
        

    </form>

</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>

