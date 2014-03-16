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
                                            'Idea.name LIKE' => '%' . $q . '%',
                                            'Idea.isdeleted' => 0),
                                            'recursive' => 2
            )));
        } else {
            $this->set('query', '');
            $this->set('ideas', $this->Idea->find('all', array(
                'conditions' => array('Idea.isdeleted' => 0),
                'recursive' => 2
            )));
        }
    }



    public function result($q = null){
        $this->layout = null;

        if($q == null){
            $searchResult = $this->Idea->find('all', array(
                'conditions' => array('Idea.isdeleted' => 0),
                'recursive' => 2
            ));
        }else{
            $searchResult = $this->Idea->find('all',array('conditions' => array(
                'Idea.name LIKE' => '%' . $q . '%',
                'Idea.isdeleted' => 0),
                'recursive' => 2));
        }

        $htmlResponse =  '<h1>TEST</h1>';//$this->element('ideapage', array("ideas" => $searchResult));


        //$view = new View($this, false);
        //$html = $view->element('ideapage', array("ideas" => $searchResult)); 

        //$response = $this->render('ideapage', array("ideas" => $searchResult));
        //$content = $response->body(); 


        //$view = new View($this, false);
        //$view->set("ideas", $searchResult);
        //$view->viewPath = 'elements';

        /* Grab output into variable without the view actually outputting! */
//        $view_output = $view->render('ideapage');


//$html = $this->render('/elements/ideapage');//$view->render('result');



            $this->set('ideas', $searchResult);
            $this->layout = 'ajax';
            //$html = $this->render('/Elements/ideapage');


        $this->set('response', 'success');
        //$this->set('data', $html);
        $this->render('/Elements/ideapage');

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