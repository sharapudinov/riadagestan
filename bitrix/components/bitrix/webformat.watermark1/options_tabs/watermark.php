<tr>
	<td><?=GetMessage($webformatLangPrefix.'WATERMARK_TYPE');?>:</td>
	<td>
		<input type="radio" name="webformat_watermark1[filter][type]" value="image" id="webformat_watermark1_type_image"<?php echo (($options['filter']['type'] == 'image') ? ' checked' : '');?> /><label for="webformat_watermark1_type_image"><?=GetMessage($webformatLangPrefix.'WATERMARK_TYPE_IMAGE');?></label><br />
		<input type="radio" name="webformat_watermark1[filter][type]" value="text" id="webformat_watermark1_type_text"<?php echo (($options['filter']['type'] == 'text') ? ' checked' : '');?> /><label for="webformat_watermark1_type_text"><?=GetMessage($webformatLangPrefix.'WATERMARK_TYPE_TEXT');?></label>
	</td>
</tr>

<tr>
	<td><?=GetMessage($webformatLangPrefix.'WATERMARK_POSITION');?>:</td>
	<td class="webformat_watermark1_position">
		<?=GetMessage($webformatLangPrefix.'WATERMARK_POSITION_VERTICAL');?>:&nbsp;
		<select name="webformat_watermark1[filter][position][vertical]" size="1">
			<option value="t"<?php echo ((substr($options['filter']['position'], 0, 1) == 't') ? ' selected' : '');?>><?=GetMessage($webformatLangPrefix.'WATERMARK_POSITION_VERTICAL_TOP');?></option>
			<option value="m"<?php echo ((substr($options['filter']['position'], 0, 1) == 'm') ? ' selected' : '');?>><?=GetMessage($webformatLangPrefix.'WATERMARK_POSITION_VERTICAL_MIDDLE');?></option>
			<option value="b"<?php echo ((substr($options['filter']['position'], 0, 1) == 'b') ? ' selected' : '');?>><?=GetMessage($webformatLangPrefix.'WATERMARK_POSITION_VERTICAL_BOTTOM');?></option>
		</select><br />
		<?=GetMessage($webformatLangPrefix.'WATERMARK_POSITION_HORIZONTAL');?>:&nbsp;
		<select name="webformat_watermark1[filter][position][horizontal]" size="1">
			<option value="l"<?php echo ((substr($options['filter']['position'], 1, 1) == 'l') ? ' selected' : '');?>><?=GetMessage($webformatLangPrefix.'WATERMARK_POSITION_HORIZONTAL_LEFT');?></option>
			<option value="c"<?php echo ((substr($options['filter']['position'], 1, 1) == 'c') ? ' selected' : '');?>><?=GetMessage($webformatLangPrefix.'WATERMARK_POSITION_HORIZONTAL_CENTER');?></option>
			<option value="r"<?php echo ((substr($options['filter']['position'], 1, 1) == 'r') ? ' selected' : '');?>><?=GetMessage($webformatLangPrefix.'WATERMARK_POSITION_HORIZONTAL_RIGHT');?></option>
		</select>
	</td>
</tr>
<tr>
	<td><?=GetMessage($webformatLangPrefix.'WATERMARK_SIZE');?>:</td>
	<td><input type="text" name="webformat_watermark1[filter][coefficient]" value="<?php echo (($options['filter']['type'] == 'image') ? ($options['filter']['coefficient'] * 100) : $options['filter']['coefficient']);?>" /><span class="coefficient-comment"><?=GetMessage($webformatLangPrefix.'WATERMARK_SIZE_COMMENT')?></span></td>
</tr>

<tbody class="webformat_watermark1_image">
	<tr>
		<td><?=GetMessage($webformatLangPrefix.'WATERMARK_IMAGE_FILE');?>:</td>
		<td>
			<input type="text" name="webformat_watermark1[filter][file]" value="<?echo ((bool)$options['filter']['file'] ? substr($options['filter']['file'], strlen(rtrim($_SERVER['DOCUMENT_ROOT'], '/'))) : '');?>" />
			<button name="webformat_watermark1_image_button">...</button>
		</td>
	</tr>
	<tr>
		<td><?=GetMessage($webformatLangPrefix.'WATERMARK_IMAGE_ALPHA');?>:</td>
		<td><input type="text" name="webformat_watermark1[filter][alpha_level]" value="<?=$options['filter']['alpha_level'];?>" />&nbsp;<?=GetMessage($webformatLangPrefix.'WATERMARK_IMAGE_ALPHA_DESC');?>.</td>
	</tr>
</tbody>


<tbody class="webformat_watermark1_text">
	<tr>
		<td><?=GetMessage($webformatLangPrefix.'WATERMARK_TEXT_CONTENT');?>:</td>
		<td><input type="text" name="webformat_watermark1[filter][text]" value="<?=$options['filter']['text'];?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage($webformatLangPrefix.'WATERMARK_TEXT_FILE');?>:</td>
		<td>
			<input type="text" name="webformat_watermark1[filter][font]" value="<?echo ((bool)$options['filter']['font'] ? substr($options['filter']['font'], strlen(rtrim($_SERVER['DOCUMENT_ROOT'], '/'))) : '');?>" />
			<button name="webformat_watermark1_text_button">...</button>
		</td>
	</tr>
	<tr>
		<td><?=GetMessage($webformatLangPrefix.'WATERMARK_TEXT_COLOR');?>:</td>
		<td><input type="text" name="webformat_watermark1[filter][color]" value="<?=$options['filter']['color'];?>" /></td>
	</tr>
</tbody>