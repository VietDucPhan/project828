<?php echo $this -> Form -> create('Skater', array('url' => array('controller' => 'skaters', 'action' => 'edit'), 'data-abide', 'method' => 'post')); ?>
        <?php echo $this -> Form -> input('firstname', array('label' => __('First name:'), 'required' => 'required', 'div' => false, 'title' => __('What is your first name?'))); ?>
        <?php echo $this -> Form -> input('middlename', array('label' => __('Middle name:'), 'required' => false, 'div' => false, 'title' => __('What is your middle name?'))); ?>
        <?php echo $this -> Form -> input('lastname', array('label' => __('Last name:'), 'required' => 'required', 'div' => false, 'title' => __('What is your last name?'))); ?>
        <?php echo $this -> Form -> input('nickname', array('label' => __('Nickname:'), 'div' => false, 'title' => __('What is your last name?'))); ?>
        <?php $options = array(__('Regular'), __('Goofy'));
        echo $this -> Form -> input('stance', array('options' => $options, 'default' => '', 'label' => __('Stance:'), 'required' => 'required', 'div' => false));?>
        <?php echo $this -> Form -> input('status', array('options' => $Status, 'default' => 3, 'label' => __('Status:'), 'required' => 'required', 'div' => false)); ?>
        <?php echo $this -> Form -> input('birthdate', array('label' => __('Birthdate:'), 'default'=>'null', 'required' => 'required', 'div' => false));?>
    <button>Submit</button> <a class="button reload">Cancel</a>
<?php echo $this -> Form -> end(); ?>