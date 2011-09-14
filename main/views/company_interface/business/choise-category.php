<select name="category" id="select-category" class="mixed-combo" size="1" style="width:325px;">
	<option value="empty">Выберите категорию</option>
	<option value="discussions">Обсуждения</option>
	<option value="question-answer">Вопрос-ответ</option>
<?php if(!$envirenment):?>
	<option value="rating">Рейтинг</option>
<?php endif;?>
	<option value="articles">Статьи</option>
	<option value="documentation">Обмен документами</option>
	<option value="survey">Опрос</option>
<?php if(!$envirenment):?>
	<option value="association">Объединения для закупок</option>
	<option value="offers">Предложения для контрагентов</option>
	<option value="news">Новости</option>
	<option value="discounts">Новинки и скидки</option>
	<option value="who-main">Кто главный?</option>
<?php endif;?>
</select>