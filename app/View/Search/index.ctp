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
                <h1>Search</h1>
            </div>
            <form id="search-form">
                <div class="row">
                    <div class="input-group margin-right-neg-25">
                        <input id="search-query" type="text" class="form-control" placeholder="Search..." name="q" maxlength ='150' />
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-search" type="submit" data-toggle="tooltip" title="Search"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                        <div class="input-group-btn">
                            <span id="btn-reset-search" class="btn clear-btn" data-toggle="tooltip" title="Reset search results"></span>
                        </div>
                    </div>
                    <div class="panel-group" id="accordion">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                              Advanced search options <span class="caret"></span>
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
                                    <input type="checkbox" name="contact_name"> Contact Name<br>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" name="contact_phone"> Contact Phone<br>
                                    <input type="checkbox" name="contact_email"> Contact Email<br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if (isset($userData['role']) && $userData['role'] === 'admin') { ?>
                            <!-- EXPORT -->
                            <div id="btn-export" class="btn btn-success inline-block idea-management">Export</div>
                            <!-- DELETE -->                                    
                            <div id="btn-delete" class="btn btn-danger inline-block idea-management">Delete</div>
                    <?php } ?>
                </div>
                <div class="row margin-left-auto">
                    <div class="row">
                        <span id="export-help" class="help-text">Please click the title of the ideas you would like to <strong style="color:#2f7c4e;">export</strong> below</span>
                        <span id="delete-help" class="help-text">Please click the title of the ideas you would like to <strong style="color:#7c2f37;">delete</strong> below</span>
                    </div>
                    <div class="row">
                        <div id="btn-cancel-csv" class="btn btn-default btn-hidden">Cancel</div>
                        <div id="btn-save-csv" class="btn btn-success btn-hidden">Save to File</div>
                    
                        <div id="btn-cancel-delete" class="btn btn-default btn-hidden">Cancel</div>
                        <div id="btn-delete-confirm" class="btn btn-primary btn-hidden">Confirm</div>
                    </div>
                </div>
            </form>
        </div>
       
        <div class="row" id="search-results">
            <?php echo $this->element('ideapage', array("ideas" => $ideas,
                                        "emptymessage" => "No ideas match the search criteria")); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="well filter-well">
            <div class="row">
                <div class="inline-block"><h1>Filters</h1></div>
                <div id="btn-reset-filters" class="clear-btn btn inline-block idea-management" data-toggle="tooltip" title="Reset filter results"></div>
            </div>
            <div id="filter-controls" class="controls">
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