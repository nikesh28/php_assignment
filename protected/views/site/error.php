<div class="container">

	<div class="row">

		<div class="span12">

			<div class="error-container">
				<h1>Error <?php echo $code; ?></h1>

				<h2>Who! bad search man. No more proxy for you.</h2>

				<div class="error-details">
					<?php echo CHtml::encode($message); ?>

				</div> <!-- /error-details -->

				<div class="error-actions">
					<a href="<?php echo $this->createUrl("site/dashboard"); ?>" class="btn btn-large btn-primary">
						<i class="icon-chevron-left"></i>
						&nbsp;
						Back to Dashboard
					</a>



				</div> <!-- /error-actions -->

			</div> <!-- /error-container -->

		</div> <!-- /span12 -->

	</div> <!-- /row -->

</div> <!-- /container -->