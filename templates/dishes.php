<h2 class="content__main-heading"><?= $category['name'] ?></h2>

<table class="tasks">
  <?php foreach ($dishes as $dish): ?>
  <tr class="tasks__item task">
    <td class="task__select">
      <a href="/dish_edit.php?category_id=<?= $category['id'] ?>&id=<?= $dish['id'] ?>"><?= htmlspecialchars($dish['name']) ?></a>
    </td>
    <td>
      <?= $dish['is_active'] ? 'Активен' : '' ?>
    </td>
    <?php if ($user['is_admin']) : ?>
    <td>
      <a href="/dish_delete.php?category_id=<?= $category['id'] ?>&id=<?= $dish['id'] ?>">Удалить</a>
    </td>
    <?php endif; ?>
  </tr>
  <?php endforeach; ?>
</table>

<?php if ($user['is_admin']) : ?>
<div>
  <a class="button" href="dish_new.php?category_id=<?= $category['id'] ?>">Добавить</a>
</div>
<?php endif; ?>
