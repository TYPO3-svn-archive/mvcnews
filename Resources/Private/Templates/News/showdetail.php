<div id="objects">
		<h2><?php echo $this->article->getTitle();  ?></h2>
		<p><small><?php echo $this->labels->get('field_category'); ?>:<?php echo $this->article->getCategory()->getTitle(); ?></small></p>
		<p><small><?php echo $this->labels->get('field_date'); ?>:<?php echo $this->article->getDate(); ?></small></p>
		
		<div class="image">
			<?php 	echo $this->article->getImage();   ?>
		</div>
		<?php 	echo $this->article->getDescription();   ?>
</div>