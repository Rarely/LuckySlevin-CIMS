<?php
class SearchController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Idea');

    public function index($q = null) {
        $this->set('title_for_layout', 'Search');

        if ($this->request['data']) {
            $q = $this->request['data']['Search']['q'];
            $this->set('query', $q);
            $this->set('ideas', $results = $this->Idea->find('all',
                                    array('conditions' => array(
                                            'Idea.name LIKE' => '%' . $q . '%')
            )));
        } else {
            $this->set('query', '');
            $this->set('ideas', $this->Idea->find('all'));
        }
    }

    public function export($idlist = array()) {
        $idlist = explode(',', $this->request->query('ids'));
        $data = $this->Idea->find('all', array(
            'conditions' => array(
                "Idea.id" => $idlist
            )
        ));
        $filepath = APP . "webroot/files/cims.csv";

        if(file_exists($filepath)) unlink($filepath);
        $file = fopen($filepath, "w");
        $lines = array();
        foreach($data as $i) {
            //TODO: CBEL ONLINE FORMAT
            fputcsv($file, array( 
                $i['Idea']['id']
                ,$i['Idea']['name']
                ,$i['Idea']['description']
                ,$i['Idea']['created']
            ));
        }
        fclose($file);

        $this->viewClass = 'Media';
        // Download app/webroot/files/cims.csv
        $params = array(
            'id'        => 'cims.csv',
            'name'      => 'cims',
            'download'  => true,
            'extension' => 'csv',
            'path'      => APP . 'webroot/files' . DS
        );
        $this->set($params);
    }
}