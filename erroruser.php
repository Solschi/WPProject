<?php if(count($erroruser) > 0): ?>
    <div class="error_center">
        <?php foreach  ($erroruser as $i): ?>
            <p><?php echo $i; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>