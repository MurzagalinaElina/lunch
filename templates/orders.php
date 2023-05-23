<h2 class="content__main-heading">Заказы</h2>

<table class="tasks">
  <?php foreach ($dishes as $dish): ?>
  <tr class="tasks__item task">
    <td class="task__select">
      <?= htmlspecialchars($dish['name']) ?>
    </td>
    <td>
      <?= $dish['count'] ?>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

<form class="form" action="" method="post">
  <input type="hidden" name="clear_orders" value="1" />
  <input type="submit" value="Очистить заказы" class="button" />
</form>
<br>

<?php if ($properties['ordering_active'] == '1'): ?>
<form class="form" action="" method="post">
  <input type="hidden" name="ordering" value="0" />
  <input type="submit" value="Выключить запись" class="button" />
</form>
<?php else: ?>
<form class="form" action="" method="post">
  <input type="hidden" name="ordering" value="1" />
  <input type="submit" value="Включить запись" class="button" />
</form>
<?php endif; ?>
