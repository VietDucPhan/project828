<div class="fixed backgroundColor">
  <div class="row">
    <div class="large-centered">
      <nav class="top-bar" data-topbar>
        <ul class="title-area">
          <li class="name">
            <h1><a href="<?php echo $this->webroot; ?>">Friendsthatclick</a></h1>
          </li>
          <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
          <li class="toggle-topbar menu-icon">
            <a href="#"><span></span></a>
          </li>
        </ul>

        <section class="top-bar-section">

          <!-- Left Nav Section -->
          <ul class="left">
            <li class="divider "></li>
            <li class="has-form">
              <div class="row">
                <div class="large-12 small-12 columns">
                  <input class="radius" type="text" placeholder="Find Stuff">
                </div>
              </div>
            </li>
          </ul>
          <!-- Right Nav Section -->
          <?php echo $this->element('mainNav/mainNav_not_signin'); ?>
        </section>
      </nav>
    </div>
  </div>
</div>