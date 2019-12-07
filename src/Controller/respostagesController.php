<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;



class respostagesController extends AppController {

    public function beforeFilter(Event $event)
    {
        // allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        if($usrole!='respostage' && $usrole!='admin' && $usrole!='directeur')
        {

            $this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();

    }
    



	public function index() {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $usrole = $this->Auth->user('role');
        if($usrole=='respostage') {
            $this->set('role', $usrole);
            $this->render('/Espaces/respostages/home');
        }
    }
    public function indexCertificatsEtudiants($f = NULL)  {
        
         
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $usrole=$this->Auth->user('role');
        $this->set('role',$usrole);
        $connection = ConnectionManager::get('default');
        $suite = "";
        if($f != NULL){
            $suite = "AND filieres.id = :f ";
        }

        $donne_delivrer =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,certificats.id,etudiants.id, etudiants.nom_fr,etudiants.cne,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id
                                                               WHERE certificats_etudiants.etat = "Délivré" AND certificats.type LIKE "%stage" '.$suite.' ORDER BY certificats_etudiants.created ASC',[':f'=>$f])->fetchAll('assoc');



        $donne_demande =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr,etudiants.cne, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Demande envoyé" AND certificats.type LIKE "%stage" '.$suite.' ORDER BY certificats_etudiants.created ASC',[':f'=>$f])->fetchAll('assoc');



        $donne_enCour =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr,etudiants.cne, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "En cours de traitement" AND certificats.type LIKE "%stage" '.$suite.' ORDER BY certificats_etudiants.created ASC',[':f'=>$f])->fetchAll('assoc');


        $donne_rejeter =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr,etudiants.cne, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Rejeter" AND certificats.type LIKE "%stage" '.$suite.' ORDER BY certificats_etudiants.created ASC',[':f'=>$f])->fetchAll('assoc');


        $donne_prete =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr,etudiants.cne, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Prête" AND certificats.type LIKE "%stage" '.$suite.' ORDER BY certificats_etudiants.created ASC',[':f'=>$f])->fetchAll('assoc');


       
        $this->set('donne_delivrer',$donne_delivrer);
        $this->set('donne_demande',$donne_demande);
        $this->set('donne_enCour',$donne_enCour);
        $this->set('donne_rejeter',$donne_rejeter);
        $this->set('donne_prete',$donne_prete);
       
       
        $this->set('_serialize', ['donne_delivrer']);  
         $this->set('_serialize', ['donne_enCour']);  
          $this->set('_serialize', ['donne_demande']);  
           $this->set('_serialize', ['donne_rejeter']);  
            $this->set('_serialize', ['donne_prete']);  
        $this->render('/Espaces/respostages/CertificatsEtudiants/index');
       
    }


   /**********************************************************************************************************************/
// home du responsable

    public function indexrespo() {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);

       $donne_demande =  $connection->execute('SELECT certificats_etudiants.id AS cer_id FROM certificats_etudiants
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = "Demande envoyé" AND certificats.type LIKE "%stage" ')->fetchAll('assoc');
        
       $nbre=count($donne_demande);
        $envoye='"Demande envoyé"';
       $enCours='"En cours de traitement"';
       $prete='"Prête"';
       $delivre='"Délivré"';
       $rejeter='"Rejeter"';
       $nEnvoye= $this->nbre(NULL,$envoye);
       $nEncours= $this->nbre(NULL,$enCours);
       $nPrete=$this->nbre(NULL,$prete);
       $nDelivre=$this->nbre(NULL,$delivre);
       $nRejete=$this->nbre(NULL,$rejeter);
       $this->set('nEnvoye',$nEnvoye);
       $this->set('nEncours',$nEncours);
       $this->set('nPrete',$nPrete);
       $this->set('nDelivre',$nDelivre);
       $this->set('nRejete',$nRejete);


      
        $this->render('/Espaces/respostages/home'); 
    }
/******************************************************************************************************************************************/
// creation automatique du dossier    
    private function dossier()
    { $a=date("Y-m-d");
    $path = 'files' . DS . $a;
$folder = new Folder($path);

if (is_null($folder->path)) {
    $dir = new Folder(WWW_ROOT.'certificats stage'.DS.$a, true, 0755);
  }
     
  
    }
/**************************************************************************************************************************/
// afficher certificat de l'atudiant    
      public function viewCertificatsEtudiants($id = null)
    {
      $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
    	$CertificatsEtudiants = TableRegistry::get("certificats_etudiants");
        $certificatsEtudiant = $CertificatsEtudiants->get($id, [
            'contain' => ['Certificats', 'Etudiants']
        ]);
        
        $certificatsEtudiant->notif_respo = FALSE;
        $certificatsEtudiant->modified = $certificatsEtudiant->modified;
        if($CertificatsEtudiants->save($certificatsEtudiant)){
            $this->set('certificatsEtudiant', $certificatsEtudiant);
            $this->set('_serialize', ['certificatsEtudiant']);    
                 
            $this->render('/Espaces/respostages/CertificatsEtudiants/view');
        }else{
             
            return $this->Flash->error(_('Erreur innatendue !!'));
        }
    }
/********************************************************************************************************************************************/
// IMPRIMER CERTIFIACT DE L'ETUDIANT    
    public function imprimerCertificatsEtudiants($id = null)
    {
      $this->dossier();
         
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $donne =  $connection->execute('SELECT etudiants.nom_fr,etudiants.prenom_fr, etudiants.code_sexe, etudiants.cne, certificats_etudiants.entreprise, filieres.libile, certificats.type, certificats_etudiants.duree_stage, certificats_etudiants.theme_stage, certificats_etudiants.debut_stage, certificats_etudiants.fin_stage
                                        FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');
      $prof=$connection->execute('SELECT profpermanents.prenom_prof, profpermanents.nom_prof FROM profpermanents JOIN certificats_etudiants ON profpermanents.id = certificats_etudiants.profpermanent_id WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');
        $niveau=$connection->execute('SELECT niveaus.id, niveaus.libile FROM niveaus
          JOIN groupes ON niveaus.id= groupes.niveaus_id
          JOIN etudiers ON groupes.id = etudiers.groupe_id
          JOIN etudiants ON etudiers.etudiant_id= etudiants.id
          JOIN certificats_etudiants ON etudiants.id= certificats_etudiants.etudiant_id
          WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');

         $this->set('prof', $prof);
        $this->set('donne', $donne);
        $this->set('niveau',$niveau);
        if($donne[0]['type']=="Convention - stage")
        {

          switch ($niveau[0]['id']) {
            case 3:
              $this->render('/Espaces/respostages/CertificatsEtudiants/conventionTC');
              break;
              case 4 :
              $this->render('/Espaces/respostages/CertificatsEtudiants/conventionCI');
              break;
              case 5:
              $this->render('/Espaces/respostages/CertificatsEtudiants/convention5');
              break;

          }

        }
        elseif ($donne[0]['type']=="Recommandation - stage") {
          switch ($niveau[0]['id']) {
            case 1:
              $this->render('/Espaces/respostages/CertificatsEtudiants/recommendation');
              break;
              case 2 :
              $this->render('/Espaces/respostages/CertificatsEtudiants/recommendation');
              break;
              case 3:
              $this->render('/Espaces/respostages/CertificatsEtudiants/recommendation3');
              break;
               case 4:
              $this->render('/Espaces/respostages/CertificatsEtudiants/recommendation4');
              break;
               case 5:
              $this->render('/Espaces/respostages/CertificatsEtudiants/recommendation5');
              break;
        }
        
    }
    }
    /*********************************************************************************************************************/
    // MISE A ZERO DE LA TABLE
    public function miseAzeroCertificatsEtudiants()
      {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $this->request->allowMethod(['post', 'delete']);
        $connection->execute('TRUNCATE TABLE certificats_etudiants');
        return $this->redirect(['action' => 'indexCertificatsEtudiants']);  

      }
   /**************************************************************************************************************************/
  // public function rechercherCertificatsEtudinats   
/**************************************************************************************************************************/ 
// COMMENTER CERTIFICAT ET ENTRER LA RAISON DU REJET   

  public function cmntCertificatsEtudiants($id = null)
    {
        
         
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
    	
        $CertificatsEtudiants = TableRegistry::get("certificats_etudiants");
        $certificatsEtudiant = $CertificatsEtudiants->get($id, [
            'contain' => ['Certificats', 'Etudiants']
        ]);
        $donne =  $connection->execute('SELECT  filieres.id  
                                        FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');
              $f=$donne[0]['id'];
        if ($this->request->is(['patch', 'post', 'put']) && !isset($this->request->data['Rejeter'])) {
            $certificatsEtudiant->commentaire = $this->request->data['commentaire'];
            $certificatsEtudiant->notif_etudiant = TRUE;
            if (isset($this->request->data['rejeterprince']) && $this->request->data['rejeterprince']) {
              $certificatsEtudiant->etat = "Rejeter";
            }
            if ($CertificatsEtudiants->save($certificatsEtudiant)) {
                $this->Flash->success(__('Le commentaire est envoyé.'));;
                return $this->redirect(['action' => 'indexCertificatsEtudiants/'.$f.'']);                
            }
            $this->Flash->error(__('Le commentaire n est pas envoyé. Réssayer'));
        }
        $certificats = $CertificatsEtudiants->Certificats->find('list', ['limit' => 200]);
        $etudiants = $CertificatsEtudiants->Etudiants->find('list', ['limit' => 200]);
        $certificatCmnt= $CertificatsEtudiants->find('all',array('conditions'=>array('certificats_etudiants.id'=>$certificatsEtudiant->id),'fields' => 'commentaire'))->toArray();
        if (isset($this->request->data['Rejeter'])) {
            $this->set('test',$this->request->data);
        }
        $this->set(compact('certificatsEtudiant', 'certificats', 'etudiants'));
        $this->set('_serialize', ['certificatsEtudiant']);

        $this->render('/Espaces/respostages/CertificatsEtudiants/cmnt');

    }
/*********************************************************************************************************************************************/
// MODIFIER L'ETAT DU CERTIFICAT DE L'ETUDIANT

    public function editCertificatsEtudiants($id = null)
    {
         
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $this->request->allowMethod(['post', 'Prête','Approuver','Délivré','Cmnt']);
        $CertificatsEtudiants = TableRegistry::get("certificats_etudiants");

        $certificatsEtudiant = $CertificatsEtudiants->get($id, [
            'contain' => []
        ]);

       
              $donne =  $connection->execute('SELECT  filieres.id  
                                        FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.id = :id',[':id'=>$id])->fetchAll('assoc');
              $f=$donne[0]['id'];
       
        switch ($this->request->data['editer']) {
            case 'Approuver':
                $certificatsEtudiant->etat = "En cours de traitement";
                $certificatsEtudiant->notif_etudiant=1;
                break;
            case 'Valider':
                $certificatsEtudiant->etat = "Prête";
                $certificatsEtudiant->notif_etudiant=1;
                break;
            case 'Délivrer':
                $certificatsEtudiant->etat = "Délivré";
                $certificatsEtudiant->notif_etudiant=1;
                break;  
                  
                        
        }
            if ($CertificatsEtudiants->save($certificatsEtudiant)) {
                $this->Flash->success(__($this->request->data));
                return $this->redirect(['action' => 'indexCertificatsEtudiants']);
            }
        $this->Flash->error(__('Aucn changement n \' est effectué.'));
        return $this->redirect(['action' => 'indexCertificatsEtudiants']);

    }
/**************************************************************************************************************************************************/
// CHOISIR LES CERTIDICATS A SUPPRIMER
    public function reinitialiserCertificatsEtudiants(){
         $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        //$this->request->allowMethod(['post', 'delete']);
        $connection = ConnectionManager::get('default');
        
        $CertificatsEtudiants = TableRegistry::get("certificats_etudiants");
        $certificats_type =  $connection->execute('SELECT type, id FROM certificats WHERE certificats.type LIKE "%stage" ')->fetchAll('assoc');
        $this->set('certificats_type', $certificats_type);
         if ($this->request->is(['patch', 'post', 'put']) && !isset($this->request->data['Réinitialiser'])) 
         {
                $certif_id = array();
                foreach($this->request->data as $key => $value){
                    if($key != "vider")
                    $certif_id[] = $key;
                }
               if($CertificatsEtudiants->deleteAll(["certificat_id IN(".implode(',', $certif_id).")"])){
                   $this->Flash->success(__('Réinitilisation avec success'));
               }else{
                   $this->Flash->error(__('Erreur'));
               }
               return $this->redirect(['action'=>'indexCertificatsEtudiants']);
            }
         $this->render('/Espaces/respostages/CertificatsEtudiants/choix');
    }
    /*********************************************************************************************************************************/
    /*****************************************************************************************************************************************/

    private function nbre($f = NULL,$a)
    {
       $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
      $suite = "";
        if($f != NULL){
            $suite = "AND filieres.id = :f ";
        }

        $donne_delivrer =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,certificats.id,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.etat = '.$a.' AND certificats.type LIKE "%stage" '.$suite,[':f'=>$f])->fetchAll('assoc');
        return count($donne_delivrer);

    }
    /**********************************************************************************************************************************/

    private function nbreMois($f = NULL,$m)
    {
       $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
     $suite = "";
        if($f != NULL){
            $suite = "AND filieres.id = :f ";
        }
        $b=date("Y");
      

        $donne_delivrer =  $connection->execute('SELECT certificats.type,certificats_etudiants.id as id_certif,certificats.id,etudiants.id, etudiants.nom_fr,etudiants.prenom_fr, filieres.libile, certificats_etudiants.etat, certificats_etudiants.created, certificats_etudiants.modified,certificats_etudiants.entreprise FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE certificats_etudiants.created between "'.$b.'-'.$m.'-01" and "'.$b.'-'.$m.'-31" AND certificats.type LIKE "%stage" '.$suite,[':f'=>$f])->fetchAll('assoc');
        return count($donne_delivrer);

    }
    /****************************************************************************************************************************************/
    // STATISTIQUES
    public function statiqtiquesCertificatsEtudiants()
    {
       $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
     
        $filiere= $connection->execute('SELECT * FROM filieres ')->fetchAll('assoc');
        $del=array();
       $envoye='"Demande envoyé"';
       $enCours='"En cours de traitement"';
       $prete='"Prête"';
       $delivre='"Délivré"';
       $rejeter='"Rejeter"';

        for($i=0;$i<count($filiere);$i++)
        {
          $a=$filiere[$i]['id'];
          $envoyeStat[$a]=$this->nbre($a,$envoye);
          $enCoursStat[$a]=$this->nbre($a,$enCours);
          $preteStat[$a]=$this->nbre($a,$prete);
          $delivreStat[$a]=$this->nbre($a,$delivre);
          $rejeterStat[$a]=$this->nbre($a,$rejeter);
        }

      
        $this->set('envoyeStat',$envoyeStat);
        $this->set('enCoursStat',$enCoursStat);
        $this->set('preteStat',$preteStat);
        $this->set('delivreStat',$delivreStat);
        $this->set('rejeterStat',$rejeterStat);

        

       $this->set('filiere',$filiere);
       
   
      $this->render('/Espaces/respostages/CertificatsEtudiants/statistiques'); 


    }
    /**********************************************************************************************************/
 public function graphesCertificatsEtudiants()
    {
       $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
     
        $filiere= $connection->execute('SELECT * FROM filieres ')->fetchAll('assoc');
        $del=array();
       

        for($i=0;$i<count($filiere);$i++)
        {
          for($j=1 ; $j<13;$j++){
          $a=$filiere[$i]['id'];
          $envoyemois[$a][$j]=$this->nbreMois($a,$j);
          }
        }
         for($j=1;$j<13;$j++){
          
          $envoyemoisTotal[$j]=$this->nbreMois(NULL,$j);
        }
         $this->set('envoyemois',$envoyemois);

        $this->set('envoyemoisTotal',$envoyemoisTotal);

       

       $this->set('filiere',$filiere);
       
   
      $this->render('/Espaces/respostages/CertificatsEtudiants/graphes'); 


    }

             
/****************************************************************************************************************************************************************/
                                              //                  GESTION DES CERTIFICATS


/****************************************************************************************************************************************************************/
// AFFICHAGE DES CERTIFICATS 
   public function indexCertificats()
    {
         
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $certificats = $connection->execute('SELECT * FROM certificats  WHERE certificats.type LIKE "%stage" ')->fetchAll('assoc');

        $this->set(compact('certificats'));
        $this->set('_serialize', ['certificats']);
        $this->render('/Espaces/respostages/Certificats/index');
    }

/**********************************************************************************************************************************************************/
// RECHERCHE

    public function searchCertificats()
    {
         $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $Certificats = TableRegistry::get("certificats");
        $certificat = $Certificats->get($this->request->data['search'], [
            'contain' => ['Etudiants']
        ]);

        $this->set('certificat', $certificat);
        $this->set('_serialize', ['certificat']);

        $this->render('/Espaces/respostages/Certificats/view');    
    }
/*******************************************************************************************************************************************************/
// AFFICHER LA CERTIFICAT    
  
    public function viewCertificats($id = null)
    {
         $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $Certificats = TableRegistry::get("certificats");
        $certificat = $Certificats->get($id, [
            'contain' => ['Etudiants']
        ]);
        $this->set('certificat', $certificat);
        $this->set('_serialize', ['certificat']);

        $this->render('/Espaces/respostages/Certificats/view');
    }

/*******************************************************************************************************************************************************/
// AJOUTER UNE CERTIFICAT 
    public function addCertificats()
    {
         $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $Certificats = TableRegistry::get("certificats");
        
        $certificat = $Certificats->newEntity();
        
        if ($this->request->is('post') ) {
         $a= strval($this->request->data['type']);

        $this->request->data['type'] =$a.'-stage';
            $certificat = $Certificats->patchEntity($certificat, $this->request->data);
            if ($Certificats->save($certificat)) {
                $this->Flash->success(__('The {0} has been saved.', 'Certificat'));
                return $this->redirect(['action' => 'indexCertificats']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Certificat'));
            }
        }
        $connection = ConnectionManager::get('default');
        $profs= $connection->execute('SELECT profpermanents.id, profpermanents.nom_prof, profpermanents.prenom_prof FROM profpermanents');
        $this->set('profs',$profs);
      
     
      
       
        $this->set(compact('certificat', 'etudiants'));
        $this->set('_serialize', ['certificat']);
        $this->render('/Espaces/respostages/Certificats/add');
    }

/*******************************************************************************************************************************************************/
// EDITER UNE CERTIFICAT 
    public function editCertificats($id = null)
    {
         $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $Certificats = TableRegistry::get("certificats");
        $certificat = $Certificats->get($id, [
            'contain' => ['Etudiants']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $certificat = $Certificats->patchEntity($certificat, $this->request->data);
            if ($Certificats->save($certificat)) {
                $this->Flash->success(__('The {0} has been saved.', 'Certificat'));
                return $this->redirect(['action' => 'indexCertificats']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Certificat'));
            }
        }
        $this->set(compact('certificat', 'etudiants'));
        $this->set('_serialize', ['certificat']);
        $this->render('/Espaces/respostages/Certificats/edit');
    }
/*******************************************************************************************************************************************************/
// SUPPRIMER UNE CERTIFICAT 
    public function deleteCertificats($id = null)
    {
         $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $this->request->allowMethod(['post', 'delete']);
        $Certificats = TableRegistry::get("certificats");
        $certificat = $Certificats->get($id);
        if ($Certificats->delete($certificat)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Certificat'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Certificat'));
        }
        return $this->redirect(['action' => 'indexCertificats']);

    }
/*******************************************************************************************************************************************************/
/*******************************************************************************************************************************************************/
/*******************************************************************************************************************************************************/
/*******************************************************************************************************************************************************/
// notifications resposcolarites

   public function updateNotifications(){

        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);

        $usrole=$this->Auth->user('id');
        $test =  $connection->execute('SELECT certificats_etudiants.id,etudiants.nom_fr,etudiants.prenom_fr, certificats_etudiants.etat, filieres.libile, 
                                        certificats.type, certificats_etudiants.modified FROM filieres JOIN groupes ON filieres.id = groupes.filiere_id
                                                               JOIN etudiers ON groupes.id = etudiers.groupe_id
                                                               JOIN etudiants ON etudiers.etudiant_id = etudiants.id
                                                               JOIN certificats_etudiants ON etudiants.id = certificats_etudiants.etudiant_id 
                                                               JOIN certificats ON certificats_etudiants.certificat_id = certificats.id 
                                                               WHERE (certificats.type LIKE "%stage") AND (certificats_etudiants.notif_respo = TRUE)
                                                               ')->fetchAll('assoc');

        $notif_respo = array();
        for($i=0;$i<count($test);$i++){
                $notif_respo[$i]['id'] = $test[$i]['id'];
                $notif_respo[$i]['commentaire'] = $test[$i]['nom_fr'].' '.$test[$i]['prenom_fr'].' de la filiere '.$test[$i]['libile'];
                $notif_respo[$i]['principale'] = $test[$i]['etat'];
                $notif_respo[$i]['titre'] = $test[$i]['type'];
                $notif_respo[$i]['date'] = $test[$i]['modified'];
                $notif_respo[$i]['lien'] = 'viewCertificatsEtudiants';
                switch ($test[$i]['etat']){
                            case 'Rejeter' : 
                                    $notif_respo[$i]['style']= "badge bg-red";
                                    break;
                            case 'En cours de traitement' : 
                                    $notif_respo[$i]['style']= "badge bg-yellow";
                                    break;
                            case 'Demande envoyé' : 
                                    $notif_respo[$i]['style']= "badge bg-light-blue";
                                    break;
                            case 'Prête' : 
                                    $notif_respo[$i]['style']= "badge bg-green";
                                    break;
                            case 'Délivré' : 
                                    $notif_respo[$i]['style']= "badge bg-navy";
                                    break;
                            } 
        }
        $session = $this->request->session();
        $session->write('notifications', $notif_respo);

        $this->render('/Element/notification');
    }
public function demanderabsences()
    {
      $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $_SESSION['auto'] = "none";
        $user_id = $this->Auth->user('id');
        $con=ConnectionManager::get('default');

        $id = $con->execute("SELECT id FROM fonctionnaires WHERE user_id = $user_id")->fetchAll('assoc');
        //debug($id); die;
        $fonct_id = $id[0]['id'];

        $nbr = $con->execute("SELECT COUNT(*) as n FROM absences WHERE fonctionnaire_id = $fonct_id")->fetchAll('assoc');
        $duree = $con->execute("SELECT duree_ab FROM absences WHERE fonctionnaire_id = $fonct_id")->fetchAll('assoc');
        $d =0;
        for ($i=0; $i < $nbr[0]['n']; $i++)
        {
            $d += $duree[$i]['duree_ab'];
        }

        if(isset($_POST['submit']))
        {

            $duree_ab = $_POST['duree_ab'];
            $cause = $_POST['cause'];
            $date_ab = $_POST['date'];

            if (empty($_POST['time']))
            {
                $time_ab = 0;

            }
            else
            {
                $time_ab = $_POST['time'];
            }

            if($d>'13')
            {
                $_SESSION['auto'] ="no";
            }
            else
            {
                $_SESSION['auto'] ="yes";
                $con->execute("INSERT INTO absences (fonctionnaire_id,duree_ab,cause,date_ab,time_ab) VALUES ($fonct_id,$duree_ab,'$cause','$date_ab','$time_ab')");

            } }

        $this->render('/Espaces/respostages/demanderabsences');
    }


 public function demanderDocFct()
    {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $ProfpermanentsDocuments=TableRegistry::get('FonctionnairesDocuments');
        $documentsProfesseur = $ProfpermanentsDocuments->newEntity();
        $documentbis=TableRegistry::get('Documents');
        $documentbis=$documentbis->find('all');
        $profbis=TableRegistry::get('Fonctionnaires');
        $profbis=$profbis->find('all');
        $idUser=$this->Auth->user('id');
        $profpermanents=TableRegistry::get('Fonctionnaires');
        $query=$profpermanents->find('all')->select('id')->where(['user_id'=>$idUser]);

        foreach($query as $ligne)
        {
            $usrid=$ligne->id;
        }

        if ($this->request->is('post')){

            $documentsProfesseur->fonctionnaire_id =$usrid;
            $documentsProfesseur->document_id =$this->request->data('nomDoc');
            //requete pour une demande déja effectué
            $requete = $ProfpermanentsDocuments->find('all',array('conditions' => array('FonctionnairesDocuments.fonctionnaire_id' => $usrid
            ,   'FonctionnairesDocuments.document_id' => $this->request->data('nomDoc'))));
            $nombre=0;
            foreach($requete as $resultat)
            {
                if($resultat->etatdemande=='Demande envoyé' or $resultat->etatdemande=='Prete' or $resultat->etatdemande=='En cours de traitement')
                {
                    $nombre++;
                }
            }

            $Profpermanents=TableRegistry::get('Fonctionnaires');
            $identifiantDoc=$this->request->data('nomDoc');

            switch($identifiantDoc)
            {
                case 1:
                {
                    $nbtentativebis=$Profpermanents->find('all')->select('etat_attestation')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;

                    }

                    // if($nombrebis>3)
                    // {
                    //     $this->Flash->error(__('Vous avez dépassé le nombre maximum des attestations , pour plus d\'infos veuillez nous conatcter au service'));
                    //     break;
                    // }

                    // else
                    if($nombre>=1)
                    {
                        $this->Flash->error(__('Echéc d\'envoi ... Déja vous avez '.$nombre.' demande(s) dans le service, veuillez attender Svp'));
                        break;
                    }
                    elseif($ProfpermanentsDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$profpermanents->find('all')->update()->set(['etat_attestation' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();

                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['controller'=>'respostages','action' => 'index']);
                    }
                    else{
                        $this->Flash->error(__('Demande échouée'));

                    }



                    break;
                }
                case 2:
                {
                    // debug($usrid);
                    $nbtentativebis=$profpermanents->find('all')->select('etat_fiche')->where(['id'=>$usrid]);
                    foreach ($nbtentativebis as $value) {
                        $nombrebis=$value->etat_attestation;

                    }
                    $nombrebis=count($nbtentativebis);
                    if($nombrebis>3)
                    {
                        $this->Flash->error(__('Vous avez dépassé le nombre maximum des fiches de salaire, pour plus d\'infos veuillez nous conatcter au service'));
                        break;
                    }
                    elseif($nombre>=1)
                    {
                        $this->Flash->error(__('Echec d\'envoi ... Déja vous avez '.$nombre.'  demande(s) dans le service , veuillez attender Svp'));
                    }
                    elseif ($ProfpermanentsDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$profpermanents->find('all')->update()->set(['etat_fiche' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();
                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['controller'=>'respostages','action' => 'index']);
                    }
                    else{
                        $this->Flash->error(__('Demande echouée'));

                    }

                }
            }


        }

        $profpermanents = $ProfpermanentsDocuments->fonctionnaires->find('list', ['limit' => 200]);
        $documents = $ProfpermanentsDocuments->Documents->find('list', ['limit' => 200]);
        $this->set('doc',$documentbis);
        $this->set('prof',$profbis);
        $this->set(compact('documentsProfesseur', 'profpermanents', 'documents'));
        $this->set('_serialize', ['documentsProfesseur']);
        $this->render('/Espaces/respostages/demanderDocFct');

    }
    public function etatDemandeFct()
    {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $idUser = $this->Auth->user('id');
        $Foncts = TableRegistry::get('Fonctionnaires');
        $query = $Foncts->find('all')->select('id')->where(['user_id' => $idUser]);
        foreach ($query as $ligne) {
            $ide = $ligne->id;
            break;
        }
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Documents']
        ];
        $FonctionnairesDocuments = TableRegistry::get('FonctionnairesDocuments');
        $FonctionnairesDocuments = $this->paginate($FonctionnairesDocuments->find("all", array(
                "joins" => array(
                    array(
                        "table" => "Fonctionnaires",
                        "conditions" => array(
                            "FonctionnairesDocuments.fonctionnaire_id = Fonctionnaires.id"
                        )
                    ),
                    array(
                        "table" => "Documents",
                        "conditions" => array(
                            "FonctionnairesDocuments.document_id = Documents.id"
                        )
                    )
                ),
                'conditions' => array(
                    'FonctionnairesDocuments.fonctionnaire_id' => $ide)
            )
        ));
        $this->set(compact('FonctionnairesDocuments'));
        $this->set('_serialize', ['FonctionnairesDocuments']);
        $this->render('/Espaces/respostocks/etatDemandeFct');

    }

    //Validation de donnees

    public function viewmouna($id = null)
    {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $this->loadModel('Fonctionnaires');
        $usrole=$this->Auth->user('id');
        $role=$this->Auth->user('role');

        $modif = ConnectionManager::get('default');
        $id = $modif->execute("SELECT id FROM fonctionnaires  WHERE user_id=".$usrole."")->fetchAll('assoc');
        //debug($id);

        $profpermanent = $this->Fonctionnaires->get($id[0]['id'], [
            'contain' => []
        ]);

        $this->set('id',$usrole);
        $this->set('role',$role);
        $this->set('profpermanent', $profpermanent);
        $this->render('/Espaces/fonctionnaires/viewmouna');
    }

    public function editmouna()
    {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $this->loadModel('Fonctionnaires');
        $usrole=$this->Auth->user('id');

        $modif = ConnectionManager::get('default');
        $id = $modif->execute("SELECT id FROM fonctionnaires  WHERE user_id=".$usrole."")->fetchAll('assoc');
        $id=$id[0]['id'];
        $Profpermanent = TableRegistry::get('fonctionnairesbis');
        $profpermanentOriginal = $this->Fonctionnaires->get($id);
        $profpermanent = $this->Fonctionnaires->get($id);
        //debug($profpermanent);

        if ($this->request->is(['patch', 'post', 'put'])) {

            //debug($profpermanentOriginal);
            $profpermanent = $Profpermanent->newEntity();
            //$profpermanent= $Profpermanent->patchEntity($profpermanent, $this->request->data);

            $profpermanent->somme=$this->request->data('somme');
            $profpermanent->user_id=$profpermanentOriginal->user_id;
            $profpermanent->salaire=$profpermanentOriginal->salaire;
            $profpermanent->etat=$this->request->data('etat');
            //debug($this->request->data('date_Recrut'));
            if($profpermanentOriginal->date_Recrut)
               $profpermanent->date_Recrut=$profpermanentOriginal->date_Recrut;
            $profpermanent->nom_fct=$this->request->data('nom_fct');
            $profpermanent->prenom_fct=$this->request->data('prenom_fct');
            $profpermanent->age=$this->request->data('age');
            $profpermanent->specialite=$this->request->data('specialite');
            $profpermanent->situation_Familiale=$this->request->data('situation_Familiale');
            if($profpermanentOriginal->dateNaissance)
             $profpermanent->dateNaissance=$profpermanentOriginal->dateNaissance;
             $profpermanent->etat_attestation=$profpermanentOriginal->etat_attestation;
             $profpermanent->photo=$profpermanentOriginal->photo;
             $profpermanent->etat_fiche=$profpermanentOriginal->etat_fiche;
            $profpermanent->lieuNaissance=$this->request->data('lieuNaissance');
            $profpermanent->CIN=$this->request->data('CIN');
            $profpermanent->email=$this->request->data('email');
            $profpermanent->phone=$this->request->data('phone');
            $profpermanent->genre=$this->request->data('genre');
            $profpermanent->nbr_enfants=$this->request->data('nbr_enfants');
            $profpermanent->isPassExam=$this->request->data('isPassExam');
            //debug($profpermanent);

            //dump($profpermanent);exit;

            if ($Profpermanent->save($profpermanent)) {
                $this->Flash->success(__('Votre demande de modification de données a été envoyée au responsable , veuillez attendre son traitement .
                '));

                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fonctionnaire'));
            }
        }
        $this->set(compact('profpermanent'));
        $this->render('/Espaces/fonctionnaires/editmouna');

    }


}

?>
