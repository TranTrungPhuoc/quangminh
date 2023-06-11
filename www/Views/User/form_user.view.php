<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Thêm Thành Viên</h5>
            </div>
            <div class="card-body">
                <form action="" method="<?php echo $form['config']['method']?>">
                    <div class="row">

                        <?php foreach ($form['groups'] as $key => $value): ?>

                            <?php if($value['inputs']['type'] == "select"):?>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo $value['labels']['title']; ?></label>
                                        <select class="form-control" name="<?php echo $key; ?>">
                                            <option value>Chọn</option>
                                            <?php foreach ($value['inputs']['options'] as $option):?>
                                                <option><?= $option;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>

                            <?php else: ?>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <?php echo $value['labels']['title']; ?>
                                        </label>
                                        <input 
                                            type="<?php echo $value['inputs']['type']; ?>" 
                                            class="form-control" 
                                            name="<?php echo $key; ?>" 
                                            <?php echo $value['inputs']['required']; ?>
                                            placeholder="<?php echo $value['labels']['title']; ?>">
                                    </div>
                                </div>

                            <?php endif;?>

                        <?php endforeach; ?>

                    </div>
                    <button type="submit" class="btn btn-outline-primary has-ripple">
                        Lưu
                    </button>
                    <a href="/admin/user/<?php echo $form['config']['cancel']?>" class="btn btn-outline-secondary has-ripple">
                        Thoát
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>