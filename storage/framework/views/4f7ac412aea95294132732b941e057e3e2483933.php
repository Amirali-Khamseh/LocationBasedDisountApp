
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
      <th scope="col">Name</th>
      <th scope="col">Family name </th>
      <th scope="col">Role </th>
      <th scope="col">Mobile number</th>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
      <th>Delete</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>
<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($user->name); ?></td>
      <td><?php echo e($user->family); ?></td>
      <td><span class="badge badge-success"><?php echo e(isset($user->role) ? $user->role->title : 'no Role'); ?></span></td>
      <td><?php echo e($user->mobile); ?></td>
      <td><?php echo e($user->email); ?></td>
      <?php if($user->status==1): ?>
          <td>Active✔ </td>
      <?php else: ?>
          <td>Passive✖</td>
     <?php endif; ?>
     <!-- sending the id of the user to the delete route -->
     <td>
       <form action="<?php echo e(route('users.destroy',['user'=> $user->id])); ?>" method="post">
         <?php echo method_field('Delete'); ?>
         <?php echo csrf_field(); ?>
          <button class="btn btn-danger" type="submit">Delete</button>
      </form>
    </td>
     <!-- sending the id of the user to the edit route -->
     <td><a class="btn btn-warning" href="<?php echo e(route('users.edit',['user'=> $user->id])); ?>">Edit</a></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </tbody>
</table>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/panel/users/index.blade.php ENDPATH**/ ?>