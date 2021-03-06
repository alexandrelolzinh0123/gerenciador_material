<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use App\Controller\Files;
/**
 * Material Controller
 *
 * @property \App\Model\Table\MaterialTable $Material
 *
 * @method \App\Model\Entity\Material[] paginate($object = null, array $settings = [])
 */
class MaterialController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function initialize(){
        parent::initialize();        
        // Load Files model
        $this->loadModel('Files');
        
       
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Files']
        ];
        $material = $this->paginate($this->Material);

        $this->set(compact('material'));
        $this->set('_serialize', ['material']);
    }

    /**
     * View method
     *
     * @param string|null $id Material id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $material = $this->Material->get($id, [
            'contain' => ['Users', 'Files']
        ]);

        $this->set('material', $material);
        $this->set('_serialize', ['material']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $material = $this->Material->newEntity();
        if ($this->request->is('post')) {
            $material = $this->Material->patchEntity($material, $this->request->getData());


            if(!empty($this->request->data['files_id']['name'])){
                $fileName = $this->request->data['files_id']['name'];
                $uploadPath = 'uploads/files/';
                $file = $this->Files->uploadAndSaveFile($this->request->data['files_id']['tmp_name'],$uploadPath,$fileName);
                $material->files_id = $file->id;
                
            }else{
                $this->Flash->error(__('nao escolheu arquivo.'));
            }

            $material->user_id = $this->Auth->user('id');
            if ($this->Material->save($material)) {
                $this->Flash->success(__('Material salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('material não pode ser salvo'));
        }
        $users = $this->Material->Users->find('list', ['limit' => 200]);
        $files = $this->Material->Files->find('list', ['limit' => 200]);
        $this->set(compact('material', 'users', 'files'));
        $this->set('_serialize', ['material']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Material id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $material = $this->Material->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $material = $this->Material->patchEntity($material, $this->request->getData());
            if ($this->Material->save($material)) {
                $this->Flash->success(__('Material salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('material não pode ser salvo.'));
        }
        $users = $this->Material->Users->find('list', ['limit' => 200]);
        $files = $this->Material->Files->find('list', ['limit' => 200]);
        $this->set(compact('material', 'users', 'files'));
        $this->set('_serialize', ['material']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Material id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $material = $this->Material->get($id);
        if ($this->Material->delete($material)) {
            $this->Flash->success(__('Material deletado com sucesso'));
        } else {
            $this->Flash->error(__('material não pode ser deletado.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function isAuthorized($user)
    {
    if (isset($user['role']) && $user['role'] === 'Professor') {
        
    // Todos os usuários registrados podem adicionar artigos
        if ($this->request->getParam('action') === 'add') {
        return true;
        }
    }else{
        $this->Flash->error(__('Apenas professores podem cadastrar assuntos'));
    }

    //todos os usuários registrados podem ver artigos
        if ($this->request->getParam('action') === 'view') {
        return true;
        }
    // Apenas o proprietário do artigo pode editar e excluí
    if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
        $materialId = (int)$this->request->getParam('pass.0');
        if ($this->Material->isOwnedBy($materialId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
}

}
