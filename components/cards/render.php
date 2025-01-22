<div class="block is-cards container entrance">
	<div>
         <?php the_acf_non_empty_field( 'heading', '<h2>', '</h2>' ); ?>
		<div class="cards columns has-3">
			<?php
			while ( have_rows( 'items' ) ) {
				the_row();
				$attr_item = array(
					'class' => array(
						'card',
						empty( get_sub_field( 'image' ) ) ? 'has-no-image' : 'has-image',
					),
				);
				?>
				<div <?php the_attr( $attr_item ); ?>>
					<div class="header">
						<div class="image">
							<?php the_image( get_sub_field( 'image' ), get_field( 'size' ) ?? 'full', array(), 'img' ); ?>
						</div>						
						<?php
						if ( ! empty( get_sub_field( 'label_link' ) ) ) {
							?>
								<a href="<?php echo get_sub_field( 'label_link' ); ?>" class="label">
									<?php echo get_sub_field( 'label_text'); ?>
								</a>
							<?php
						}
						?>
					</div>
					<div class="main">
						<?php if ( ! empty( get_sub_field( 'title' ) ) ) { ?>
							<h3><?php the_sub_field( 'title' ); ?></h3>
						<?php } ?>
						<?php if ( ! empty( get_sub_field( 'text' ) ) ) { ?>
							<p><?php the_sub_field( 'text' ); ?></p>
						<?php } ?>
					</div>
				</div>
				<?php
			}
			?>
		</div>		
	</div>
</div>