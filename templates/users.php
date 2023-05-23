<h2 class="content__main-heading">Пользователи</h2>

<table class="tasks">
  <?php foreach ($users as $user): ?>
  <tr class="tasks__item task">
    <td class="task__select">
      <a href="/user.php?id=<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?></a>
    </td>
    <td>
      <a href="/user_delete.php?id=<?= $user['id'] ?>">Удалить</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
<div>
  <a class="button" href="user_new.php">Добавить</a>
</div>
