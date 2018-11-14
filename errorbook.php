<?php if(count($errorbook) > 0): ?>
    <div class="error_left">
        <?php foreach  ($errorbook as $i): ?>
            <p><?php echo $i; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>