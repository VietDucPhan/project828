<div data-alert="" class="alert-box <?php echo $class; ?>">
  <?php if(is_array($message)): ?>
    <ul>
    <?php foreach($message as $key => $val): ?>
      <li><?php echo $key; ?>:
        <ol>
      <?php foreach($val as $k => $v): ?>
        <li>
        <?php echo $v; ?>
        </li>
      <?php endforeach; ?>
        </ol>
      </li>
    <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <?php echo $message; ?>
  <?php endif; ?>
  <a href="#" class="close">×</a>
</div>