<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Phinx\Db\Table;
use PhpParser\Node\Expr\Empty_;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Session;
use Cake\Validation;

/**
 * Fonctionnaires Controller
 *
 * @property \App\Model\Table\FonctionnairesTable $Fonctionnaires
 */
class FonctionnairesController extends AppController
{
    public function initialize()
    {

        parent::initialize();
        $this->loadComponent('Paginator');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {     

$connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $fonc_id = $this->getTeacherId()[0]['id'];
        $this->request->session()->write('fonc_id', $fonc_id);
        $usrole=$this->Auth->user('role');
    $this->set('role',$usrole);
    //debug($this->homeData($fonc_id));
    $this->set('data',$this->homeData($fonc_id));

        
        $this->render('/Espaces/fonctionnaires/home');

}
public function imprimerDocumentt($id1=null,$id2=null,$id3=null)
    {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $dsn = 'mysql://root:password@localhost/ensaksite';
        $con= ConnectionManager::get('default', ['url' => $dsn]);

        $gradeAssoc=$con->execute('select pg.cadre, pg.sous_grade from profpermanents_grades pg where pg.profpermanent_id='.$id2);
        $count=count($gradeAssoc);
        $this->set('nbGrade',count($gradeAssoc));
        $this->set('tabGrade',$gradeAssoc);
        $this->paginate = [
            'contain' => ['Fonctionnaires', 'Documents']
        ];
        $FonctionnairesDocuments=TableRegistry::get('FonctionnairesDocuments');
        $query=$FonctionnairesDocuments->find('all')->update()->set(['etatdemande' => 'Delivré'])->where(['document_id' => $id1,'fonctionnaire_id'=>$id2,'id'=>$id3]);
        $query->execute();
        $fonctionnairesDocuments = $this->paginate($FonctionnairesDocuments->find("all", array(
                "joins" => array(
                    array(
                        "table" => "Fonctionnaires",
                        "conditions" => array(
                            "fonctionnairesDocuments.fonctionnaire_id = Fonctionnaires.id"
                        )
                    ),
                    array(
                        "table" => "Documents",
                        "conditions" => array(
                            "fonctionnairesDocuments.document_id = Documents.id"
                        )
                    )
                ),
                'conditions' => array(
                    'fonctionnairesDocuments.document_id' => $id1,'fonctionnairesDocuments.fonctionnaire_id'=>$id2)
            )
        ));

        switch($id1)
        {
            case 1:
            {
                $this->set(compact('fonctionnairesDocuments'));
                $this->set('_serialize', ['fonctionnairesDocuments']);
                $this->render('/Espaces/fonctionnaires/imprimerAttestFct');
                break;

            }
            
            case 2:
            {
                $this->set(compact('fonctionnairesDocuments'));
                $this->set('_serialize', ['fonctionnairesDocuments']);
                $this->render('/Espaces/fonctionnaires/imprimerDemandeFct');
                break;

            }
        }


    }
public function etatDemande()
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
        $this->render('/Espaces/fonctionnaires/etatDemande');

    }

