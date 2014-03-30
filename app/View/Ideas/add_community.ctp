<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="mobile-web-app-capable" content="yes" />
<link rel="apple-touch-icon" href="img/appicon.png"/>
<link rel="shortcut icon" sizes="120x120" href="img/appicon.png" />
<link rel="shortcut icon" href="img/appicon.png" type="image/x-icon">

<div class="row" id="ubc-logo">
    <div class="col-sm-12">
        <img src="/img/ubclogo.png" class="img-responsive">
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <?php
        echo $this->Html->script('jquery-1.11.0.min.js');
        echo $this->Html->css('bootstrap.css');
        echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->css('login.css');
        echo $this->Html->css('idea.css');
        echo $this->Html->css('style.css');
        ?>
        <?php echo $this->Html->script('editidea.js'); ?>
        
        <?php echo $this->Form->create('Idea', array(
            'inputDefaults' => array(
                'div' => 'form-group',
                'wrapInput' => false,
                'class' => 'form-control'
                ),
            'class' => 'well'
            )); ?>
        <div class="text-center">
            <h1> Center for Community Engaged Learning</h1>
            <h3> Got an idea? Tell us! </h3>
        </div>
            <fieldset>
                <?php echo $this->Form->input('contact_name', array(
                    'label' => 'Contact Name',
                    'placeholder' => 'Contact Name',
                    'required' => true
                    )); ?>

                <?php echo $this->Form->input('contact_email', array(
                    'label' => 'Contact Email',
                    'placeholder' => 'Contact Email',
                    'required' => true
                    )); ?>
                <?php echo $this->Form->input('contact_phone', array(
                    'label' => 'Contact Phone',
                    'placeholder' => 'Contact Phone'
                    )); ?>

                <?php echo $this->Form->input('description', array(
                    'label' => 'Description (max 1000)',
                    'placeholder' => 'Insert a description here',
                    'maxlength'   => '1000',
                    'required' => true
                    )); ?>

                <?php echo $this->Form->submit('Submit', array(
                    'div' => 'form-group',
                    'class' => 'btn btn-primary'
                    )); ?>
                </fieldset>
                <?php echo $this->Form->end(); ?>
        
    </div>
    <div style="margin-top:470px; background-color:white;">
        T: 604.822.1678<br>
        F: 604.822.2457<br>
        community.learning@ubc.ca<br>
        Wesbrook Building<br>
        Room 300, 6174 University Boulevard <br>
        Vancouver,  V6T 1Z3<br>
    </div>

</div>