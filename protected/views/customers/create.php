<div class="main">

    <div class="main-inner">

        <div class="container">

            <div class="row">

                <div class="span12">

                    <div class="widget ">

                        <div class="widget-header">
                            <i class="icon-user"></i>
                            <h3>Create Customer</h3>                            
                            <a class="btn btn-success" role="button" href="<?php echo $this->createUrl("customers/admin"); ?>" style="float:right;margin: 5px;">View Customers</a>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

                            </div> <!-- /widget-content -->

                    </div> <!-- /widget -->

                </div> <!-- /span8 -->

            </div> <!-- /row -->

        </div> <!-- /container -->

    </div> <!-- /main-inner -->

</div> <!-- /main -->