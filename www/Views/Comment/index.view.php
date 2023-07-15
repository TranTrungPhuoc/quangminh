<?php
use App\Models\Comment;
$model = new Comment();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success alert-dismissible fade show" style="display:none;" role="alert"></div>
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap text-center">
                        <thead>
                            <tr>
                                <th>title</th>
                                <th>user</th>
                                <th>Date Inserted</th>
                                <th>Active</th>
                                <th>Function</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total=count($table); foreach ($table as $key => $value) { 
                                $checked = ($value['status']==1) ? 'checked' : '';
                                $user = $model->getDetail('esgi_User', $value['userid']);
                                $post = $model->getDetail('esgi_Post', $value['postid']);
                            ?>
                            <tr id="tr_<?php echo $value['id']; ?>">
                                <td><?php echo $value['title']; ?></td>
                                <td><?php echo ($user) ? '<span class="badge bg-success">'.$user[0]['firstname'].' '.$user[0]['lastname'].'</span>':''; ?></td>
                                <td><?php $date = explode(' ', $value['date_inserted']); echo $date[0]; ?></td>
                                <td><input type="checkbox" class="status_<?php echo $value['id']; ?>" onclick="script_status('<?php echo $value['id']; ?>')" <?php echo $checked; ?>></td>
                                <td>
                                    <a href="<?php echo '/'.trim($post[0]['slug'],' ').'.html'; ?>" target="_blank" class="btn btn-sm btn-outline-primary has-ripple">
                                        <i class="feather icon-eye"></i>
                                        View
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-info has-ripple" 
                                        data-bs-toggle="modal" data-bs-target="#popup_reply" onclick="getReply('<?php echo $value['id']; ?>','<?php echo trim($value['title'],' '); ?>','<?php echo trim($value['content'],' '); ?>','<?php echo trim($value['reply'],' '); ?>')">
                                        <i class="feather icon-edit"></i>
                                        Reply
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger has-ripple" 
                                        data-bs-toggle="modal" data-bs-target="#popup_delete" onclick="getName('<?php echo $value['id']; ?>','<?php echo $value['title']; ?>')">
                                        <i class="feather icon-trash"></i>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>