 private function getTeacherId() {
    $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $user_id = $this->Auth->user('id');
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT p.* from fonctionnaires p, users users
                WHERE users.id = $user_id AND 
                p.user_id = users.id;"
        );
        return $rows = $stmt->fetchAll('assoc');
    }
        
    private function homeData($prof_id){
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $box = array();
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute(
            "SELECT *
                        FROM fonctionnaires p 
                        WHERE p.id = $prof_id "
        );

        $box['PROF_DATA'] = $stmt->fetchAll('assoc');

        // GRADE
        $stmt =  $conn->execute(
            "SELECT *
                        FROM fonctionnaires_grades g 
                        WHERE g.fonctionnaire_id = $prof_id "
        );

        $box['PROF_GRADE'] = $stmt->fetchAll('assoc');
        
        return $box;
    }

    /**
     * View method
     *
     * @param string|null $id Fonctionnaire id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    

public function view()
    {  
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $fonctionnaire = $this->Fonctionnaires->get($id, [
            'contain' => ['Users', 'Activites', 'Grades', 'Services', 'Missions']
        ]);

        $this->set('fonctionnaire', $fonctionnaire);
        $this->set('_serialize', ['fonctionnaire']);
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
   
    /**
     * Edit method
     *
     * @param string|null $id Fonctionnaire id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $fonctionnaire = $this->Fonctionnaires->get($id, [
            'contain' => ['Activites', 'Grades', 'Services']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fonctionnaire = $this->Fonctionnaires->patchEntity($fonctionnaire, $this->request->getData());
            if ($this->Fonctionnaires->save($fonctionnaire)) {
                $this->Flash->success(__('The fonctionnaire has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fonctionnaire could not be saved. Please, try again.'));
        }
        $users = $this->Fonctionnaires->Users->find('list', ['limit' => 200]);
        $activites = $this->Fonctionnaires->Activites->find('list', ['limit' => 200]);
        $grades = $this->Fonctionnaires->Grades->find('list', ['limit' => 200]);
        $services = $this->Fonctionnaires->Services->find('list', ['limit' => 200]);
        $this->set(compact('fonctionnaire', 'users', 'activites', 'grades', 'services'));
        $this->set('_serialize', ['fonctionnaire']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fonctionnaire id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $this->request->allowMethod(['post', 'delete']);
        $fonctionnaire = $this->Fonctionnaires->get($id);
        if ($this->Fonctionnaires->delete($fonctionnaire)) {
            $this->Flash->success(__('The fonctionnaire has been deleted.'));
        } else {
            $this->Flash->error(__('The fonctionnaire could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function beforeFilter(Event $event)
    {
       
        // allow only login, forgotpassword
        $this->Auth->authorize = 'controller';
        $usrole = $this->Auth->user('role');
        if($usrole!='fonctionnaire')
        {

            $this->Flash->error(__('Vous ne pouvez pas acceder a ce lien'));
            return $this->redirect(
                ['controller' => 'Users', 'action' => 'logout']
            );
        }
        $this->Auth->deny();

    }

    public function viewmouna($id = null)
    {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $usrole=$this->Auth->user('id');
        $role=$this->Auth->user('role');
        $modif = ConnectionManager::get('default');
        $id = $modif->execute("SELECT id FROM fonctionnaires  WHERE user_id=".$usrole."")->fetchAll('assoc');


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

     public function demanderDoc()
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

                        return $this->redirect(['controller'=>'fonctionnaires','action' => 'index']);
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
                    // if($nombrebis>3)
                    // {
                    //     $this->Flash->error(__('Vous avez dépassé le nombre maximum des fiches de salaire, pour plus d\'infos veuillez nous conatcter au service'));
                    //     break;
                    // }
                    // else
                    if($nombre>=1)
                    {
                        $this->Flash->error(__('Echec d\'envoi ... Déja vous avez '.$nombre.'  demande(s) dans le service , veuillez attender Svp'));
                    }
                    elseif ($ProfpermanentsDocuments->save($documentsProfesseur)) {
                        $nombrebis++;
                        $query=$profpermanents->find('all')->update()->set(['etat_fiche' => $nombrebis])->where(['id' => $usrid]);
                        $query->execute();
                        $this->Flash->success(__('Demande envoyée.'));

                        return $this->redirect(['controller'=>'fonctionnaires','action' => 'index']);
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
        $this->render('/Espaces/fonctionnaires/demanderDoc');

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

        $this->render('/Espaces/fonctionnaires/demanderabsences');
    }


    public function Imprimer($id = null)
    {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $con=ConnectionManager::get('default');
        $id_fonct = $_SESSION['demandes'][0]['fonctionnaire_id'];
        $duree = 0;
        $_SESSION['print'] = 'no';
        $_SESSION['refus'] = 'no';

        $nbr_absences = $con->execute("SELECT duree_ab FROM absences WHERE fonctionnaire_id = $id_fonct AND isvalid=1")->fetchAll("assoc");
        $nbr_abs = $con->execute("SELECT COUNT(*) as n FROM absences WHERE fonctionnaire_id = $id_fonct AND isvalid=1")->fetchAll("assoc");
        for ($i=0; $i <$nbr_abs[0]['n']; $i++) {
            $duree += $nbr_absences[0]['duree_ab'];
        }

        $_SESSION['nbr_abs'] = $duree;

        $absences=$con->execute('SELECT * FROM absences  where id='.$id);
        
        $this->set('absences', $absences);
        $this->render('/Espaces/fonctionnaires/imprimer');
    }

    public function listerAbsences()
    {
        $connection = ConnectionManager::get('default');
        $res2 = $connection
                            ->execute(
                                'SELECT * FROM personnalisation'
                            )->fetch('assoc');
        $this->set('personnalisation',$res2);
        $usrole=$this->Auth->user('role');
        $id=$this->Auth->user('id');
        $this->set('role',$usrole);
        $this->render('/Espaces/respopersonels/home');
        $con=ConnectionManager::get('default');

        $demandes = $con->execute("SELECT  absences.id,absences.duree_ab,absences.cause,absences.date_ab,absences.time_ab,absences.isvalid, fonctionnaires.nom_fct, absences.fonctionnaire_id, fonctionnaires.prenom_fct,fonctionnaires_grades.grade,absences.duree_ab,absences.date_ab,absences.time_ab,absences.cause FROM absences,fonctionnaires, fonctionnaires_grades WHERE fonctionnaires_grades.fonctionnaire_id = fonctionnaires.id  AND absences.fonctionnaire_id = fonctionnaires.id AND fonctionnaires.user_id=".$id)->fetchAll("assoc");
        //debug($demandes); die;
        if(empty($demandes))
        {
            $_SESSION['isdemande'] ='no';
        }
        else
        {
            $_SESSION['isdemande'] ='yes';
            $_SESSION['demandes'] = $demandes;

        }
        $this->render('/Espaces/fonctionnaires/listerAbsences');
    }


}
