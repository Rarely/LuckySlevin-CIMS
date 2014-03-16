
<?php
    echo $this->Html->script('search.js');
    echo $this->Html->css('jquery-selectable.css');
    echo $this->Html->css('search.css');
    echo $this->Html->script('jquery.mixitup.min.js');
?>


<div class="row">
    <div class="col-md-9">
        <div class="row search-well well">
                <div class="row">
                    <div class="row">
                        <h1>Search</h1>
                    </div>
                    <form id="search-form">
                        <div class="row">
                            <input id="search-query" type="text" class="form-control" placeholder="Search..." name="q" />
                            <div id='loading'>
                            </div>
                        </div>
                            <!--<div class="row form-group" >-->
                        <div class="row">
                            <div class="panel-group" id="accordion">
                              <div class="panel panel-default">
                                <div class="panel-heading">
                                  <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                      Advanced search options
                                    </a>
                                  </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                  <div class="panel-body">
                                    <div class="col-md-4">
                                        <input type="checkbox" name="name" checked> Name<br>
                                        <input type="checkbox" name="description" checked> Description<br>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="checkbox" name="community_partner"> Community Partner<br>
                                        <input type="checkbox" name="contact_name"> Conact Name<br>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="checkbox" name="contact_phone"> Contact Phone<br>
                                        <input type="checkbox" name="contact_email"> Contact Email<br>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" value="Search" class="btn btn-primary inline-block" id="submit-search" />
                            <?php if (isset($userData['role']) && $userData['role'] === 'admin') { ?>
                            <!-- EXPORT -->
                            <div id="btn-export" class="btn btn-success float-right inline-block">Export</div>
                            <!-- DELETE -->
                            <div id="btn-delete" class="btn btn-danger float-right inline-block">Delete</div>
                            <?php } ?>
                        </div>
                       <!-- </div>-->
                    </form>
                </div>
                <div class="row">
                    <div id="btn-cancel-csv" class="btn btn-default">Cancel</div>
                    <span id="export-help">Please click the title of the ideas you would like to export below</span>
                    <div id="btn-save-csv" class="btn btn-success">Save to File</div>

                    <div id="btn-cancel-delete" class="btn btn-default">Cancel</div>
                    <div id="btn-delete-confirm" class="btn btn-primary">Confirm</div>
                </div>
        </div>
        <div class="row" id="search-results">
            <?php if(count($ideas) < 1) { ?>
                <div class="ideacontainer well empty-list"><h1 class="text-center">There are no ideas matching your current search criteria</h1></div>
            <?php } else {
                echo $this->element('ideapage', array("ideas" => $ideas)); 
            } ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="well filter-well">
            <div class="row">
                <h1>Filters</h1>
            </div>
            <div class="row filter-controls">
            <!-- FILTER -->
                <div class="row category-row">
                    <input type='' class="user_filter" id='e18' placeholder='Owner' style='width:100%' data-id="user" />
                </div>
                <?php foreach ($categories as $category) { ?>
                    <div class="row category-row">
                      <input type='' class="cat" id='tags' name="data[Category][<?php echo $category['Category']['id']; ?>]" multiple="true"
                      <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
                      <?php echo 'placeholder="' . $category['Category']['name'] .'"' ?>
                       style='width:100%' />
                    </div>
                <?php } ?>
            </div>
            <div class="row">
                <h1>Sort</h1>
            </div>
             <div class="row sort-controls">
                <!-- SORTING -->
                <div class="row">
                     <select id="sort_by" id='tags' placeholder='Sort by' style='width:100%' class="sort">
                        <option value="default">Default</option>
                        <option value="data-name">Name</option>
                        <option value="data-community">Community Partner</option>
                        <option value="data-created">Idea created</option>
                        <option value="data-updated">Idea last Updated</option>
                        <option value="data-start">Project start date</option>
                        <option value="data-end">Project end date</option>
                    </select>
                </div>
                <div class="row">
                     <select id="sort_order" id='tags' placeholder='Order by' style='width:100%' class="sort">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>