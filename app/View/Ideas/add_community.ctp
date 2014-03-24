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
        ?>
        <?php echo $this->Html->script('editidea.js'); ?>

        <h1> Center for Community Engaged Learning</h1>
        <h2> Got an idea? Tell us! </h2>
        <?php echo $this->Form->create('Idea', array(
            'inputDefaults' => array(
                'div' => 'form-group',
                'wrapInput' => false,
                'class' => 'form-control'
                ),
            'class' => 'well'
            )); ?>

            <fieldset>
                <?php echo $this->Form->input('contact_name', array(
                    'label' => 'Contact Name',
                    'placeholder' => 'Contact Name',
                    'rows'=>1,
                    'required' => true
                    )); ?>

                <?php echo $this->Form->input('contact_email', array(
                    'label' => 'Contact Email',
                    'placeholder' => 'Contact Email',
                    'rows'=>1,
                    'required' => true
                    )); ?>
                <?php echo $this->Form->input('contact_phone', array(
                    'label' => 'Contact Phone',
                    'placeholder' => 'Contact Phone',
                    'rows'=>1
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
        <div>
            T: 604.822.1678<br>
            F: 604.822.2457<br>
            community.learning@ubc.ca<br>
            Wesbrook Building<br>
            Room 300, 6174 University Boulevard <br>
            Vancouver,  V6T 1Z3<br>
        </div>
    </div>
   

</div>