<div class="wrap">
<?php if (!empty($tickers)) : ?>
<h3>Currently active ticker
<select name="active_ticker">
<?php foreach ($tickers as $ticker) : ?>
    <option value="<?php echo $ticker->term_id; ?>">
        <?php echo $ticker->name; ?>
    </option>
<?php endforeach; ?>
</select>
</h3>
<?php endif; ?>
</div>
