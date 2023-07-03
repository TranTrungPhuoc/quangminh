<div class="row">

    <?php
        $variable = [
            [ 
                'table' => 'Category', 'link' => 'category', 
                'total' => 100, 'open' => 10, 
                'running' => 5, 'solved' => 3,
                'color' => 'primary'
            ],
            [ 
                'table' => 'Post', 'link' => 'post', 
                'total' => 100, 'open' => 10, 
                'running' => 5, 'solved' => 3,
                'color' => 'success'
            ],
            [ 
                'table' => 'Menu', 'link' => 'menu', 
                'total' => 100, 'open' => 10, 
                'running' => 5, 'solved' => 3,
                'color' => 'warning'
            ],
            [ 
                'table' => 'User', 'link' => 'user', 
                'total' => 100, 'open' => 10, 
                'running' => 5, 'solved' => 3,
                'color' => 'danger'
            ],
        ];

        foreach ($variable as $key => $value) {
    ?>
    <style>.card-body p{color: gray;}</style>
    <div class="col-sm-4">
        <div class="card support-bar overflow-hidden">
            <a href="/admin/<?php echo $value['link']; ?>/index">
                <div class="card-body pb-0">
                    <h2 class="m-0">350</h2>
                    <span class="text-<?php echo $value['color']; ?>"><?php echo $value['table']; ?> Table</span>
                    <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                </div>
                <div class="card-footer bg-<?php echo $value['color']; ?> text-white">
                    <div class="row text-center">
                        <div class="col">
                            <h4 class="m-0 text-white"><?php echo $value['open']; ?></h4>
                            <span>Open</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white"><?php echo $value['running']; ?></h4>
                            <span>Running</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white"><?php echo $value['solved']; ?></h4>
                            <span>Solved</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php }?>
</div>