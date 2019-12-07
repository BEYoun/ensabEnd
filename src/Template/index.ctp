<!-- src/Template/Posts/view.ctp -->
<?php
$this->extend('/Common/view');

$this->assign('title', $post->title);

$this->start('sidebar');
?>
<li>
<?php
echo $this->Html->link('edit', [
    'action' => 'edit',
    $post->id
]); ?>
</li>
<?php $this->end(); ?>

// The remaining content will be available as the 'content' block
// In the parent view.
<?= h($post->body) ?>
