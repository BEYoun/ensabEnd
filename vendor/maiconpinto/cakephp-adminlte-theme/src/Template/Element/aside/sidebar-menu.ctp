﻿<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'sidebar-menu.ctp';
$us= $this->request->session()->read('Auth.User');
//début Jellouli
$prof = $this->request->session()->read('prof_id');
//Fin Jellouli
//print_r($us);
//exit;
$data = file_get_contents('./Services.json');
$services = json_decode($data, true);
$biblio=$services[0]['bibliotheque'];
$bureau=$services[0]['bureau'];
$finance=$services[0]['finance'];
$personnel=$services[0]['personnel'];
$scolarite=$services[0]['scolarite'];
$stock=$services[0]['stock'];
$stage=$services[0]['stage'];
$ingenieur=$services[0]['ingenieur'];

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<ul class="sidebar-menu">


                                <!---       SCOLARITE       -->
<?php
if ($us['role']=='resposcolarite' && $scolarite=='on')
{
?>
  <li class="header">Espace Scolarité</li>
    <li class="treeview">
        <?php echo $this->Html->link('Acceuil', array('controller' => 'Resposcolarites','action' => 'index')); ?>">
    </li>

    <!-- BECHHAYDA -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Relever des notes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>

        <!-- changement ici -->
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/resposcolarites/liste-pv-notes'); ?>"><i class="fa fa-circle-o"></i>Liste de pv </a></li>
            <li><a href="<?php echo $this->Url->build('/resposcolarites/liste-classes'); ?>"><i class="fa fa-circle-o"></i>Télécharger</a></li>
        </ul>
        <!-- End -->

    </li>
    <!-- Fin BENCHHAYDA -->

<!-- Abdesamad -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i> <span>Gestion de concours</span> <i class="fa fa-angle-right pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-files-o')).'Lancer/Fermer Concours', array('controller' => 'Resposcolarites','action' => 'listeConcours'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Liste des préinscris', array('controller' => 'Resposcolarites','action' => 'listePreinscris'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list')).'Liste des préselectionés', array('controller' => 'Resposcolarites','action' => 'listePreselectiones'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list-ol')).'Liste des admis', array('controller' => 'Resposcolarites','action' => 'listeAdmisGeneral'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list-ol')).'Listes d\'attente', array('controller' => 'Resposcolarites','action' => 'listesAttentes'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart')).'Statistiques', array('controller' => 'Resposcolarites','action' => 'StatistiquesPreinscriptions'), array('escape' => false)); ?></li>
        </ul>

    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>Gestion des Etudiants</span> <i class="fa fa-angle-right pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-user-plus')).'Ajouter un Etudiant', array('controller' => 'Resposcolarites','action' => 'addUser'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list')).'Liste des etudiants', array('controller' => 'Resposcolarites','action' => 'etudiantListe'), array('escape' => false)); ?></li>

        </ul>
    </li>


<!-- Fin Abdessamad -->

 <!-- Zouhir -->

    <li class="treeview">
        <a href="#">
            <i class="fa fa-fw fa-sitemap"></i>
            <span>Classes</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Modules',array('controller'=>'resposcolarites','action'=>'aitsaidAfficherClasse')); ?>"></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-fw fa-file"></i>
            <span>Notes</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Affichage des notes',array('controller'=>'notes','action'=>'preparationAffichage')); ?>"></li>
        </ul>
    </li>

 <!-- Fin Zouhir -->

 <!-- Hamdi -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-folder"></i> <span>Certificats des etudiants</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Tous',array('controller'=>'resposcolarites','action'=>'indexCertificatsEtudiants')); ?>"></li>
            <li><?php echo $this->Html->link('GI',array('controller'=>'resposcolarites','action'=>'indexCertificatsEtudiants/2')); ?>"></li>
            <li><?php echo $this->Html->link('GE',array('controller'=>'resposcolarites','action'=>'indexCertificatsEtudiants/3')); ?>"></li>
            <li><?php echo $this->Html->link('GRT',array('controller'=>'resposcolarites','action'=>'indexCertificatsEtudiants/1')); ?>"></li>
            <li><?php echo $this->Html->link('GPE',array('controller'=>'resposcolarites','action'=>'indexCertificatsEtudiants/4')); ?>"></li>
            <li><?php echo $this->Html->link('TC',array('controller'=>'resposcolarites','action'=>'indexCertificatsEtudiants/6')); ?>"></li>
            <li><?php echo $this->Html->link('CP',array('controller'=>'resposcolarites','action'=>'indexCertificatsEtudiants/5')); ?>"></li>

        </ul>
    </li>


    <!-- Fin Hamdi -->




<!--  mustapha FADILI   -->
    <!--  mustapha   -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-envelope-o"></i> <span>Messageries</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Boîte de réception', array('controller' => 'Resposcolarites','action' => 'boiteRecSco')); ?>"></li>
            <li><?php echo $this->Html->link('Envoyer nouveau message', array('controller' => 'Resposcolarites','action' => 'envoyerNvSco')); ?>"></li>
            <li><?php echo $this->Html->link('Lire mes messages', array('controller' => 'Resposcolarites','action' => 'lireMsgSco')); ?>"></li>
        </ul>
    </li>
<!-- Fin mustapha -->
    <!-- Fin mustapha -->

<!--DEBUT  Kawtar -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion d'abscences</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Demander une absence ',array('controller' => 'Resposcolarites','action' => 'demanderabsences')); ?>"></li>

        </ul>

    </li>

    <!--DEBUT  Bouhsise -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Resposcolarites','action' => 'demanderDocFct')); ?>"></li></li>
            <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Resposcolarites','action' => 'etatDemandeFct  ')); ?>"></li></li>
        </ul>
    </li>


    <?php
}
elseif($us['role']=='profvacataire' || $us['role']=='profpermanent')
{
?>

                            <!---       Proffesseur  :      -->

                             <li class="header">Espace Professeur</li>

   <!-- role prof vacataire et permanant -->


<!-- BECHHAYDA -->
    <li class="treeview">
    <a href="#">
            <i class="fa fa-dashboard"></i> <span>Notes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
        <li><?php echo $this->Html->link('Affichage des notes',array('controller'=>'notes','action'=>'preparationAffichage')); ?></li>
            <li><?php echo $this->Html->link('Saisie notes',array('controller'=>'notes','action'=>'preparationSaisie')); ?></li>
   </ul>
   </li>
        <?php
        if($us['role']=='profpermanent'){?>
<li><li><?php echo $this->Html->link('Déposer Demande Document ', array('controller' => 'Profpermanents','action' => 'demanderDoc')); ?>"></li></li>
    <li><li><?php echo $this->Html->link('Mes Documents ', array('controller' => 'profpermanents','action' => 'etatDemande  ')); ?>"></li></li>
    <li><li><?php echo $this->Html->link('Demande Validation Données', array('controller' => 'profpermanents','action' => 'viewmouna')); ?>"></li></li>

<li><li><?php echo $this->Html->link('Déposer Demande absence ', array('controller' => 'Profpermanents','action' => 'demanderabsencesb')); ?>"></li></li>
 <li><?php echo $this->Html->link('Mes absences ',array('controller' => 'profpermanents','action' => 'listerAbsences')); ?>"></li>



        <?php } if($us['role']=='profvacataire'): ?>
            <ul class="treeview-menu">

                <li><a href="<?php echo $this->Url->build('/profvacataires'); ?>"><i class="fa fa-circle-o"></i>tableau de bord</a></li>
                <li><a href="<?php echo $this->Url->build('/profvacataires/liste-classes'); ?>"><i class="fa fa-circle-o"></i>Inserer des notes</a></li>
            </ul>
        <?php else :?>
            <ul class="treeview-menu">
                <li><a href="<?php echo $this->Url->build('/profpermanents'); ?>"><i class="fa fa-circle-o"></i>tableau de bord</a></li>
                <li><a href="<?php echo $this->Url->build('/profpermanents/liste-classes'); ?>"><i class="fa fa-circle-o"></i> Inserer des notes</a></li>
            </ul>
        <?php endif ?>
    </li>
<!-- Fin BENCHHAYDA -->
   <!-- Bouhsise -->


    <!-- Fin bouhsise -->


<!-- BADR  -->
<?php
    if($biblio=='on'){
?>
   <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Bibliothéques</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <?php if ($us['role']=='profvacataire') { ?>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Liste Ouvrages',array('controller' =>'Profvacataires','action'=>'listbook')); ?></li>
            <li><?php echo $this->Html->link('Liste par Catégorie',array('controller' =>'Profvacataires','action'=>'listcategorie')); ?></li>
            <li><a href="<?php echo $this->Url->build('/profvacataires/proposerbook'); ?>">Proposer un ouvrage </a></li>
            <li><?php echo $this->Html->link('Ouvrages réservés',array('controller' =>'Profvacataires','action'=>'hamdihajarselectreservation')); ?></li>
            <li><?php echo $this->Html->link('Ouvrages empruntés',array('controller' =>'Profvacataires','action'=>'majdaselectempreinte')); ?></li>
            <li><?php echo $this->Html->link('Historique des emprunts',array('controller' =>'Profvacataires','action'=>'majdaselecteHistorique')); ?></li>
        </ul>
        <?php } else {?>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Liste Ouvrages',array('controller' =>'Profpermanents','action'=>'listbook')); ?></li>
            <li><?php echo $this->Html->link('Liste par Catégorie',array('controller' =>'Profpermanents','action'=>'listcategorie')); ?></li>
            <li><a href="<?php echo $this->Url->build('/profpermanents/proposerbook'); ?>">Proposer un ouvrage </a></li>
            <li><?php echo $this->Html->link('Ouvrages réservés',array('controller' =>'Profpermanents','action'=>'hamdihajarselectreservation')); ?></li>
            <li><?php echo $this->Html->link('Ouvrages empruntés',array('controller' =>'Profpermanents','action'=>'majdaselectempreinte')); ?></li>
            <li><?php echo $this->Html->link('Historique des emprunts',array('controller' =>'Profpermanents','action'=>'majdaselecteHistorique')); ?></li>
        </ul>
    <!--  jellouli -->


    <!-- fin jellouli -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Messageries</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Boîte de réception', array('controller' => 'Profpermanents','action' => 'boiteRecPer')); ?>"></li>
            <li><?php echo $this->Html->link('Envoyer nouveau message', array('controller' => 'Profpermanents','action' => 'envoyerNvPer')); ?>"></li>
            <li><?php echo $this->Html->link('Lire mes messages', array('controller' => 'Profpermanents','action' => 'lireMsgPer')); ?>"></li>
        </ul>
    </li>





        <?php }?>
    </li>
<?php
    }
?>

<!-- Fin BADR -->

<!-- Bouhsie -->




    <?php if($us['role']=='profvacataire'){?>
    <!--OMAR RAY-->

    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Espace Vacataires</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Saisir les heures',array('controller' => 'profvacataires','action' => 'saisienbheures')); ?>"></li>

            <li><?php echo $this->Html->link('Mes Vacations',array('controller' => 'profvacataires','action' => 'vacations')); ?>"></li>



        </ul>
    </li>

    <!--OMAR RAY-->
<!-- Fin Bouhsise -->


    <?php if($us['role']=='profvacataire'){?>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Messageries</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Boîte de réception', array('controller' => 'Profvacataires','action' => 'boiteRecVac')); ?>"></li>
            <li><?php echo $this->Html->link('Envoyer nouveau message', array('controller' => 'Profvacataires','action' => 'envoyerNvVac')); ?>"></li>
            <li><?php echo $this->Html->link('Lire mes messages', array('controller' => 'Profvacataires','action' => 'lireMsgVac')); ?>"></li>
        </ul>
    </li>
<li class="treeview">
        <a href="#">
             <i class="fa fa-dashboard"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Profvacataires','action' => 'demanderDocFct')); ?>"></li>

            <li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Profvacataires','action' => 'etatDemandeFct  ')); ?>"></li>


    <li><li><?php echo $this->Html->link('Demande Validation Données', array('controller' => 'profvacataires','action' => 'viewmouna')); ?>"></li></li>
        </ul>
    </li>

<li class="treeview">
        <a href="#">
             <i class="fa fa-dashboard"></i> <span>Absence</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><?php echo $this->Html->link('demander absence ', array('controller' => 'Profvacataires','action' => 'demanderabsencesb')); ?>"></li>

            <li><?php echo $this->Html->link('Mes absences ', array('controller' => 'Profvacataires','action' => 'listerAbsences  ')); ?>"></li>


        </ul>
    </li>



<?php }
?>

    <!-- prof permanent mustapha   -->

    <!-- Fin mustapha FADILI -->
<?php
    }}
