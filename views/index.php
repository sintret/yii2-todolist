<div class="box box-primary">
    <div class="box-header">
        <i class="ion ion-clipboard"></i>
        <h3 class="box-title">To Do List</h3>
        <div class="btn-group pull-right" data-toggle="btn-toggle" >
            <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <ul class="todo-list"></ul>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix no-border">
        <button class="btn btn-default pull-right todolist-additem" data-toggle="modal" data-target="#todolistModal"><i class="fa fa-plus"></i> Add item</button>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="todolistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">To Do List</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="todolistTitle" placeholder="Enter title to do list">
                    </div>                  
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary todolist-save" data-url="<?php echo $url;?>">Save changes</button>
            </div>
        </div>
    </div>
</div>