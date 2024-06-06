CREATE TABLE checkbox_info(
	id SERIAL NOT NULL,
	name VARCHAR(255) NOT NULL,
	description TEXT NOT NULL
);
INSERT INTO checkbox_info (name, description) VALUES 
('Robots.txt', 'Robots.txt - это файл, используемый для управления поведением поисковых роботов.'),
('Sitemap.xml', 'Sitemap.xml - это файл, который предоставляет информацию о страницах сайта для поисковых систем.'),
('favicon.ico', 'favicon.ico - это значок, который отображается в браузере рядом с заголовком страницы.'),
('humans.txt', 'humans.txt - это файл, содержащий информацию о создателях сайта.');