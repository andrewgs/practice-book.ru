<select name="category" id="select-category" class="mixed-combo" size="1" style="width:325px;">
	<option value="empty">Выберите категорию</option>
	<option value="discussions">Обсуждения</option>
	<option value="question-answer">Вопрос-ответ</option>
	<option value="interactions">Взаимодействие с Госструктурами</option>
	<option value="documentation">Обмен документами</option>
	<option value="surveys">Опрос</option>
	<option value="articles">Статьи</option>
<?php if(!$environment):?>
	<option value="associations">Объединения для закупок</option>
	<option value="offers">Предложения для контрагентов</option>
	<option value="news">Новости</option>
	<option value="discounts">Новинки и скидки</option>
	<option value="who-main">Кто главный?</option>
	<option value="rating">Рейтинг</option>
<?php endif;?>
</select>