elseif($us['role']=='etudiant')
{
?>

               <!---      Etudiant  :      -->

                             <li class="header">Espace Etudiant</li>

   <!-- role Etudiant -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>Profil</span> <i class="fa fa-angle-right pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-user-plus')).'Informations', array('controller' => 'etudiants','action' => 'index'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list')).'Edition du profil', array('controller' => 'etudiants','action' => 'editPass'), array('escape' => false)); ?></li>

        </ul>
    </li>
<!-- Zouhir -->

    <li class="treeview">
        <a href="#">
            <i class="fa fa-fw fa-sitemap"></i>
            <span>Mes Notes</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
        <li><?php echo $this->Html->link('Affichage notes',array('controller'=>'notes','action'=>'affichageEtudiant')); ?>"></li>

        </ul>
    </li>

<!-- fin zouhir -->
<!-- LAHLAOUTI -->


    <li class="treeview">
    <li><?php echo $this->Html->link('Profil', array('controller' => 'Etudiants','action' => 'lahlaoutiprofil')); ?>"></li>
    </li>

    <li class="treeview">
    <li><a href="<?= $this->Url->build(array('controller' => 'Etudiants','action' => 'lahlaoutimesprofesseurs')) ?>"> <i class="fa fa-fw fa-users"></i>
             <span> Mes professeurs</span></a> </li>
    </li>
    <li class="treeview">
    <li><a href="<?= $this->Url->build(array('controller' => 'Etudiants','action' => 'lahlaoutimesmodules')) ?>"> <i class="fa fa-fw fa-book"></i>
             <span> Mes modules</span></a> </li>
    </li>




    <!-- FIN LAHLAOUTI -->





    <li class="treeview">
    <li><?php echo $this->Html->link('Emploi', array('controller' => 'Etudiants','action' => 'lahlaoutiemploi')); ?>"></li>
    </li>
    <!-- FIN LAHLAOUTI -->

<!-- BADR -->
<?php
    if($biblio=='on'){
?>
     <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Bibliothéques</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Liste Ouvrages',array('controller' =>'Etudiants','action'=>'listbook')); ?></li>
            <li><?php echo $this->Html->link('Liste par Catégorie',array('controller' =>'Etudiants','action'=>'listcategorie')); ?></li>
            <li><a href="<?php echo $this->Url->build('/etudiants/proposerbook'); ?>">Proposer un ouvrage</a></li>
            <li><?php echo $this->Html->link('Ouvrage résérvé',array('controller' =>'Etudiants','action'=>'hamdihajarselectreservation')); ?></li>
            <li><?php echo $this->Html->link('ouvrage empruntés',array('controller' =>'Etudiants','action'=>'majdaselectempreinte')); ?></li>
            <li><?php echo $this->Html->link('historiques emprunts',array('controller' =>'Etudiants','action'=>'majdaselecteHistorique')); ?></li>
        </ul>
    </li>
<?php
    }
?>
    <!-- FIN BADR -->


<!-- HAMDI -->
    <li class="treeview">
        <a href="<?php echo $this->Url->build(['action'=>'indexCertificats']); ?>"><i class="fa fa-edit"></i> Demander Certificats</a>

    </li>



    <!-- Fin HAMDI -->

<!-- FADILI mustapha   -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-envelope-o"></i> <span>Messageries</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Boîte de réception', array('controller' => 'Etudiants','action' => 'boiteRecEtud')); ?>"></li>
            <li><?php echo $this->Html->link('Envoyer nouveau message', array('controller' => 'Etudiants','action' => 'envoyerNvEtud')); ?>"></li>
            <li><?php echo $this->Html->link('Lire mes messages', array('controller' => 'Etudiants','action' => 'lireMsgEtud')); ?>"></li>
        </ul>
    </li>
<!-- Fin FADILI mustapha -->

 <!---      Finance  :      -->

 <?php
}
elseif($us['role']=='respofinance' && $finance=='on')
{
?>

                             <li class="header">Espace Finance</li>

   <!-- role Finance -->
<!-- Yassir -->

    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Commandes événementielles</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/respofinances/addyassir/'); ?>"><i class="fa fa-circle-o"></i>Nouvelle commande</a></li>
            <li><a href="<?php echo $this->Url->build('/respofinances/suivicommande/'); ?>"><i class="fa fa-circle-o"></i>Suivi des commandes</a></li>

        </ul>
    </li>
           <!-- Fin yassir -->
<!-- DEBUT samsam -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Vacations</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/respofinances/Mesvacations/'); ?>"><i class="fa fa-circle-o"></i>Liste Des vacations</a></li>
            <li><a href="<?php echo $this->Url->build('/respofinances/addVac/'); ?>"><i class="fa fa-circle-o"></i>ajouter Vacation</a></li>
            <li><a href="<?php echo $this->Url->build('/respofinances/indexPaimentVac'); ?>"><i class="fa fa-circle-o"></i>paiements</a></li>
            <li><a href="<?php echo $this->Url->build('/respofinances/indexPrelevements'); ?>"><i class="fa fa-circle-o"></i>Prélèvements</a></li>

        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Heures Supplémentaires</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/respofinances/Mesheures/'); ?>"><i class="fa fa-circle-o"></i>Liste Des heures supp</a></li>
            <li><a href="<?php echo $this->Url->build('/respofinances/addSup/'); ?>"><i class="fa fa-circle-o"></i>ajouter heures supp</a></li>
            <li><a href="<?php echo $this->Url->build('/respofinances/indexPaimentsup'); ?>"><i class="fa fa-circle-o"></i>paiements</a></li>
            <li><a href="<?php echo $this->Url->build('/respofinances/indexPrelevementsup'); ?>"><i class="fa fa-circle-o"></i>Prélèvements</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Mission</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Professeur permanent</a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/respofinances/afficherMissionProf'); ?>"><i class="fa fa-circle-o"></i> Afficher les missions</a></li>
                    <li><a href="<?php echo $this->Url->build('/respofinances/AjouterMissionProf'); ?>"><i class="fa fa-circle-o"></i> Ajouter une Mission</a></li>
                </ul>
            </li>
            <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Fonctionnaire </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/respofinances/afficherMissionFonc'); ?>"><i class="fa fa-circle-o"></i> Afficher les missions</a></li>
                    <li><a href="<?php echo $this->Url->build('/respofinances/AjouterMissionFonc'); ?>"><i class="fa fa-circle-o"></i> Ajouter une Mission</a></li>
                </ul>
            </li>
        </ul>
    </li>

    <!--- fin samsam -->

            <!-- debut bouhsise -->

    <!-- Bouhsise -->

    <!--DEBUT  Bouhsise -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Respofinances','action' => 'demanderDocFct')); ?>"></li></li>
            <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Respofinances','action' => 'etatDemandeFct  ')); ?>"></li></li>
        </ul>
    </li>
    <!-- Fin Bouhsise -->
<!-- Fin Bouhsise -->

<!-- mustapha  FADILI-->



    <!-- Fin mustapha FADILI -->
<?php
}
elseif($us['role']=='respostock' && $stock=='on')
{
?>

<!---      Stock  :      -->

                            <li class="header">Espace Stock</li>

  <!-- role Stock -->

<!--DEBUT  zahri -->
   <li class="treeview">
       <a href="#">
           <i class="fa fa-archive" aria-hidden="true"></i><span>Gestion des Articles</span> <i class="fa fa-angle-left pull-right"></i>
       </a>
       <ul class="treeview-menu">
       <li><?php echo $this->Html->link('Afficher Articles', array('controller' => 'Respostocks','action' => 'index_articles')); ?></li>
   <li><?php echo $this->Html->link('Ajouter Articles', array('controller' => 'Respostocks','action' => 'add_articles')); ?></li>
       </ul>
   </li>
   <li class="treeview">
       <a href="#">
           <i class="fa fa-cart-plus" aria-hidden="true"></i><span>Gestion des Commandes</span> <i class="fa fa-angle-left pull-right"></i>
       </a>
       <ul class="treeview-menu">
       <li><?php echo $this->Html->link('Afficher Commandes', array('controller' => 'Respostocks','action' => 'index_commandes')); ?></li>
   <li><?php echo $this->Html->link('Ajouter Commandes', array('controller' => 'Respostocks','action' => 'add_commandes')); ?></li>
       <li><?php echo $this->Html->link('envoyer Commande', array('controller' => 'Respostocks','action' => 'envoieCom')); ?></li>
   </ul>
   </li>
 <li class="treeview">
       <a href="#">
           <i class="fa fa-truck" aria-hidden="true"></i><span>Gestion des Fournisseurs</span> <i class="fa fa-angle-left pull-right"></i>
       </a>
       <ul class="treeview-menu">
       <li><?php echo $this->Html->link('Afficher Fournisseurs', array('controller' => 'Respostocks','action' => 'index_fournisseurs')); ?></li>
   <li><?php echo $this->Html->link('Ajouter Fournisseurs', array('controller' => 'Respostocks','action' => 'add_fournisseurs')); ?></li>
       </ul>
   </li>
 <li class="treeview">
       <a href="#">
           <i class="fa fa-dashboard"></i><span>Gestion des Magasins</span> <i class="fa fa-angle-left pull-right"></i>
       </a>
       <ul class="treeview-menu">
       <li><?php echo $this->Html->link('Afficher Magasins', array('controller' => 'Respostocks','action' => 'index_magasins')); ?></li>
   <li><?php echo $this->Html->link('Ajouter Magasins', array('controller' => 'Respostocks','action' => 'add_magasins')); ?></li>
       </ul>
   </li>
 <li class="treeview">
       <a href="#">
           <i class="fa fa-table"></i><span>Gestion des Mouvements</span> <i class="fa fa-angle-left pull-right"></i>
       </a>
       <ul class="treeview-menu">
       <li><?php echo $this->Html->link('Afficher Mouvements', array('controller' => 'Respostocks','action' => 'index_mouvements')); ?></li>
   <li><?php echo $this->Html->link('Ajouter Mouvements', array('controller' => 'Respostocks','action' => 'add_mouvements')); ?></li>
       </ul>
   </li>
 <li class="treeview">
     <a href="#">
            <i class="fa fa-clone" aria-hidden="true"></i><span>Gestion des Categories</span> <i class="fa fa-angle-left pull-right"></i>
       </a>
       <ul class="treeview-menu">
       <li><?php echo $this->Html->link('Afficher Categories', array('controller' => 'Respostocks','action' => 'index_stockcategories')); ?></li>
   <li><?php echo $this->Html->link('Ajouter Categories', array('controller' => 'Respostocks','action' => 'add_stockcategories')); ?></li>
       </ul>
   </li>

<li class="treeview">
       <a href="#">
           <i class="fa fa-table"></i> <span></span> statistique <i class="fa fa-angle-left pull-right"></i>
       </a>
       <ul class="treeview-menu">

           <li><li><?php echo $this->Html->link('graphe ', array('controller' => 'Respostocks','action' => 'articlechaqueannee')); ?>"></li></li>
       </ul>
<!--fin zahri -->

<?php
}
elseif($us['role']=='respobiblio' && $biblio=='on')
{
?>
<!---      Bibliothèques  :      -->

                             <li class="header">Espace Bibliothèques</li>

   <!-- role Bibliothèques -->

<!--DEBUT  BADR -->
   <li class="treeview">
        <a href="<?php echo $this->Url->build('/Respobiblios/index'); ?>"><i class="glyphicon glyphicon-home"></i> Accueil</a>
    </li>
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/Respobiblios/badrStatistique'); ?>"><i class="glyphicon glyphicon-stats"></i> Statistiques</a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="glyphicon glyphicon-th-list"></i><span>Consulter ouvrages</span> <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <ul class="treeview-menu">
        <li><?php echo $this->Html->link('Tous les ouvrages',array('controller' =>'Respobiblios','action'=>'badrconsulterOuvrages')); ?></li>
        <li><?php echo $this->Html->link('Consultation par catégorie',array('controller' =>'Respobiblios','action'=>'badrconsulterOuvragessimple')); ?></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/Respobiblios/majdaajouteremprunte'); ?>"><i class="glyphicon glyphicon-plus-sign"></i> Ajouter un emprunt</a>
    </li>
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/Respobiblios/majdaannuleremprunte'); ?>"><i class="glyphicon glyphicon-minus-sign"></i> annuler un emprunt</a>
    </li>
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/Respobiblios/badrajouterOuvrages'); ?>"><i class="glyphicon glyphicon-book"></i> Ajouter ouvrages</a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="glyphicon glyphicon-list-alt"></i><span>Ouvrages réservés</span> <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <ul class="treeview-menu">
        <li><?php echo $this->Html->link('Par Professeurs vacataires',array('controller' =>'Respobiblios','action'=>'hajarreservationProfVacataire')); ?></li>
        <li><?php echo $this->Html->link('Par Professeurs permanents',array('controller' =>'Respobiblios','action'=>'hajarreservationProfPermanent')); ?></li>
        <li><?php echo $this->Html->link('Par Etudiants',array('controller' =>'Respobiblios','action'=>'hajarreservationEtudiant')); ?></li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="glyphicon glyphicon-list-alt"></i><span>Ouvrages empruntés</span> <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <ul class="treeview-menu">
        <li><?php echo $this->Html->link('Par Professeurs vacataires',array('controller' =>'Respobiblios','action'=>'majdaemprunteProfVacataire')); ?></li>
        <li><?php echo $this->Html->link('Par Professeurs permanents',array('controller' =>'Respobiblios','action'=>'majdaemprunteProfPermanent')); ?></li>
        <li><?php echo $this->Html->link('Par Etudiants',array('controller' =>'Respobiblios','action'=>'majdaemprunteEtudiant')); ?></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/Respobiblios/badrparametres'); ?>"><i class="glyphicon glyphicon-edit"></i> Paramétres</a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="glyphicon glyphicon-hdd"></i><span>Historiques</span> <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <ul class="treeview-menu">
        <li><?php echo $this->Html->link('Historique pour chaque ouvrages',array('controller' =>'Respobiblios','action'=>'badrhistorique')); ?></li>
        <li><?php echo $this->Html->link('Historique par Catégorie',array('controller' =>'Respobiblios','action'=>'badrhistoriqueCategorie')); ?></li>
        <li><?php echo $this->Html->link('Historique de chaques utilisateurs',array('controller' =>'Respobiblios','action'=>'badrehistoriqueutilisateur')); ?></li>
        </ul>
    </li>

    <!--- fin badr -->
    <!--DEBUT  kawtar-->
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/Respobiblios/demanderabsences'); ?>"><i class="glyphicon glyphicon-envelope"></i> Demander une absence</a>
         <li><?php echo $this->Html->link('mes absences ',array('controller' => 'Respobiblios','action' => 'listerabsences')); ?>"></li>
    </li>
    <!--Fin kawtar-->
    <!-- Bouhsise -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Gestion des demandes</span><i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Respobiblios','action' => 'demanderDocFct')); ?></li></li>
            <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Respobiblios','action' => 'etatDemandeFct  ')); ?></li></li>
        </ul>
    </li>
    <!-- Fin Bouhsise -->
<?php
}
elseif($us['role']=='respobureauordre' && $bureau=='on')
{
?>
<!---     Bureau d'ordre  :      -->

                             <li class="header">Espace Bureau d'ordre  :</li>

   <!-- role Bureau d'ordre  : -->


<!--DEBUT  Ibtihal -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-fw fa-envelope"></i> <span>Courriers Reçus</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">



            <li><?php echo $this->Html->link('Liste Courriers Reçus',array('controller'=>'Respobureauordres','action'=>'indexArrivee')); ?>"></li>
            <li><?php echo $this->Html->link('Recherche courriers Reçus',array('controller'=>'Respobureauordres','action'=>'trierArrivee')); ?>"></li>
            <li><?php echo $this->Html->link('Ajouter courriers Reçus',array('controller'=>'Respobureauordres','action'=>'addArrivee')); ?>"></li>
            <li><?php echo $this->Html->link('Expediteurs',array('controller'=>'Respobureauordres','action'=>'indexexpediteur')); ?>"></li>
        </ul></li>
        <li>
        <a href="#">
            <i class="fa fa-fw fa-envelope-o"></i> <span>Courriers Departs</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><?php echo $this->Html->link('Liste Courriers Envoyés',array('controller'=>'Respobureauordres','action'=>'indexDepart1')); ?>"></li>
            <li><?php echo $this->Html->link('Recherche courriers Envoyés',array('controller'=>'Respobureauordres','action'=>'trierDepart')); ?>"></li>
            <li><?php echo $this->Html->link('Ajouter courriers Envoyés',array('controller'=>'Respobureauordres','action'=>'addDepart1')); ?>"></li>

            <li><?php echo $this->Html->link('Destinataires',array('controller'=>'Respobureauordres','action'=>'indexDest')); ?>"></li>

        </ul></li>
        <li>
        <a href="#">
            <i class="fa fa-fw fa-reply-all"></i> <span>Envoyer Courrier</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">


            <li><?php echo $this->Html->link('Envoyer courrier par email',array('controller'=>'Respobureauordres','action'=>'envoyer')); ?>"></li>
        </ul>
    </li>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion d'abscences</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Demander une absence ',array('controller' => 'Respobureauordres','action' => 'demanderabsences')); ?>"></li>

        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Respobureauordres','action' => 'demanderDocFct')); ?>"></li></li>
            <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Respobureauordres','action' => 'etatDemandeFct  ')); ?>"></li></li>
        </ul>
    </li>
