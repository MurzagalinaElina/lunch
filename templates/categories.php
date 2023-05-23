<h2 class="content__main-heading">Категории</h2>

<table class="tasks">
  <?php foreach ($categories as $category): ?>
  <tr class="tasks__item task">
    <td class="task__select">
      <a href="/category_edit.php?id=<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></a>
    </td>
    <td>
      <a href="/dishes.php?category_id=<?= $category['id'] ?>">Блюда</a>
    </td>
    <?php if ($user['is_admin']) : ?>
    <td>
      <a href="/category_delete.php?id=<?= $category['id'] ?>">Удалить</a>
    </td>
    <?php endif; ?>
  </tr>
  <?php endforeach; ?>
</table>

<?php if ($user['is_admin']) : ?>
<div>
  <a class="button" href="category_new.php">Добавить</a>
</div>
<?php endif; ?>
