
<?php $__env->startSection('title', 'List of Users'); ?>
<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of users </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Parent</th>
      <th scope="col">Status</th>
      <th>Delete</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($item->title); ?></td>
      <?php if(isset($item->parent)): ?>
      <td><span class="badge badge-success"><?php echo e($item->parent->title); ?></span></td>
      <?php else: ?>
      <td><span class="badge badge-danger">it's Parent</span></td>
      <?php endif; ?>
      <?php if($item->status==1): ?>
          <td>Active✔ </td>
      <?php else: ?>
          <td>Passive✖</td>
     <?php endif; ?>
     <!-- sending the id of the user to the delete route -->
     <td>
       <form action="<?php echo e(route('categories.destroy',['category'=> $item->id])); ?>" method="post">
         <?php echo method_field('Delete'); ?>
         <?php echo csrf_field(); ?>
          <button class="btn btn-danger" type="submit">Delete</button>
      </form>
    </td>
     <!-- sending the id of the user to the edit route -->
     <td><a class="btn btn-warning" href="<?php echo e(route('categories.edit',['category'=> $item->id])); ?>">Edit</a></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </tbody>
</table>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/panel/categories/index.blade.php ENDPATH**/ ?>