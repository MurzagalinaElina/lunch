<nav class="main-navigation">
  <ul class="main-navigation__list">
    <li class="main-navigation__list-item">
      <a class="main-navigation__list-item-link" href="/order.php">Заказать</a>
    </li>
    <?php if ($user['is_admin']) : ?>
    <li class="main-navigation__list-item">
      <a class="main-navigation__list-item-link" href="/orders.php">Заказы</a>
    </li>
    <li class="main-navigation__list-item">
      <a class="main-navigation__list-item-link" href="/categories.php">Категории</a>
    </li>
    <li class="main-navigation__list-item">
      <a class="main-navigation__list-item-link" href="/users.php">Пользователи</a>
    </li>
    <?php endif; ?>
  </ul>
</nav>
