<div id="sidebar" class="sidebar-offcanvas">
    <div class="col-md-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
            $db_count           = 1;
            $accordion_count    = 1;
            foreach( $db_list as $db_name => $table_list )
            {
                $tmp =
                    '<div class="panel panel-default js-has-dbname" data-db="' . $db_name . '">
                        <div class="panel-heading" role="tab" id="heading' . $db_count .  '">
                            <h4 class="panel-title">
                                <a class="collapsed js-get-tables" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $db_count .  '" aria-expanded="false" aria-controls="collapse' . $db_count .  '">
                                    ' . $db_name . '
                                </a>
                            </h4>
                        </div>
                        <div id="collapse' . $db_count .  '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $db_count .  '">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>';

                ++$db_count;
                echo($tmp);
            }
            ?>
        </div>
    </div>
</div>