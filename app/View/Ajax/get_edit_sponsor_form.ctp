<div id="sponsor_containment">
  <?php foreach($SkaterSponsors as $SkaterSponsor): //print_r($SkaterSponsor); ?>
    <div class="row">
      <div class="large-9 medium-9 small-9 columns"><?php echo $SkaterSponsor['Company']['name'] ?></div>
      <div class="large-3 medium-3 small-3 columns"><span class="remove-sponsor button radius" data-href="<?php echo Router::url('/ajax/removeSponsor/'.$skaterid.'/'.$SkaterSponsor['Company']['id']); ?>"><?php echo __('delete'); ?></span></div>
    </div>
  <?php endforeach; ?>
</div>
<?php echo $this->element('forms/skater/edit_sponsors/default',array('skaterid'=>$skaterid)); ?>