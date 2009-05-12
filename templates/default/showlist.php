<div id="mvc-combinedlist">
	<div id="mvc-search">
		<?php
		echo $this->searchFormSubView->render();
		?>
	</div>
	
	<div id="mvc-pagination-list">
		<div id="mvcnews-pagination">
			<?php
			echo $this->pagination->render();		
			//echo $this->linkHelper->setLabel('test')->setClass('linkclass')->setDestination(1)->setAction('showSingle')->setParameter('singleid',12)->makeUrl();
		    
			?>
		</div>
		<p id="mvcnews-paginationtext">
			<?php printf($this->pi_getLL('','Displaying Page %d of %d / Items %d to %d of %d'),$this->pagination->currentPageNr,$this->pagination->pageCount,$this->pagination->currentItemsFrom,$this->pagination->currentItemsTo, $this->pagination->getCount()); ?>
		</p>
		<div id="mvcnews-list">
			<?php
			echo $this->listView->render();
			?>
		</div>
	</div>
</div>