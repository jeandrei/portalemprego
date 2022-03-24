<?php require APPROOT . '/views/inc/header.php'; ?>
<?php 
    $resultados = '';
    if(!empty($data['vagas'])){
        foreach($data['vagas'] as $vaga){
            $resultados .='<tr>
                                <td>'.$vaga->id.'</td>
                                <td>'.$vaga->titulo.'</td>
                                <td>'.$vaga->descricao.'</td>
                                <td>'.($vaga->ativo == 's' ? 'Ativo' : 'Inativo' ).'</td>
                                <td>'.date('d/m/Y à\s H:i:s', strtotime($vaga->data)).'</td>
                                <td>
                                    <a href="'.URLROOT.'/vagas/edit/'.$vaga->id.'">
                                    <buton type="button" class="btn btn-primary">Editar</button>
                                    </a>
                                    <a href="'.URLROOT.'/vagas/delete/'.$vaga->id.'">
                                    <buton type="button" class="btn btn-danger">Excluir</button>
                                    </a>
                                </td>';
        }     
       
    } else {
        $resultados = '<tr>
        <td colspan="6" class="text-center">
            Nenhuma vaga encontrada
        </td>';  
    }   

?>
<div class="mt-3">
    <?php flash('vagas');?>
</div>

<main>
    <section class="mt-3">
        <a href="<?php echo URLROOT ?>/vagas/new">
            <button class="btn btn-success">Nova vaga</button>
        </a>
    </section>

    <section>
        <table class="table bg-light mt-3">
            <thead>                              
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th scope="col">Descrição</th>
                <th scope="col">Status</th>
                <th scope="col">Data</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $resultados;?>           
            </tbody>
        </table>
    </section>

</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>

