<div class="wrap">
<?php if (!empty($tickers)) : ?>
<div id="message" class="updated notice">
<p><strong>Currently active ticker event:</strong>
<select name="active_ticker">
    <option value="null" selected>
        --No active event--
    </option>
<?php foreach ($tickers as $ticker) : ?>
    <option value="<?php echo $ticker->term_id; ?>">
        <?php echo $ticker->name; ?>
    </option>
<?php endforeach; ?>
</select>
</p>
</div>
<?php endif; ?>
</div>
