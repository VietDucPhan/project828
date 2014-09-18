<div class="large-12 medium-12 small-12">
  <div class="large-12 medium-12 small-12 row collapse">
    <div class="large-3 medium-3 small-3 columns">
      <span class="prefix"><?php echo __('Search company') ?></span>
    </div>
    <div class="large-9 medium-9 small-9 columns">
      <input id="getCompanies-search-input" data-id='<?php echo $skaterid; ?>' class="ajax-reactivate ajax-search-data" type="text" placeholder="<?php echo __('Enter company name') ?>" data-dropdown="getCompanies" aria-controls="search-company" aria-expanded="false" />
      <ul id="getCompanies" class="f-dropdown searchPanel" data-dropdown-content aria-hidden="true" tabindex="-1"></ul>
    </div>
  </div>
</div>
<div class="large-12 medium-12 small-12">
<a class="button reload">Cancel</a>
</div>