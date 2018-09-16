<tr>
	<td><?=GetMessage($webformatLangPrefix.'IBLOCKS');?>:</td>
	<td>
		<select name="webformat_watermark1[iblocks][]" size="10" multiple required>
			<option value="-1"<?php echo (in_array('-1', $options['iblocks']) ? ' selected' : '');?>><?=GetMessage($webformatLangPrefix.'SELECT_NONE');?></option>
			<option value="0"<?php echo ((bool)$options['iblocks'] ? '' : ' selected');?>><?=GetMessage($webformatLangPrefix.'SELECT_ALL');?></option>
			<?php
			//Get iblock list
				if(!CModule::IncludeModule('iblock')){ShowError(GetMessage($webformatLangPrefix.'MODULE_IBLOCK_NOT_FOUND')); return;}
				$rsIBlock = CIBlock::GetList(array('name' => 'asc'), array('ACTIVE' => 'Y'), false);
				while($iblock = $rsIBlock->Fetch()){
					echo ('<option value="'.$iblock['ID'].'"'.(in_array($iblock['ID'], $options['iblocks']) ? ' selected' : '').'>'.$iblock['NAME'].'</option>');
				}
			//---End---Get iblock list
			?>
		</select>
	</td>
</tr>
<tr>
	<td><?=GetMessage($webformatLangPrefix.'PROPS_STANDART');?>:</td>
	<td>
		<?php
			$standartProps = array('DETAIL_PICTURE', 'PREVIEW_PICTURE', 'MORE_PHOTO');
		?>
		<select name="webformat_watermark1[props_standart][]" size="3" multiple>
			<?php
				foreach($standartProps as $propCode){
					echo ('<option value="'.$propCode.'"'.(in_array($propCode, $options['props']) ? ' selected' : '').'>'.GetMessage($webformatLangPrefix.'PROP_'.$propCode).'</option>');
					if(in_array($propCode, $options['props'])){
						foreach($options['props'] as $index => $propCode2){
							if($propCode2 == $propCode){unset($options['props'][$index]); break;}
						}
					}
				}
			?>
		</select>
	</td>
</tr>
<tr>
	<td><?=GetMessage($webformatLangPrefix.'PROPS_EXTRA');?>:</td>
	<td>
		<textarea name="webformat_watermark1[props_extra]" wrap="soft"><?=implode("\n", $options['props']);?></textarea>
	</td>
</tr>