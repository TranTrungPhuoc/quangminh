<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Bảng Dữ Liệu
                    <a href="/admin/user/insert" class="btn btn-sm btn-outline-primary has-ripple">
                        <i class="feather icon-plus"></i>
                        Thêm Mới
                    </a>
                </h5>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap text-center">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Date Inserted</th>
                                <th>Active</th>
                                <th>Function</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($table as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['firstname']; ?></td>
                                <td><?php echo $value['lastname']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['date_inserted']; ?></td>
                                <td><input type="checkbox"></td>
                                <td>
                                    <a href="/admin/user/update?id=<?php echo $value['id']; ?>" class="btn btn-sm btn-outline-info has-ripple">
                                        <i class="feather icon-edit"></i>
                                        Sửa
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger has-ripple">
                                        <i class="feather icon-trash"></i>
                                        Xóa
                                    </button>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Date Inserted</th>
                                <th>Active</th>
                                <th>Function</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>