<?php
if(count($this->data['agreement_arr']) > 0){?>
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
<p class="float">
<label for="agreement_n">Agreement Number
<? if ($this->data['attrs']['required']): ?>
            <rn:block id="preRequired"/>
                <?= $this->render('Partials.Forms.RequiredLabel') ?>
            <rn:block id="postRequired"/>
        <? endif; ?>
</label>
<div>

	<select id="rn_<?= $this->instanceID ?>_<?= $this->data['attrs']['name'] ?>" class="rn_BasicSelection setp" name="formData[<?= $this->data['attrs']['name'] ?>]" required="true">
	<option value="" >--Please Select --</option>
			<rn:block id="inputTop"/>

	<?php
	//print_r($this->data['agreement_arr']);
	foreach($this->data['agreement_arr'] as $key => $response){?>
					<option value="<?= $response['Loan_ID'] ?>_<?= $response['Agreement No'] ?>"><?= $response['Agreement No'] ?></option>
	<?php
	}
	?>
			<rn:block id="inputBottom"/>

	</select>

</div>
</p>
</div>
<?php } ?>