<div id="objects">
		<h2><?php echo $v->get('article')->getTitle();  ?></h2>
		<p><small><?php echo $this->labels->get('field_category'); ?>:<?php echo $v->get('article')->getCategory()->getTitle(); ?></small></p>
		<p><small><?php echo $this->labels->get('field_date'); ?>:<?php echo $v->get('article')->getDate(); ?></small></p>
		
		<div class="image">
			<?php 	echo $v->get('article')->getImage();   ?>
		</div>
		<?php 	echo $v->get('article')->getDescription();   ?>
</div>