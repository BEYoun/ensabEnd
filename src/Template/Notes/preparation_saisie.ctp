<style>
    body {
        background-color: #FAFAFA;
        margin: 0;
    }

    .choice {
        width: 70%;
        height: auto;
        margin: 40px auto;
        padding: 20px;
        background-color: #DFDFDF;
        border: 2px solid #7401DF;
    }

</style>
<section class="content">
<br>
<h1>Gestion des notes</h1>
<hr>
<h4>Saisie des notes</h4>
<hr>
<h6>Choix des paramètres</h6>
<hr>

<div id="div_filiere" class="choice" style="display: block">
    <?= $this->Form->create(null, ['url' => ['action' => 'preparationSaisie']]); ?>
    <h5>Filière</h5>
    <div style="width: 79%; float: left ;"> <?= $this->Form->select('filiere', $filieres_labels); ?> </div>
    <button type="submit" id="suivant_f" style="width: 20%; float: right ;background-color: black;color:white;" class="btn btn-dark">Suivant</button>
    <?= $this->Form->end(); ?>
</div>

<div id="div_niveau" class="choice" style="display: none">
    <?= $this->Form->create(null, ['url' => ['action' => 'preparationSaisie']]); ?>
    <h5>Niveau</h5>
    <div style="width: 79%; float: left ;"> <?= $this->Form->select('niveau', $niveaux_labels); ?> </div>
    <input type="hidden" name="f" value="<?= $f ?>">
    <button type="submit" id="suivant_n" style="width: 20%; float: right ;background-color: black;color:white;" class="btn btn-dark">Suivant</button>
    <?= $this->Form->end(); ?>
</div>

<div id="div_semestre" class="choice" style="display: none">
    <?= $this->Form->create(null, ['url' => ['action' => 'preparationSaisie']]); ?>
    <h5>Semestre</h5>
    <div style="width: 79%; float: left ;"> <?= $this->Form->select('semestre', $semestres_labels); ?> </div>
    <input type="hidden" name="f" value="<?= $f ?>">
    <input type="hidden" name="n" value="<?= $n ?>">
    <button type="submit" id="suivant_s" style="width: 20%; float: right ;background-color: black;color:white;" class="btn btn-dark">Suivant</button>
    <?= $this->Form->end(); ?>
</div>
<div id="div_module" class="choice" style="display: none">
    <?= $this->Form->create(null, ['url' => ['action' => 'preparationSaisie']]); ?>
    <h5>Module</h5>
    <div style="width: 79%; float: left ;"> <?= $this->Form->select('module', $modules_labels); ?> </div>
    <input type="hidden" name="f" value="<?= $f ?>">
    <input type="hidden" name="n" value="<?= $n ?>">
    <input type="hidden" name="s" value="<?= $s ?>">
    <button type="submit" id="suivant_m" style="width: 20%; float: right ;background-color: black;color:white;" class="btn btn-dark">Suivant</button>
    <?= $this->Form->end(); ?>
</div>
<div id="div_element" class="choice" style="display: none">
    <?= $this->Form->create(null, ['url' => ['action' => 'preparationSaisie']]); ?>
    <h5>Elément de module</h5>
    <div style="width: 79%; float: left ;"> <?= $this->Form->select('element', $elements_labels); ?> </div>
    <input type="hidden" name="f" value="<?= $f ?>">
    <input type="hidden" name="n" value="<?= $n ?>">
    <input type="hidden" name="s" value="<?= $s ?>">
    <input type="hidden" name="m" value="<?= $m ?>">
    <button type="submit" id="suivant_e" style="width: 20%; float: right ;background-color: black;color:white;" class="btn btn-dark">Suivant</button>
    <?= $this->Form->end(); ?>
</div>
<div id="div_submit" style="text-align: center;display: none">
    <table>
        <thead>
            <td>Filière</td>
            <td>Niveau</td>
            <td>Semestre</td>
            <td>Module</td>
            <td>Element</td>
        </thead>
        <tbody>
            <tr>
                <td><?= $f_l ?></td>
                <td><?= $n_l ?></td>
                <td><?= $s_l ?></td>
                <td><?= $m_l ?></td>
                <td><?= $e_l ?></td>
            </tr>
        </tbody>
    </table>
    <?= $this->Form->create(null, ['url' => ['action' => 'saisie']]) ?>
    <input type="hidden" name="f" value="<?= $f ?>">
    <input type="hidden" name="n" value="<?= $n ?>">
    <input type="hidden" name="s" value="<?= $s ?>">
    <input type="hidden" name="m" value="<?= $m ?>">
    <input type="hidden" name="e" value="<?= $e ?>">
    <?= $this->Form->submit('Saisir', ['class' => 'btn btn-success']); ?>
</div>
<?= $this->Form->end(); ?>
</section>

<script>
    var etape = <?php echo $etape ?> ;
    console.log(etape);
    switch (etape) {
        case 1:
            document.getElementById('div_niveau').style.display = 'block';
            document.getElementById('suivant_f').innerHTML = 'Modifier';
            break;
        case 2:
            document.getElementById('div_niveau').style.display = 'block';
            document.getElementById('div_semestre').style.display = 'block';
            document.getElementById('suivant_f').innerHTML = 'Modifier';
            document.getElementById('suivant_n').innerHTML = 'Modifier';
            break;
        case 3:
            document.getElementById('div_niveau').style.display = 'block';
            document.getElementById('div_semestre').style.display = 'block';
            document.getElementById('div_module').style.display = 'block';
            document.getElementById('suivant_f').innerHTML = 'Modifier';
            document.getElementById('suivant_n').innerHTML = 'Modifier';
            document.getElementById('suivant_s').innerHTML = 'Modifier';

            break;
        case 4:
            document.getElementById('div_element').style.display = 'block';
            document.getElementById('div_niveau').style.display = 'block';
            document.getElementById('div_semestre').style.display = 'block';
            document.getElementById('div_module').style.display = 'block';
            document.getElementById('suivant_f').innerHTML = 'Modifier';
            document.getElementById('suivant_n').innerHTML = 'Modifier';
            document.getElementById('suivant_s').innerHTML = 'Modifier';
            document.getElementById('suivant_m').innerHTML = 'Modifier';
            break;
        case 5:
            document.getElementById('div_submit').style.display = 'block';
            document.getElementById('div_filiere').style.display = 'none';

            break;
        default:
            break;
    }

</script>
<!-- /.content -->
<div class="modal modal-info fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Info Modal</h4>
            </div>
            <div class="modal-body">
                <div>
                    <video width="570" height="450" controls="controls" poster="image" preload="true">

                        <source src="/ensab/video/administrateur/saisieNote.webm" type="video/webm">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
