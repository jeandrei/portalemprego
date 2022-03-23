<?php require APPROOT . '/views/inc/header.php'; ?>
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
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>                
            </tbody>
        </table>
    </section>

</main>
<?php require APPROOT . '/views/inc/footer.php'; ?>

