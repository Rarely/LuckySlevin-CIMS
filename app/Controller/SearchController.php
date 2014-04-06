<?php
class SearchController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Idea', 'IdeaValue');

    /*
     * Renders the search page
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: None
     * postconditions:  the search page will be rendered
    */
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


    /*
     * Performs the search
     * input:
        REST parameters: None
        Query Parameters: q: search query
     * preconditions: None
     * postconditions: The search results will be returned as html
    */
    public function result(){
        $this->layout = null;
        $q = $this->request->query['q'];

        if($q == null || $q == ''){
            $searchResult = $this->Idea->find('all', array(
                'conditions' => array('Idea.isdeleted' => 0),
                'recursive' => 2
            ));
        }else{

            $orCond = array();

            if(isset($this->request->query['name'])){
                $orCond['Idea.name LIKE'] = '%' . $q . '%';
            }
            if(isset($this->request->query['description'])){
                $orCond['Idea.description LIKE'] = '%' . $q . '%';
            }
            if(isset($this->request->query['community_partner'])){
                $orCond['Idea.community_partner LIKE'] = '%' . $q . '%';
            }
            if(isset($this->request->query['contact_name'])){
                $orCond['Idea.contact_name LIKE'] = '%' . $q . '%';
            }
            if(isset($this->request->query['contact_phone'])){
                $orCond['Idea.contact_phone LIKE'] = '%' . $q . '%';
            }
            if(isset($this->request->query['contact_email'])){
                $orCond['Idea.contact_email LIKE'] = '%' . $q . '%';
            }

            $cond = array(
                'Idea.isdeleted' => 0,
                'OR' => $orCond
                );
                
            $searchResult = $this->Idea->find('all',array('conditions' => $cond,
                'recursive' => 2));

        }
    
        $this->set('ideas', $searchResult);
        $this->set('emptymessage', 'No ideas match the search criteria');
        $this->render('/Elements/ideapage', 'ajax');
    }

    /*
     * Exports a list of ideas
     * input:
        REST parameters: None
        Query Parameters: idlist = list of idea ids
     * preconditions: ids are valid
     * postconditions:  creates 2 csv files given the ideas and zips them up.
                        sends the zip file to the user for downloading.
    */
    public function export($idlist = array()) {
        $idlist = explode(',', $this->request->query('ids'));
        $data = $this->Idea->find('all', array(
            'conditions' => array(
                "Idea.id" => $idlist
            )
        ));

        $values = $this->IdeaValue->find('all', array(
            'conditions' => array('ideaid' => $idlist),
            'fields' => 'Value.id, Value.name, Value.categoryid, Idea.id',
            'recursive'=>2
        ));

        //community partner information
        $csv1path = APP . "webroot/files/cims-cp.csv";
        $csv2path = APP . "webroot/files/cims-projectinfo.csv";
        $zippath = APP . "webroot/files/cims-export.zip";

        //Categories
        if(file_exists($csv1path)) unlink($csv1path);
        $file = fopen($csv1path, "w");
        $lines = array();

        fputcsv($file, array(
            'Community Partners'
            ,'Contact Name'
            ,'Contact Email'
        ));
        foreach($data as $i) {
            fputcsv($file, array(
                $i['Idea']['community_partner']
                ,$i['Idea']['contact_name']
                ,$i['Idea']['contact_email']
            ));
        }
        fclose($file);

        //Project Info
        if(file_exists($csv2path)) unlink($csv2path);
        $file = fopen($csv2path, "w");
        $lines = array();

        fputcsv($file, array(
            'ID'
            ,'Name'
            ,'Description'
            ,'Project Type'
            ,'Created'
            ,'Community Partner'
            ,'Contact Name'
            ,'Contact Email'
            ,'Contact Phone'
        ));
        foreach($data as $i) {
            //get project type
            foreach ($values as $value) {
                if ($value['Value']['categoryid'] == "1" && $value['Idea']['id'] == $i['Idea']['id']) {
                    $projectType = $value['Value']['name'];
                }
            }
            fputcsv($file, array( 
                $i['Idea']['id']
                ,$i['Idea']['name']
                ,$i['Idea']['description']
                ,$projectType
                ,$i['Idea']['created']
                ,$i['Idea']['community_partner']
                ,$i['Idea']['contact_name']
                ,$i['Idea']['contact_email']
                ,$i['Idea']['contact_phone']
            ));
        }
        fclose($file);

        //create zip of two files
        $files_to_zip = array(
            $csv1path,
            $csv2path
        );
        //if true, good; if false, zip creation failed
        $result = $this->create_zip($files_to_zip, $zippath, true);

        $this->viewClass = 'Media';
        // Download app/webroot/files/cims.csv
        $params = array(
            'id'        => 'cims-export.zip',
            'name'      => 'cims-export',
            'download'  => true,
            'extension' => 'zip',
            'path'      => APP . 'webroot/files' . DS
        );
        $this->set($params);
    }

    /* helper function to create a compressed zip file */
    function create_zip($files = array(),$destination = '',$overwrite = false) {
        //if the zip file already exists and overwrite is false, return false
        if(file_exists($destination) && !$overwrite) { return false; }
        //vars
        $valid_files = array();
        //if files were passed in...
        if(is_array($files)) {
            //cycle through each file
            foreach($files as $file) {
                //make sure the file exists
                if(file_exists($file)) {
                    $valid_files[] = $file;
                }
            }
        }
        //if we have good files...
        if(count($valid_files)) {
            //create the archive
            $zip = new ZipArchive();
            if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
                return false;
            }
            //add the files
            foreach($valid_files as $file) {
                $zip->addFile($file,basename($file));
            }
            $zip->close();
            //check to make sure the file exists
            return file_exists($destination);
        }
        else
        {
            return false;
        }
    }
}
?>
