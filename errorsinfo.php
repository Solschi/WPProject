<?php if(count($errorinfo) > 0): ?>
    <div class="error">
        <?php foreach  ($errorinfo as $i): ?>
            <p><?php echo $i; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>