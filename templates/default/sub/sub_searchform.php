<?php echo $this->formElementRenderer->getOpeningFormTagForForm($this->formModel, $this->linkCreator->getSimpleLink('')->noCache()); ?>
<table>
	<tr>
		<td>Only with pictures?</td>
		<td><?php echo $this->formElementRenderer->renderElement($this->formModel->getElementByName('withpicture')); ?></td>
		<td><?php echo $this->getValidationMessage($this->formModel->getElementByName('withpicture'),'wrong') ?></td>
	</tr>
	<tr><td>Search for</td>
		<td><?php echo $this->formElementRenderer->renderElement($this->formModel->getElementByName('sword')); ?></td>
		<td><?php  echo $this->getValidationMessage($this->formModel->getElementByName('sword'),'please enter correct sword') ?></td>
	</tr>
		<tr><td>Category</td>
		<td><?php echo $this->formElementRenderer->renderElement($this->formModel->getElementByName('category')); ?></td>
		<td></td>
	</tr>
</table>
<?php echo $this->formElementRenderer->renderMVCHiddenFields(); ?>
<?php echo $this->formElementRenderer->getSubmitButton(); ?>
<?php echo $this->formElementRenderer->getClosingForm(); ?>
