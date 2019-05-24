<?php
include "head.php";
$uid=$_SESSION['uid'];
echo "<input type='hidden' id='cu_id' value='$uid' />";
?>
<script>
    $(document).ready(function() {
        load_data();
    });

    function load_data() {
        var uid=$("#cu_id").val();
        var url="get_data.php?req=tbl_category&cu_id="+uid;
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                $("#tbl_category").html(data);
            }
        })
    }

    function edit(cat_id) {
        console.log(cat_id);

        // hide controls
        $("#" + cat_id).fadeOut(500);
        $("#d_" + cat_id.substr(2)).fadeOut(500);

        // enable editing
        var text = "t" + cat_id.substr(1);
        $("#" + text).prop("disabled", false);

        var c_data = "<button type='button' id='" + cat_id + "' onclick='save(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button> <button type='button' id='' onclick='load_data();' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
        $("#controls_" + cat_id.substr(2)).html(c_data);
    }

    function del(cat_id) {
        console.log(cat_id);

        // hide controls
        $("#e_" + cat_id.substr(2)).fadeOut(500);
        $("#" + cat_id).fadeOut(500);

        var c_data = "<b style='color:red; text-transform:uppercase;'>Confirm delete?</b><br><button type='button' id='" + cat_id + "' onclick='del2(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button> <button type='button' id='' onclick='load_data();' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
        $("#controls_" + cat_id.substr(2)).html(c_data);
    }

    function save(cat_id) {
        console.log($("#t_" + cat_id.substr(2)).val());
        var v = $("#t_" + cat_id.substr(2)).val();
        if (v == "") {
            alert("Please give some value!");
            return false;
        }
        var id = cat_id.substr(2);
        var url = "upd_del.php?op=cat_upd&v=" + v + "&cat_id=" + id;
        // console.log(url);
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                load_data();
            }
        })
    }

    function del2(cat_id) {
        console.log("DEL:" + cat_id.substr(2));
        var id = cat_id.substr(2);

        $.ajax({
            type: "GET",
            url: "upd_del.php?op=cat_del&cat_id=" + id,
            success: function(data) {
                load_data();
            }
        })
    }
</script>
<?php
if (isset($_REQUEST['add_cat'])) {
    $cat = $_REQUEST['cat'];
    $c1 = "select * from category where category='$cat'";
    $e1 = $conn->query($c1);
    if ($e1->num_rows == 0) {
        $q1 = "insert into category (category,added_by) value ('$cat','$uid')";
        $e1 = $conn->query($q1);
    } else {
        echo "<script>alert('\'" . $cat . "\' is already added!')</script>";
    }
}

?>
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto">
                <form method="post" class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="cat" placeholder="Book" autofocus required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <!-- <a href="javascript:void(0)" class="btn btn-link">Cancel</a> -->
                            <input type="reset" class="btn btn-secondary" value="Cancel" />
                            <input type="submit" class="btn btn-primary ml-auto" name="add_cat" value="Add Category">
                            <!-- <button type="submit" class="btn btn-green btn-sm" name="add_cat" value="1"><i class="fe fe-edit-3"></i></button> -->
                        </div>
                    </div>
                </form>
                <script>
                    require(['jquery', 'selectize'], function($, selectize) {
                        $(document).ready(function() {
                            $('#input-tags').selectize({
                                delimiter: ',',
                                persist: false,
                                create: function(input) {
                                    return {
                                        value: input,
                                        text: input
                                    }
                                }
                            });

                            $('#select-beast').selectize({});

                            $('#select-users').selectize({
                                render: {
                                    option: function(data, escape) {
                                        return '<div>' +
                                            '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                            '<span class="title">' + escape(data.text) + '</span>' +
                                            '</div>';
                                    },
                                    item: function(data, escape) {
                                        return '<div>' +
                                            '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                            escape(data.text) +
                                            '</div>';
                                    }
                                }
                            });

                            $('#select-countries').selectize({
                                render: {
                                    option: function(data, escape) {
                                        return '<div>' +
                                            '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                            '<span class="title">' + escape(data.text) + '</span>' +
                                            '</div>';
                                    },
                                    item: function(data, escape) {
                                        return '<div>' +
                                            '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                                            escape(data.text) +
                                            '</div>';
                                    }
                                }
                            });
                        });
                    });
                </script>
            </div>
            <div class="col-8 mx-auto">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Category</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="tbl_category">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<?php
include "foot.php";
?> 