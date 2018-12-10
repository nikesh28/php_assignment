<div class="main">

    <div class="main-inner">

        <div class="container">

            <div class="row">

                <div class="span12">

                    <div class="widget ">

                        <div class="widget-header">
                            <i class="icon-th-list"></i>
                            <h3><a href="<?php echo $this->createUrl("customers/admin"); ?>">Manage Customers</a></h3>
                            <a class="btn btn-success" role="button" href="<?php echo $this->createUrl("customers/create"); ?>" style="float:right;margin: 5px;">Create Customer</a>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">
                            <?php
                            /* @var $this CustomerController */
                            /* @var $model Customer */

                            Yii::app()->clientScript->registerScript('search', "
                                $('.search-button').click(function(){
                                        $('.search-form').toggle();
                                        return false;
                                });
                                $('.search-form form').submit(function(){
                                        $('#customer-grid').yiiGridView('update', {
                                                data: $(this).serialize()
                                        });
                                        return false;
                                });
                                ");
                            ?>

                            <?php
                            $this->widget('zii.widgets.grid.CGridView', array(
                                'id' => 'customers-grid',
                                'dataProvider' => $model->search(),
                                'itemsCssClass' => 'table table-striped table-bordered',
                                'filter' => $model,
                                'columns' => array(
                                    'id',
                                    'name',
                                    array(
                                        'name' => 'country',
                                        'value' => '$data->ct->country_name'
                                    ),
                                    'email',
                                    'mobile_number',
                                    'about_you',
                                    /*
                                      'birthday',
                                     */
                                    array(
                                        'class' => 'CButtonColumn',
                                    ),
                                ),
                            ));
                            ?>
                        </div> <!-- /widget-content -->

                    </div> <!-- /widget -->

                </div> <!-- /span8 -->

            </div> <!-- /row -->

        </div> <!-- /container -->

    </div> <!-- /main-inner -->

</div> <!-- /main -->