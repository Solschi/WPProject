<?php if(count($errormanga) > 0): ?>
    <div class="error_right">
        <?php foreach  ($errormanga as $i): ?>
            <p><?php echo $i; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>