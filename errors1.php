<?php if(count($errors1) > 0): ?>
    <div class="error1">
        <?php foreach  ($errors1 as $i): ?>
            <p><?php echo $i; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>