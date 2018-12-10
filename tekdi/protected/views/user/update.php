<div class="main">

    <div class="main-inner">

        <div class="container">

            <div class="row">

                <div class="span12">

                    <div class="widget ">
                        <?php if($success){ ?>
                        <div class="alert alert-success">
                          <button data-dismiss="alert" class="close" type="button">×</button>
                          <strong>Success!</strong> Profile has been successfully Updated.
                        </div>
                        <?php } ?>
                        <div class="widget-header">
                            <i class="icon-user"></i>
                            <h3>Update Profile</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">

                            <?php $this->renderPartial('_form', array('model' => $model)); ?>


                        </div> <!-- /widget-content -->

                    </div> <!-- /widget -->

                </div> <!-- /span8 -->

            </div> <!-- /row -->

        </div> <!-- /container -->

    </div> <!-- /main-inner -->

</div> <!-- /main -->