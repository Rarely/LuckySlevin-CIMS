<!--Search Page -->
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
                                <!--<div class="col-md-1">
                                    <div id="btn-reset-search" class="reset-btn margin-right-5 btn inline-block"></div>
                                </div>-->
                                    <input id="search-query" type="text" class="form-control" placeholder="Search..." name="q" maxlength ='150' />
                                        <div id="btn-reset-search" class="btn">Clear results</div>
                                    <div id='loading'></div>
                            <div class="row">
                                <div class="panel-group" id="accordion">
                                    <div class="panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                              Advanced search options <span class="caret"></span>
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse">
                                            <div class="panel-body" style="background-color:white;">
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
</div>
<div class="row">

                                <input type="submit" value="Search" class="btn btn-primary inline-block" id="submit-search" />
                            <?php if (isset($userData['role']) && $userData['role'] === 'admin') { ?>
                                    <!-- EXPORT -->
                                    <div id="btn-export" class="btn btn-success inline-block idea-management">Export</div>
                                    <!-- DELETE -->                                    
                                    <div id="btn-delete" class="btn btn-danger inline-block idea-management">Delete</div>
                            <?php } ?>
                        </div>
                    <div class="row margin-left-auto">
                        <div class="row">
                            <span id="export-help">Please click the title of the ideas you would like to <strong>export</strong> below</span>
                            <span id="delete-help">Please click the title of the ideas you would like to <strong>delete</strong> below</span>
                        </div>
                        <div class="row">
                            <div id="btn-cancel-csv" class="btn btn-default">Cancel</div>
                            <div id="btn-save-csv" class="btn btn-success">Save to File</div>
                        
                            <div id="btn-cancel-delete" class="btn btn-default">Cancel</div>
                            <div id="btn-delete-confirm" class="btn btn-primary">Confirm</div>
                        </div>
                    </div>
                </form>
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
                <div class="inline-block"><h1>Filters</h1></div>
                <div id="btn-reset-filters" class="reset-btn btn inline-block idea-management"></div>
            </div>
            <div id="filter-controls" class="row">
            <!-- FILTER -->
                <div class="row category-row">
                    <input class="user_filter" id='e18' placeholder='Owner' style='width:100%' data-id="user" />
                </div>
                <?php foreach ($categories as $category) { ?>
                    <div class="row category-row">
                      <input class="cat" name="data[Category][<?php echo $category['Category']['id']; ?>]" data-specifiable="true" data-multiple="true"
                      <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
                      <?php echo 'placeholder="' . h($category['Category']['name']) .'"' ?>
                       style='width:100%' />
                    </div>
                <?php } ?>
            </div>
            <div class="row">
                <h1>Sort by</h1>
            </div>
             <div class="row sort-controls">
                <!-- SORTING -->
                <div class="row">
                     <select id="sort_by" style='width:100%' class="sort">
                        <option value="default">Unsorted</option>
                        <option value="data-name">Name</option>
                        <option value="data-community">Community Partner</option>
                        <option value="data-created">Idea created</option>
                        <option value="data-updated">Idea last updated</option>
                        <option value="data-start">Project start date</option>
                        <option value="data-end">Project end date</option>
                    </select>
                </div>
                <div class="row">
                     <select id="sort_order" style='width:100%' class="sort">
                        <option value="desc">Ascending</option>
                        <option value="asc">Descending</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>