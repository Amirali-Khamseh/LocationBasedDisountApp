
<?php $__env->startSection('title', "Product's comments"); ?>
<?php $__env->startSection('content'); ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Comments </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
     <th scope="col">Description</th>
      <th scope="col">Raiting</th>
      <th scope="col">Status</th>
      

    </tr>
  </thead>
  <tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($item->id); ?></td>
      <td><?php echo e($item->user->name .' '.$item->user->family); ?></td>
      <td><?php echo e(strlen($item->description)>20 ? substr($item->description , 0,20)."...." : $item->description); ?> </td>
 
      <td><?php echo e($item->rating); ?></td>
      
    
      <?php if($item->status==1): ?>
          <td><a href="<?php echo e(route('active',['id'=> $item->id])); ?>">Active✔</a> </td>
      <?php else: ?>
          <td><a href="<?php echo e(route('active',['id'=> $item->id])); ?>">Passive✖</a></td>
     <?php endif; ?>
     <!-- sending the id of the user to the delete route -->
     <td>

    </td>
     <!-- sending the id of the user to the edit route -->
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </tbody>
</table>
</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/panel/products/comments.blade.php ENDPATH**/ ?>