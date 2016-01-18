Test app in php with mysql.<br />
http://tholidays.esy.es/

Task:

Создать веб-приложение производственного календаря.

1. Структура приложения:<br />
1.1. Существует таблица в БД произвольных выходных в произвольные годы.<br />
1.2. Произвольный выходной характеризуют следующие параметры:<br />
1.2.1. Точная дата.<br />
1.2.2. Название.<br />
1.3. Имеется возможность добавлять, редактировать и удалять произвольные выходные на отдельной странице по отдельному url.<br />
1.4. По умолчанию выходными считаются все субботы и воскресенья любого года, но они не находятся в БД, а определены на уровне кода.

2. Внешний вид:<br />
2.1. В хедере страницы календаря должен быть выбор года, за который календарь строится. По умолчанию там должен стоять текущий год.<br />
2.2. Дни выходных (заданных в коде и в БД) отмечаются другим цветом.<br />
2.3. При наведении на выходные, заданные в БД, в подсказке отображается название соответствующего выходного.<br />
2.4. Остальных ограничений на отображение информации нет.

3. Язык исполнения: PHP. Язык БД - MySQL.
