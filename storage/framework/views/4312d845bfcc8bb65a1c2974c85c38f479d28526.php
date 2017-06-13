<!-- resources/views/tasks/index.blade.php -->



<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(count($comments) > 0): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Current comment
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Заголовок таблицы -->
                    <thead>
                    <th>Comment</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    <?php foreach($comments as $comment): ?>
                        <tr>
                            <!-- Имя задачи -->
                            <td class="table-text">
                                <div><?php echo e($comment->text); ?></div>
                            </td>
                            <?php if(Auth::check()): ?>
                            <td>
                                <form action="<?php echo e(url('comment/'.$comment->id)); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <?php echo e(method_field('DELETE')); ?>


                                    <button type="submit" id="delete-comment-<?php echo e($comment->id); ?>" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
    <?php if(Auth::check()): ?>
    <div class="panel-body">
        <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <!-- Форма добавки коммента -->
        <form action="<?php echo e(url('comment')); ?>" method="POST" class="form-horizontal">
            <?php echo e(csrf_field()); ?>


                    <!-- Коммент -->
            <div class="form-group">
                <label for="comment" class="col-sm-3 control-label">Comment</label>

                <div class="col-sm-6">
                    <input type="text" name="text" id="text-name" class="form-control">
                </div>
            </div>

            <!-- Кнопка добавления коммента -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add comment
                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>