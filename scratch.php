<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">With additional fullscreen button</h3>
            <div class="card-options">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                <!-- <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
            </div>
        </div>
        <div class="card-body">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima neque pariatur perferendis sed suscipit velit vitae voluptatem. A consequuntur, deserunt eaque error nulla temporibus!
        </div>
    </div>
</div>


<label class="form-label">Select Category</label>
<select name="beast" id="select-category" class="form-control custom-select" required>
    <?php
        $qc="select * from category";
        $ec=$conn->query($qc);
        if($ec->num_rows > 0){
            while($r=$ec->fetch_object()){
                echo "<option value='$r->cat_id'>$r->category</option>";
            }
        }
    ?>
</select>



<div class="col-lg-8">
    <form class="card">
        <div class="card-body">
            <h3 class="card-title">Edit Profile</h3>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc.">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" placeholder="Username" value="michael23">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>