<!--FIN  Ibtihal -->
<!-- Bouhsise -->
<?php
}
elseif($us['role']=='respostage' && $stage=='on' )
{
?>


    <li class="header">Espacee stage  :</li>

    <!-- role respostage  : -->

    <!-- Hamdi -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Stages</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>






    <ul class="treeview-menu">
        <li><?php echo $this->Html->link('Gestion des certificats',array('controller'=>'respostages','action'=>'indexCertificats')); ?>"></li>
        <li><?php echo $this->Html->link('Ajouter certificat',array('controller'=>'respostages','action'=>'addCertificats')); ?>"></li>
        <li class="treeview">


        <li class="treeview">
            <a href="#">
                <i class="fa fa-folder"></i> <span>Certificats des etudiants</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><?php echo $this->Html->link('Tous',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants')); ?>"></li>
                <li><?php echo $this->Html->link('GI',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/2')); ?>"></li>
                <li><?php echo $this->Html->link('GE',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/3')); ?>"></li>
                <li><?php echo $this->Html->link('GRT',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/1')); ?>"></li>
                <li><?php echo $this->Html->link('GPE',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/4')); ?>"></li>
                <li><?php echo $this->Html->link('TC',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/6')); ?>"></li>
                <li><?php echo $this->Html->link('CP',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/5')); ?>"></li>

            </ul>
        </li>

    </ul>

    </li>



    <!-- Fin hamdi -->
    <!--DEBUT  Bouhsise -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion d'abscences</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Demander une absence ',array('controller' => 'Respostages','action' => 'demanderabsences')); ?>"></li>

        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Respostages','action' => 'demanderDocFct')); ?>"></li></li>
            <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Respostages','action' => 'etatDemandeFct  ')); ?>"></li></li>
        </ul>
    </li>
    <!-- Bouhsise -->


    <?php
}
elseif($us['role']=='ingenieur'  && $ingenieur=='on')
{
?>
    <!---     ingenieur:      -->

    <li class="header">Espacee ingenieur  :</li>

    <!-- role ingenieur  : -->

     <!-- Bhihi -->
    <li class="treeview">
        <?php echo $this->Html->link('Home', array('controller' => 'ingenieurs','action' => 'index')); ?>
        <a href="#">
            <i class="fa fa-table"></i> <span style="color:#FFFFFF">actualite</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><?php echo $this->Html->link('Ajouter actualité', array('controller' => 'ingenieurs','action' => 'ajouterActualites')); ?></li>
            <li><?php echo $this->Html->link('La listes des actualités', array('controller' => 'ingenieurs','action' => 'afficherActualites')); ?></li>



        </ul>
    </li>
    <li class="treeview">

        <a href="#">
            <i class="fa fa-table"></i> <span style="color:#FFFFFF">Evénement</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><?php echo $this->Html->link('Ajouter événement', array('controller' => 'ingenieurs','action' => 'ajouterEvenements')); ?></li>
            <li><?php echo $this->Html->link('La listes des événements', array('controller' => 'ingenieurs','action' => 'afficherEvenements')); ?></li>



        </ul>
    </li>
    <li class="treeview">

        <a href="#">
            <i class="fa fa-table"></i> <span style="color:#FFFFFF">Statistiques</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><?php echo $this->Html->link('Ajouter Statistique', array('controller' => 'ingenieurs','action' => 'ajouterLaureats')); ?></li>
            <li><?php echo $this->Html->link('La listes des laureats', array('controller' => 'ingenieurs','action' => 'afficherLaureats')); ?></li>



        </ul>
    </li>
        <!--VERSION 2 -->

    <li class="treeview">

        <a href="#">
            <i class="fa fa-table"></i> <span style="color:#FFFFFF">Galerie</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-table"></i> <span style="color:#FFFFFF">Photo</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li><?php echo $this->Html->link('ajouter photo', array('controller' => 'ingenieurs','action' => 'ajouterImages')); ?></li>
                    <li><?php echo $this->Html->link('Liste des photo', array('controller' => 'ingenieurs','action' => 'afficherImages')); ?></li>

                </ul>
            </li>
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-table"></i> <span style="color:#FFFFFF">Vidéo</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li><?php echo $this->Html->link('ajouter video', array('controller' => 'ingenieurs','action' => 'ajouterVideos')); ?></li>
                    <li><?php echo $this->Html->link('Liste des video', array('controller' => 'ingenieurs','action' => 'afficherVideos')); ?></li>

                </ul>
            </li>
        </ul>
    </li>
    <li class="treeview">

        <a href="#">
            <i class="fa fa-table"></i> <span style="color:#FFFFFF">Parascolaire</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-table"></i> <span style="color:#FFFFFF">Club</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li><?php echo $this->Html->link('ajouter club', array('controller' => 'ingenieurs','action' => 'ajouterClubs')); ?></li>
                    <li><?php echo $this->Html->link('Liste des clubs', array('controller' => 'ingenieurs','action' => 'afficherClubs')); ?></li>

                </ul>
            </li>
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-table"></i> <span style="color:#FFFFFF">Actualité Club</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li><?php echo $this->Html->link('Ajouter Actualité', array('controller' => 'ingenieurs','action' => 'ajouterActualiteClubs')); ?></li>
                    <li><?php echo $this->Html->link('La listes des actualités', array('controller' => 'ingenieurs','action' => 'afficherActualiteClubs')); ?></li>
                </ul>
            </li>
        </ul>
    </li>
   <!--  <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion d'abscences</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Demander une absence ',array('controller' => 'Ingenieurs','action' => 'demanderabsences')); ?>"></li>

        </ul>

    </li> -->

    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion des demandes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li><li><?php echo $this->Html->link('Déposer une demande ', array('controller' => 'Ingenieurs','action' => 'demanderDocFct')); ?>"></li></li>
            <li><li><?php echo $this->Html->link('Liste des documents déposés ', array('controller' => 'Ingenieurs','action' => 'etatDemandeFct  ')); ?>"></li></li>
        </ul>
    </li>
    <li><li><?php echo $this->Html->link('Demande Validation Données', array('controller' => 'ingenieurs','action' => 'viewmouna')); ?>"></li></li>
    <!-- Fin Bhihi -->

<?php }

elseif ($us['role']=='respopersonel'  && $personnel=='on')
{
    ?>
    <li class="header">Espace Personnel</li>

    <!--YOUNESS BOUHSISE-->
     <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Espace Personnel </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <!--YOUNESS BOUHSISE-->

                        <!--YOUNESS BOUHSISE-->
                          <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list-ol')).'Acceuil ',array('controller' => 'Respopersonels','action' => 'index'), array('escape' => false)); ?>"></li>
                         <li class="treeview">
                                   <a href="#">
                                       <i class="fa fa-dashboard"></i> <span>Professeurs Permanents </span> <i class="fa fa-angle-left pull-right"></i>
                                   </a>
                                   <ul class="treeview-menu">
                                       <!-- SARIH debut-->
                                       <li class="treeview">
                                           <a href="#">
                                               <i class="glyphicon glyphicon-wrench"></i> <span>Gestion de compte</span> <i class="fa fa-angle-left pull-right"></i>
                                           </a>
                                           <ul class="treeview-menu">

                                               <li><?php echo $this->Html->link('Liste des Professeurs permanents',array('controller' => 'Respopersonels','action' => 'permanentsliste')); ?>"></li>
                                                <li><?php echo $this->Html->link('Créer un Compte ',array('controller' => 'Respopersonels','action' => 'addper')); ?>"></li>
                                           </ul>
                                       </li>
                                       <!-- SARIH fin-->
                                       <li>


                                           <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Départements ',array('controller' => 'Respopersonels','action' => 'listerProfsParDepar'), array('escape' => false)); ?>"></li>
                                           <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Liste des Profs avec Grades ',array('controller' => 'Respopersonels','action' => 'listerGrade'), array('escape' => false)); ?>"></li>
                                           <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Affecter un Grade ',array('controller' => 'Respopersonels','action' => 'affecterGradeProf'), array('escape' => false)); ?>"></li>
                                           <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list-ol')).'Activités ', array('controller' => 'Respopersonels','action' => 'afficherEvent'), array('escape' => false)); ?>"></li>
                                           <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file')).'Consultation Document ', array('controller' => 'Respopersonels','action' => 'voirDocument'), array('escape' => false)); ?>"></li>
                                           <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-search')).'Recherche des professeurs', array('controller' => 'Respopersonels','action' => 'rechercher'), array('escape' => false)); ?>"></li>
                                           <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list-ol')).'Disciplines', array('controller' => 'Respopersonels','action' => 'listerDisciplines'), array('escape' => false)); ?>"></li>
                                           <li><?php echo $this->Html->link('Demande Modification Données' ,array('controller' => 'Respopersonels','action' => 'voirDemandes')); ?></li>
             <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Gestion Abscences </span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><?php echo $this->Html->link('Traiter une absence  ',array('controller' => 'Respopersonels','action' => 'absencesprofperm')); ?>"></li>

                            <li><?php echo $this->Html->link('Lister toutes les absences ',array('controller' => 'Respopersonels','action' => 'listerAbsencesperm')); ?>"></li>

                            <li><?php echo $this->Html->link('Trier Les absences par date',array('controller' => 'Respopersonels','action' => 'listerAbspermParDate')); ?>"></li>


                        </ul></li>





                                       </li>
                                     </ul>
                               </li>
                               </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Professeurs Vacataires</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>


                        <ul class="treeview-menu">
                             <a href="#">
                                <i class="glyphicon glyphicon-wrench"></i> <span>Gestion de Compte</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">


                                <li><?php echo $this->Html->link('Créer un Compte',array('controller' => 'Respopersonels','action' => 'addvac')); ?>"></li>
                                <li><?php echo $this->Html->link('Liste Professeurs Vacataires',array('controller' => 'Respopersonels','action' => 'vacatairesliste')); ?>"></li>

                          </ul>

<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Liste des Vacataires avec Grades ',array('controller' => 'Respopersonels','action' => 'listerGradeVac'), array('escape' => false)); ?>"></li>
<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Affecter un Grade',array('controller' => 'respopersonels','action'=>'affectergradevac'), array('escape' => false)); ?>"></li>
<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-search')).'Rechercher des Vacataires',array('controller' => 'respopersonels','action'=>'rechercherVac'), array('escape' => false)); ?>"></li>
<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Demandes Modification Données',array('controller' => 'Respopersonels','action' => 'voirDemandesVac'), array('escape' => false)); ?>"></li>
<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Demandes Modification Vacations',array('controller' => 'Respopersonels','action' => 'voirDemandesHeuresVac'), array('escape' => false)); ?>"></li>
 <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file')).'Consultation Document ', array('controller' => 'Respopersonels','action' => 'voirrDocument'), array('escape' => false)); ?>"></li>
<li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Affecter à un Departement',array('controller' => 'respopersonels','action'=>'Affecteraundepart'), array('escape' => false)); ?>"></li>



 <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Gestion Abscences </span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><?php echo $this->Html->link('Traiter une absence  ',array('controller' => 'Respopersonels','action' => 'absencesprofvac')); ?>"></li>

                            <li><?php echo $this->Html->link('Lister toutes les absences ',array('controller' => 'Respopersonels','action' => 'listerAbsencesvac')); ?>"></li>

                            <li><?php echo $this->Html->link('Trier Les absences par date',array('controller' => 'Respopersonels','action' => 'listerAbsvacParDate')); ?>"></li>


                        </ul></li>


                            <!-- SARIH debut-->



                            </li>
                            <!--SARUH FIN -->
                            </li>

                        </ul>
                    </li>



                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Fonctionnaires</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
               <!-- SARIH debut-->
               <li class="treeview">
                   <a href="#">
                       <i class="glyphicon glyphicon-wrench"></i> <span>Gestion de Compte</span> <i class="fa fa-angle-left pull-right"></i>
                   </a>
                   <ul class="treeview-menu">
                       <li><?php echo $this->Html->link('Créer un Compte ',array('controller' => 'Respopersonels','action' => 'addfonc')); ?>"></li>
                       <li><?php echo $this->Html->link('Liste des fonctionnaires',array('controller' => 'Respopersonels','action' => 'fonctionnairesliste')); ?>"></li>
                   </ul>
               </li>
               <!-- SARIH fin-->
               <li>

                   <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list-ol')).'Evolution Grades des Fonctionnaires ', array('controller' => 'Respopersonels','action' => 'evolutionGrades'), array('escape' => false)); ?>"></li>
                   <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list-ol')).'Fonctionnaires par Service ',array('controller' => 'Respopersonels','action' => 'mouvementService'), array('escape' => false)); ?>"></li>
                   <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Activités des fonctionnaires ',array('controller' => 'Respopersonels','action' => 'listerActivites'), array('escape' => false)); ?>"></li>
                   <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Groupement des événements ',array('controller' => 'Respopersonels','action' => 'afficherFonctEvent'), array('escape' => false)); ?>"></li>
                   <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list-ol')).'Mouvement des fonctionnaires ', array('controller' => 'Respopersonels','action' => 'listerMouvement'), array('escape' => false)); ?>"></li>
                   <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-search')).'Rechercher des fonctionnaire ', array('controller' => 'Respopersonels','action' => 'rechercherFonc'), array('escape' => false)); ?>"></li>
                   <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-file')).'Consultation des Documents ', array('controller' => 'Respopersonels','action' => 'voirDocumentFct'), array('escape' => false)); ?>"></li>
                    <li><?php echo $this->Html->link('Demande Modification Données' ,array('controller' => 'Respopersonels','action' => 'voirDemandesFonc')); ?></li>

               </li>


           </ul>
                    </li>
                    </li>


                    <!-- A -->
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Gestion des abscences fonctionnaire</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><?php echo $this->Html->link('Traiter une absence  ',array('controller' => 'Respopersonels','action' => 'gestionabsences')); ?>"></li>

                            <li><?php echo $this->Html->link('Lister toutes les absences ',array('controller' => 'Respopersonels','action' => 'listerAbsences')); ?>"></li>

                            <li><?php echo $this->Html->link('Trier Les absences par date',array('controller' => 'Respopersonels','action' => 'listerAbsencesParDate')); ?>"></li>

                            <li><?php echo $this->Html->link('Rechercher une absence ',array('controller' => 'Respopersonels','action' => 'abs')); ?>"></li>
                        </ul></li>




                        </ul></li>


                    <!-- -->


<!-- ////////////////////////////////////// Statistiques des professeurs-->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Statistiques des professeurs</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Date de recrutement ',array('controller' => 'Respopersonels','action' => 'statistiqueprofdate')); ?>"></li>

            <li><?php echo $this->Html->link('Grade ',array('controller' => 'Respopersonels','action' => 'statistiqueprofgrade')); ?>"></li>

            <li><?php echo $this->Html->link('Département',array('controller' => 'Respopersonels','action' => 'statistiqueprofdept')); ?>"></li>

            <li><?php echo $this->Html->link('Discipline ',array('controller' => 'Respopersonels','action' => 'statistiqueprofdiscipline')); ?>"></li>

            <li><?php echo $this->Html->link('Genre ',array('controller' => 'Respopersonels','action' => 'statistiqueprofgenre')); ?>"></li>

            <li><?php echo $this->Html->link('Age ',array('controller' => 'Respopersonels','action' => 'statistiqueprofage')); ?>"></li>

            <li><?php echo $this->Html->link('Activités ',array('controller' => 'Respopersonels','action' => 'statistiqueprofactivite')); ?>"></li>
        </ul>
    </li>
<!-- ///////////////////////////////////// -->
<!-- ///////////////////////////////////// Statistiques des fonctionnaires -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Statistiques des fonctionnaires</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Date de recrutement ',array('controller' => 'Respopersonels','action' => 'statistiquefonctdate')); ?>"></li>

            <li><?php echo $this->Html->link('Grade ',array('controller' => 'Respopersonels','action' => 'statistiquefonctgrade')); ?>"></li>

            <li><?php echo $this->Html->link('Service ',array('controller' => 'Respopersonels','action' => 'statistiquefonctservice')); ?>"></li>

            <li><?php echo $this->Html->link('Genre ',array('controller' => 'Respopersonels','action' => 'statistiquefonctgenre')); ?>"></li>

            <li><?php echo $this->Html->link('Age ',array('controller' => 'Respopersonels','action' => 'statistiquefonctage')); ?>"></li>

            <li><?php echo $this->Html->link('Activités ',array('controller' => 'Respopersonels','action' => 'statistiquefonctactivite')); ?>"></li>
        </ul>
    </li>
<!-- ///////////////////////////////////// -->





            /****/

        </ul>
    </li>
<?php
}

elseif ($us['role']=='fonctionnaire')
{
    ?>

	<li class="header">Espace Fonctionnaire</li>

   <!-- role fonc -->


    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> Notes<span></span> <i class="fa fa-angle-left pull-right"></i>

        </a>

<li><li><?php echo $this->Html->link('Déposer Demande Document ', array('controller' => 'fonctionnaires','action' => 'demanderDoc')); ?>"></li></li>
    <li><li><?php echo $this->Html->link('Mes Documents ', array('controller' => 'fonctionnaires','action' => 'etatDemande  ')); ?>"></li></li>
    <li><li><?php echo $this->Html->link('Demande Validation Données', array('controller' => 'fonctionnaires','action' => 'viewmouna')); ?>"></li></li>


    </li>

    <li><a href="<?= $this->Url->build( array( 'controller' => 'fonctionnaires',
            'action'=>'viewmouna',
            $prof));
        ?>"><i class="fa fa-circle-o"></i> Validation données </a></li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Messageries</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Boîte de réception', array('controller' => 'fonctionnaires','action' => 'boiteRecPer')); ?>"></li>
            <li><?php echo $this->Html->link('Envoyer nouveau message', array('controller' => 'fonctionnaires','action' => 'envoyerNvPer')); ?>"></li>
            <li><?php echo $this->Html->link('Lire mes messages', array('controller' => 'fonctionnaires','action' => 'lireMsgPer')); ?>"></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion d'abscences</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Demander une absence ',array('controller' => 'Fonctionnaires','action' => 'demanderabsences')); ?>"></li>
            <li><?php echo $this->Html->link('Mes absences ',array('controller' => 'Fonctionnaires','action' => 'listerAbsences')); ?>"></li>

        </ul>
        <!--Fin Kawtar -->
    </li>

    </li>

    <?php
}

elseif ($us['role']=='admin')
{
    if ($scolarite=='on') {
    ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Espace scolarité</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
    <ul class="treeview-menu">

     <li><a href="<?php echo $this->Url->build('/resposcolarites/generationcode'); ?>"><i class="fa fa-circle-o"></i>Génération de code</a></li>
    <li><a href="<?php echo $this->Url->build('/admin/autoriser'); ?>"><i class="fa fa-circle-o"></i>Autorisation d'accès</a></li>
    <li><a href="<?php echo $this->Url->build('/resposcolarites/liste-pv-notes'); ?>"><i class="fa fa-circle-o"></i>Modification des notes</a></li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i> <span>Gestion de concours</span> <i class="fa fa-angle-right pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).'Liste des préinscris', array('controller' => 'Resposcolarites','action' => 'listePreinscris'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list')).'Liste des préselectionés', array('controller' => 'Resposcolarites','action' => 'listePreselectiones'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list-ol')).'Liste des admis', array('controller' => 'Resposcolarites','action' => 'listeAdmisGeneral'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list-ol')).'Listes d\'attente', array('controller' => 'Resposcolarites','action' => 'listesAttentes'), array('escape' => false)); ?></li>
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart')).'Statistiques', array('controller' => 'Resposcolarites','action' => 'StatistiquesPreinscriptions'), array('escape' => false)); ?></li>
        </ul>

    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>Gestion des Etudiants</span> <i class="fa fa-angle-right pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list')).'Liste des etudiants', array('controller' => 'Resposcolarites','action' => 'etudiantListe'), array('escape' => false)); ?></li>

        </ul>




    <!-- Fin Abdessamad -->

    <!-- Zouhir -->

    <li class="treeview">
        <a href="#">
            <i class="fa fa-fw fa-sitemap"></i>
            <span>Classes</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Modules',array('controller'=>'resposcolarites','action'=>'aitsaidAfficherClasse')); ?>"></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-fw fa-file"></i>
            <span>Notes</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Affichage notes',array('controller'=>'notes','action'=>'preparationAffichage')); ?>"></li>
            <li><?php echo $this->Html->link('Saisie notes',array('controller'=>'notes','action'=>'preparationSaisie')); ?>"></li>
        </ul>
    </li>

</li>
    <!-- Fin Zouhir -->
    </ul>
    </li>
    <?php
    }
    if ($finance=='on') {

    ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Espace Finance</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Commandes événementielles</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/respofinances/suivicommandes/'); ?>"><i class="fa fa-circle-o"></i>Suivi des commandes</a></li>

                </ul>
            </li>
            <!-- Fin yassir -->
            <!-- DEBUT samsam -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Vacations</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/respofinances/Mesvacations/'); ?>"><i class="fa fa-circle-o"></i>Liste Des vacations</a></li>
                    <li><a href="<?php echo $this->Url->build('/respofinances/indexPaimentVac'); ?>"><i class="fa fa-circle-o"></i>paiements</a></li>
                    <li><a href="<?php echo $this->Url->build('/respofinances/indexPrelevements'); ?>"><i class="fa fa-circle-o"></i>Prélèvements</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Heures Supplimentaires</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/respofinances/Mesheures/'); ?>"><i class="fa fa-circle-o"></i>Liste Des heures supp</a></li>
                    <li><a href="<?php echo $this->Url->build('/respofinances/indexPaimentsup'); ?>"><i class="fa fa-circle-o"></i>paiements</a></li>
                    <li><a href="<?php echo $this->Url->build('/respofinances/indexPrelevementsup'); ?>"><i class="fa fa-circle-o"></i>Prélèvements</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Mission</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Proffesseur permanent</a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo $this->Url->build('/respofinances/afficherMissionProf'); ?>"><i class="fa fa-circle-o"></i> Afficher les missions</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Fonctionnaire </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo $this->Url->build('/respofinances/afficherMissionFonc'); ?>"><i class="fa fa-circle-o"></i> Afficher les missions</a></li>
                        </ul>
                    </li>
                </ul>
            </li>




            <!--- fin samsam -->


        </ul>
    </li>



    <!-- role Finance -->
    <!-- Yassir -->

    <?php
        }
        if ($stock=='on') {
    ?>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Espace Stock</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

                       <!-- role Stock -->

            <!--DEBUT  JELAIDI -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive" aria-hidden="true"></i><span>Gestion des Articles</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Afficher Articles', array('controller' => 'Respostocks','action' => 'index_articles')); ?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i><span>Gestion des Commandes</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Afficher Commandes', array('controller' => 'Respostocks','action' => 'index_commandes')); ?></li>
               </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-truck" aria-hidden="true"></i><span>Gestion des Fournisseurs</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Afficher Fournisseurs', array('controller' => 'Respostocks','action' => 'index_fournisseurs')); ?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i><span>Gestion des Magasins</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Afficher Magasins', array('controller' => 'Respostocks','action' => 'index_magasins')); ?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i><span>Gestion des Mouvements</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Afficher Mouvements', array('controller' => 'Respostocks','action' => 'index_mouvements')); ?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clone" aria-hidden="true"></i><span>Gestion des Categories</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Afficher Categories', array('controller' => 'Respostocks','action' => 'index_stockcategories')); ?></li>
                </ul>
            </li>

            <!--FIN  JELAIDI -->

</ul>
    </li>
    <!-- ******************************* -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Gestion des certificats</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/Certificats'); ?>"><i class="fa fa-circle-o"></i>Certificats</a></li>
            <li><a href="<?php echo  $this->Url->build(array("controller" => "Resposcolarites","action" => "indexCertificatsEtudiants")); ?>"><i class="fa fa-circle-o"></i>Certificats_Etudiants</a></li>
        </ul>
    </li>
    <!-- ***************************************** -->
    <?php
    }
    if ($biblio=='on') {

    ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Espace Bibilothèque</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <!---      Bibliothèques  :      -->


            <!-- role Bibliothèques -->

            <!--DEBUT  BADR -->
            <li class="treeview">
                <a href="<?php echo $this->Url->build('/Respobiblios/index'); ?>"><i class="glyphicon glyphicon-home"></i> Accueil</a>
            </li>
            <li class="treeview">
                <a href="<?php echo $this->Url->build('/Respobiblios/badrStatistique'); ?>"><i class="glyphicon glyphicon-stats"></i> Statistiques</a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-th-list"></i><span>Consulter ouvrages</span> <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Tout les ouvrages',array('controller' =>'Respobiblios','action'=>'badrconsulterOuvrages')); ?></li>
                    <li><?php echo $this->Html->link('Ouvrages par catégorie',array('controller' =>'Respobiblios','action'=>'badrconsulterOuvragessimple')); ?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-list-alt"></i><span>Ouvrages résérvées</span> <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Tout les Ouvrages',array('controller' =>'Respobiblios','action'=>'hajarreservation')); ?></li>
                    <li><?php echo $this->Html->link('Professeurs vacataires',array('controller' =>'Respobiblios','action'=>'hajarreservationProfVacataire')); ?></li>
                    <li><?php echo $this->Html->link('Professeurs permanents',array('controller' =>'Respobiblios','action'=>'hajarreservationProfPermanent')); ?></li>
                    <li><?php echo $this->Html->link('Etudiants',array('controller' =>'Respobiblios','action'=>'hajarreservationEtudiant')); ?></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-list-alt"></i><span>Ouvrages empruntées</span> <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Tout les Ouvrages',array('controller' =>'Respobiblios','action'=>'majdaemprunte')); ?></li>
                    <li><?php echo $this->Html->link('Professeurs vacataires',array('controller' =>'Respobiblios','action'=>'majdaemprunteProfVacataire')); ?></li>
                    <li><?php echo $this->Html->link('Professeurs permanents',array('controller' =>'Respobiblios','action'=>'majdaemprunteProfPermanent')); ?></li>
                    <li><?php echo $this->Html->link('Etudiants',array('controller' =>'Respobiblios','action'=>'majdaemprunteEtudiant')); ?></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?php echo $this->Url->build('/Respobiblios/badrparametres'); ?>"><i class="glyphicon glyphicon-edit"></i> Paramétres</a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-hdd"></i><span>Historiques</span> <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Historique pour chaque ouvrages',array('controller' =>'Respobiblios','action'=>'badrhistorique')); ?></li>
                    <li><?php echo $this->Html->link('Historique par Catégorie',array('controller' =>'Respobiblios','action'=>'badrhistoriqueCategorie')); ?></li>
                    <li><?php echo $this->Html->link('Historique de chaques utilisateurs',array('controller' =>'Respobiblios','action'=>'badrehistoriqueutilisateur')); ?></li>
                </ul>
            </li>


            <!--- fin badr -->

        </ul>
    </li>
    <?php
        }
        if ($bureau=='on') {

    ?>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Espace Bureau Ordre </span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">


            <!--DEBUT  Ibtihal -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fw fa-envelope"></i> <span>Courriers Reçus</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">



                    <li><?php echo $this->Html->link('Liste Courriers Reçus',array('controller'=>'Respobureauordres','action'=>'indexArrivee')); ?>"></li>
                    <li><?php echo $this->Html->link('Recherche courriers Reçus',array('controller'=>'Respobureauordres','action'=>'trierArrivee')); ?>"></li>
                    <li><?php echo $this->Html->link('Expediteurs',array('controller'=>'Respobureauordres','action'=>'indexexpediteur')); ?>"></li>
                </ul>
                <a href="#">
                    <i class="fa fa-fw fa-envelope-o"></i> <span>Courriers Departs</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li><?php echo $this->Html->link('Liste Courriers Envoyés',array('controller'=>'Respobureauordres','action'=>'indexDepart1')); ?>"></li>
                    <li><?php echo $this->Html->link('Recherche courriers Envoyés',array('controller'=>'Respobureauordres','action'=>'trierDepart')); ?>"></li>

                    <li><?php echo $this->Html->link('Destinataires',array('controller'=>'Respobureauordres','action'=>'indexDest')); ?>"></li>

                </ul>


            </li>

            <!--FIN  Ibtihal -->
            <!-- Bouhsise -->

    </ul>
    </li>



    <?php
        }
        if ($stage=='on') {

    ?>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Espace Stage </span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">


            <!-- Hamdi -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Stages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Gestion des certificats',array('controller'=>'respostages','action'=>'indexCertificats')); ?>"></li>
                    <li class="treeview">



                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-folder"></i> <span>Certificats etudiants</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><?php echo $this->Html->link('Tous',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants')); ?>"></li>
                            <li><?php echo $this->Html->link('GI',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/2')); ?>"></li>
                            <li><?php echo $this->Html->link('GE',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/3')); ?>"></li>
                            <li><?php echo $this->Html->link('GRT',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/1')); ?>"></li>
                            <li><?php echo $this->Html->link('GPE',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/4')); ?>"></li>
                            <li><?php echo $this->Html->link('TC',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/6')); ?>"></li>
                            <li><?php echo $this->Html->link('CP',array('controller'=>'respostages','action'=>'indexCertificatsEtudiants/5')); ?>"></li>

                        </ul>
                    </li>

                </ul>

            </li>




        </ul>
    </li>


<?php
    }
    if ($ingenieur=='on') {

?>


    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Espace Ingenieur </span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

            <!-- role ingenieur  : -->

            <!-- Bhihi -->
            <li class="treeview">
                <?php echo $this->Html->link('Home', array('controller' => 'ingenieurs','action' => 'index')); ?>
                <a href="#">
                    <i class="fa fa-table"></i> <span style="color:#FFFFFF">Actualité</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li><?php echo $this->Html->link('La listes des actualités', array('controller' => 'ingenieurs','action' => 'afficherActualites')); ?></li>



                </ul>
            </li>
             <!-- <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Gestion d'abscences</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><?php echo $this->Html->link('Demander une absence ',array('controller' => 'Ingenieurs','action' => 'demanderabsences')); ?>"></li>
            <li><?php echo $this->Html->link('Mes absences ',array('controller' => 'Ingenieurs','action' => 'listerAbsences')); ?>"></li>

        </ul>

    </li> -->
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-table"></i> <span style="color:#FFFFFF">Evenement</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li><?php echo $this->Html->link('La listes des evenements', array('controller' => 'ingenieurs','action' => 'afficherEvenements')); ?></li>



                </ul>
            </li>
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-table"></i> <span style="color:#FFFFFF">Statistiques</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li><?php echo $this->Html->link('La listes des laureats', array('controller' => 'ingenieurs','action' => 'afficherLaureats')); ?></li>



                </ul>
            </li>
            <!--VERSION 2 -->

            <li class="treeview">

                <a href="#">
                    <i class="fa fa-table"></i> <span style="color:#FFFFFF">Gallery</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">

                        <a href="#">
                            <i class="fa fa-table"></i> <span style="color:#FFFFFF">Photo</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">

                            <li><?php echo $this->Html->link('Liste des photo', array('controller' => 'ingenieurs','action' => 'afficherImages')); ?></li>

                        </ul>
                    </li>
                    <li class="treeview">

                        <a href="#">
                            <i class="fa fa-table"></i> <span style="color:#FFFFFF">Video</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">

                            <li><?php echo $this->Html->link('Liste des video', array('controller' => 'ingenieurs','action' => 'afficherVideos')); ?></li>

                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">

                <a href="#">
                    <i class="fa fa-table"></i> <span style="color:#FFFFFF">Parascolaire</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">

                        <a href="#">
                            <i class="fa fa-table"></i> <span style="color:#FFFFFF">Club</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">

                            <li><?php echo $this->Html->link('Liste des clubs', array('controller' => 'ingenieurs','action' => 'afficherClubs')); ?></li>

                        </ul>
                    </li>
                    <li class="treeview">

                        <a href="#">
                            <i class="fa fa-table"></i> <span style="color:#FFFFFF">Actualité Club</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">

                            <li><?php echo $this->Html->link('La listes des actualités', array('controller' => 'ingenieurs','action' => 'afficherActualiteClubs')); ?></li>
                        </ul>
                    </li>
                </ul>
            </li>


        </ul>
    </li>


 <?php //////////////////// directeur ////////////////////////////
}}
elseif ($us['role']=='directeur')
{

      if($scolarite=='on'){
            ?>

    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Espace scolarité</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><?php echo $this->Html->link('statistiques globaux ',array('controller' => 'directeur','action' => 'scolariteStat')); ?>"></li>

                            <li><?php echo $this->Html->link('statistiques par niveau ',array('controller' => 'directeur','action' => 'scolariteGenStat')); ?>"></li>

                        </ul></li>

<?php
}
      if($finance=='on'){
        ?>

        <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Espace finance</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><?php echo $this->Html->link('suivi des commandes ',array('controller' => 'directeur','action' => 'suiviCommandes')); ?>"></li>
                        </ul></li>


<?php
}
      if($personnel=='on'){
        ?>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Espace personnel</span> <i class="fa fa-angle-left pull-right"></i>
        </a>


            <ul class="treeview-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-wrench"></i> <span>Professeurs permanents</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Statistiques',array('controller' => 'directeur','action' => 'profPermStat')); ?>"></li>
                    <li><?php echo $this->Html->link('Liste ',array('controller' => 'directeur','action' => 'profPermListe')); ?>"></li>
                    <li><?php echo $this->Html->link('Liste par departement',array('controller' => 'directeur','action' => 'profPermDepar')); ?>"></li>
                </ul>
            </ul>

            <ul class="treeview-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-wrench"></i> <span>Professeurs vacataires</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Liste',array('controller' => 'directeur','action' => 'profVacatListe')); ?>"></li>
                </ul>
            </ul>

            <ul class="treeview-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-wrench"></i> <span>Fonctionnaires</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Liste',array('controller' => 'directeur','action' => 'fontionnaireListe')); ?>"></li>
                    <li><?php echo $this->Html->link('Liste par service',array('controller' => 'directeur','action' => 'fonctionnaireServiceListe')); ?>"></li>
                </ul>
            </ul>


        </li>
<?php
}
      if($biblio=='on'){
        ?>
   <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Espace bibliotheque</span> <i class="fa fa-angle-left pull-right"></i>
        </a>



                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Statistiques',array('controller' => 'directeur','action' => 'fonctionnaireBiblioListe')); ?>"></li>
                </ul>


        </li>

<?php
}
      if($stock=='on'){
        ?>
            <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Espace Stock</span> <i class="fa fa-angle-left pull-right"></i>
        </a>


            <ul class="treeview-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-wrench"></i> <span>Articles</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Liste des Articles',array('controller' => 'directeur','action' => 'stockarticle')); ?>"></li>
                </ul>
            </ul>

            <ul class="treeview-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-wrench"></i> <span>Commandes</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Liste des commandes',array('controller' => 'directeur','action' => 'stockcommande')); ?>"></li>
                </ul>
            </ul>

            <ul class="treeview-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-wrench"></i> <span>Fournisseurs</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Liste des Fournisseurs',array('controller' => 'directeur','action' => 'stockfournisseur')); ?>"></li>
                </ul>
            </ul>
            <ul class="treeview-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-wrench"></i> <span>Magasins</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Liste des Magasins',array('controller' => 'directeur','action' => 'stockmagasin')); ?>"></li>
                </ul>
            </ul>

            <ul class="treeview-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-wrench"></i> <span>Categories</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Liste des Categories',array('controller' => 'directeur','action' => 'stockcategorie')); ?>"></li>
                </ul>
            </ul>

            <ul class="treeview-menu">
                <a href="#">
                    <i class="glyphicon glyphicon-wrench"></i> <span>Mouvements</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Liste des Mouvements',array('controller' => 'directeur','action' => 'stockmouvement')); ?>"></li>
                </ul>
            </ul>

        </li>
<?php
}
      if($stage=='on'){
        ?>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Espace Stage</span> <i class="fa fa-angle-left pull-right"></i>
        </a>



                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Statistiques',array('controller' => 'directeur','action' => 'fonctionnaireStage')); ?>"></li>
                </ul>


        </li>
<?php
}
      if($ingenieur=='on'){
        ?>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Espace Ingénieurs</span> <i class="fa fa-angle-left pull-right"></i>
        </a>



                <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Statistiques',array('controller' => 'directeur','action' => 'ingenieurListe')); ?>"></li>
                </ul>

                 <ul class="treeview-menu">
                    <li><?php echo $this->Html->link('Liste Des Demandes Déposées',array('controller' => 'directeur','action' => 'etatDemandeFctListe')); ?>"></li>
                </ul>


        </li>


          <?php
}
}
}
?>
