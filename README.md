Test app in php with mysql.

Task:

Создать веб-приложение производственного календаря.

1. Структура приложения:
1.1. Существует таблица в БД произвольных выходных в произвольные годы.
1.2. Произвольный выходной характеризуют следующие параметры:
1.2.1. Точная дата.
1.2.2. Название.
1.3. Имеется возможность добавлять, редактировать и удалять произвольные выходные на отдельной странице по отдельному url.
1.4. По умолчанию выходными считаются все субботы и воскресенья любого года, но они не находятся в БД, а определены на уровне кода.

2. Внешний вид:
2.1. В хедере страницы календаря должен быть выбор года, за который календарь строится. По умолчанию там должен стоять текущий год.
2.2. Дни выходных (заданных в коде и в БД) отмечаются другим цветом.
2.3. При наведении на выходные, заданные в БД, в подсказке отображается название соответствующего выходного.
2.4. Остальных ограничений на отображение информации нет.

3. Язык исполнения: PHP. Язык БД - MySQL.
