
<?php $__env->startSection('title', 'List of Products'); ?>
<?php $__env->startSection('css'); ?>
<style>
  .img{
    width: 50px;
    height: 50px;
    border-radius: 50%;
  }
</style>
<?php $__env->stopSection(); ?>
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
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Discounted</th>
      <th scope="col">Owner</th>
      <th scope="col" class="text-center">Category</th>
      <th scope="col">Status</th>
      <th>Setting</th>
    </tr>
  </thead>
  <tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($item->id); ?></td>
      <td><a href="<?php echo e(isset($item->image) ? route('image-show') . '?image=' . $item->image->path : asset('/images/no-img.jpg')); ?>" target="_blank"><img src="<?php echo e(isset($item->image) ? route('image-show') . '?image=' . $item->image->path : asset('/images/no-img.jpg')); ?>" class="img" alt=""></a></td>
      <td><?php echo e($item->title); ?></td>
      <td><?php echo e($item->price); ?> HUF <?php if($item->discount_percent > 0): ?> <span class="badge badge-danger">%<?php echo e($item->discount_percent); ?></span> <?php endif; ?></td>
      <td><?php echo e($item->price - ($item->price * ($item->discount_percent/100))); ?> HUF</td>
      <td><?php echo e($item->owner->shop_name); ?></td>
      <td class="text-center"><span class="badge badge-success" style="font-size: 15px;font-weight:bold"><?php echo e($item->category->parent->title); ?> - <?php echo e($item->category->title); ?></span></td>
      <!-- <?php if(isset($item->parent)): ?>
      <td><span class="badge badge-success"><?php echo e($item->parent->title); ?></span></td>
      <?php else: ?>
      <td><span class="badge badge-danger">it's Parent</span></td>
      <?php endif; ?> -->
      <?php if($item->status==1): ?>
          <td>Active✔ </td>
      <?php else: ?>
          <td>Passive✖</td>
     <?php endif; ?>
     <!-- sending the id of the user to the delete route -->
     <td>
     <div class="btn-group">
        <a class="btn btn-success" href="<?php echo e(route('products.edit',['product'=> $item->id])); ?>">Edit</a>
        <button type="button" class="btn btn-success dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
          <form action="<?php echo e(route('products.destroy',['product'=> $item->id])); ?>" method="post">
            <?php echo method_field('Delete'); ?>
            <?php echo csrf_field(); ?>
              <button class="dropdown-item" type="submit">Delete</button>
          </form>
          <a class=" dropdown-item" href="<?php echo e(route('products.edit',['product'=> $item->id])); ?>">Edit</a>
          <a class="dropdown-item" href=<?php echo e(route('comments',['id' => $item->id])); ?>>Comments</a>
        </div>
      </div>
       
      
    </td>
     <!-- sending the id of the user to the edit route -->
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </tbody>
</table>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Downloads\project_1\resources\views/panel/products/index.blade.php ENDPATH**/ ?>