# Smite-Tierlist-Tool
Small tierlist creator/aggregator for Smite.

This webapp will allow you to create tierlists, and share them with others. It also provides aggregate tierlists providing an averaged overall tierlist based on all created tierlists.

The idea behind this was to crowd source data about how players felt about the state of the game


#### Running
Run the following:
```bash
docker-compose up -d
docker-compose exec web composer install
docker-compose exec database ./tmp/init.sh
docker-compose exec web php app/console doctrine:migrations/migrate

```



##### This is archived. 
I plan to eventually get it back into a state where it could be deployed again. The CDN I hosted on, and likely my Smite API credentials (you'd need your own anyway) are no longer available.