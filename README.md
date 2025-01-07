```
git clone https://github.com/shoumq/nebus
```

```
cd nebus
```

```
cp .env.example .env
```

```
./vendor/bin/sail up -d
```

```
./vendor/bin/sail artisan migrate
```

```
./vendor/bin/sail artisan db:seed
```
