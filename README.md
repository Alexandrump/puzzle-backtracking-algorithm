### Puzzle Backtracking Algorithm using PHP and aproaching to Hexagonal Architecture (DDD)

Used a sequential algorithm. Performance should improve if algorithm were done searching the puzzle frames. This should be the second approach to improve the algorithm.



#### How To Run using Docker
- Install docker and run: `docker-compose up -d` in the root folder.
- Run: `docker exec -it -u www-data puzzle-php /bin/bash`
- Enter the puzzle folder `cd puzzle` and run `composer install --prefer-dist`
- When dependencies were be installed and the parameter file  were be created then run `php main.php` and follow steps.


#### What need to be improved
- 8x8 puzzle takes days to give a solution so It's suspiced that the algorithm isn't as efficient as expected

