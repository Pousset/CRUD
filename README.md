<!-- Pour creer la Data Base, copier coller le code suivant -->
<!-- cela permet de creer une table avec directement les bonnes infos -->
<!-- ensuite vous pouvez soit ajouter directement en vous connectant sur le site ou en creant l'user dans phpmyadmin -->

```sql
CREATE TABLE `crud` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)
```